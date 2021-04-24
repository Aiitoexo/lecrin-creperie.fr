<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Checkout\Session;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Stripe;
use Stripe\Webhook;
use UnexpectedValueException;
use function abort;
use function config;
use function floatval;
use function generateOrderReference;
use function redirect;
use function response;
use function route;
use function session;
use function view;

class StripePaymentController extends Controller
{

    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    public function index()
    {
        $orderClient = Order::findOrFail(session('id_order'));

        $commandClient = $orderClient['command'];

        return view('pages.payment.index', [
            'orderClient' => $orderClient,
            'commandClient' => $commandClient
        ]);
    }

    public function success()
    {
        $order = Order::findOrFail(session('id_order'));

        session()->forget('type_command');
        session()->forget('cart_total');
        session()->forget('cart');

        return view('pages.payment.success', [
            'order' => $order,
            'result' => 'success'
        ]);
    }

    public function cancel()
    {
        $order = Order::findOrFail(session('id_order'));

        session()->forget('type_command');
        session()->forget('cart_total');
        session()->forget('cart');

        return view('pages.payment.cancel', [
            'order' => $order,
            'result' => 'cancel'
        ]);
    }

    public function deleteCommand($id) {
        session()->flush();

        $cancelOrder = Order::findOrFail($id);

        $cancelOrder->delete();

        return redirect()->route('homepage');
    }

    public function info(Request $request)
    {
        $rules = [
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'phone' => 'required|string',
            'mail' => 'required|email',
            'text' => 'nullable|string'
        ];

        if (session('type_command') == 'livraison') {
            $rules['adresse'] = 'string';
            $rules['city'] = 'string';
            $rules['postal'] = 'string|exists:postals,postal_code';
        }

        $data = $request->validate($rules);

        $data['reference'] = generateOrderReference();
        $data['status'] = Order::PENDING;
        $data['type_command'] = session('type_command');
        $data['command'] = session('cart');
        $data['price'] = session('cart_total');

        $order = Order::create($data);

        session()->put('id_order', $order->id);

        return redirect()->route('payment');
    }

    public function editInfo($id)
    {
        $orderInfo = Order::findOrFail($id);

        return view('pages.panier.order_info', [
            'orderInfo' => $orderInfo
        ]);
    }

    public function updateInfo(Request $request, $id)
    {
        $rules = [
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'phone' => 'required|string',
            'mail' => 'required|email',
            'text' => 'nullable|string'
        ];

        if (session('type_command') == 'livraison') {
            $rules['adresse'] = 'string';
            $rules['city'] = 'string';
            $rules['postal'] = 'string|exists:postals,postal_code';
        }

        $data = $request->validate($rules);

        $infoOrder = Order::findOrFail($id);
        $infoOrder->update($data);

        return redirect()->route('payment');
    }

    public function process()
    {

        $total = floatval(session('cart_total'));

        $checkout_session = Session::create([
            'payment_method_types' => ['card'],
            'client_reference_id' => session('id_order'),
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => (int)$total * 100,
                    'product_data' => [
                        'name' => 'L\' écrin Creperie',
                        'images' => ["https://i.imgur.com/EHyR2nP.png"],
                    ],
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success'),
            'cancel_url' => route('payment.cancel'),
        ]);

        return response()->json(['id' => $checkout_session->id]);
    }

    public function complete(Request $request)
    {
        $event = null;

        try {
            $event = Webhook::constructEvent(
                $request->getContent(),
                $request->header('Stripe-Signature'),
                config('services.stripe.endpoint_secret')
            );
        } catch (UnexpectedValueException $e) {
            abort(400);
        } catch (SignatureVerificationException $e) {
            abort(400);
        }

        if ($event->type === 'checkout.session.completed') {

            $session = $event->data->object;

            if ($session->payment_status === 'paid') {

                Log::info($session);

                $this->createOrder($session->client_reference_id);
            }

        }

        return response()->json(['errors' => false]);
    }

    private function createOrder($id)
    {
        $order = Order::findOrFail($id);

        $data['status'] = Order::IN_PROGRESS;

        $order->update($data);
    }

}
