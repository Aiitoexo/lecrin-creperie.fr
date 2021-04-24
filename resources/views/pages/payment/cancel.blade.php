@extends('layouts.default')

@section('main')
    <div class="mt-72 w-5/12 mx-auto h-auto bg-gray-800 rounded-3xl border-2 border-yellow-500 pb-10 pl-10 pr-10 pt-6">
        @include('pages.payment.partials.response_order_payment')
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        // Create an instance of the Stripe object with your publishable API key
        var stripe = Stripe("{{ config('services.stripe.key') }}");
        var checkoutButton = document.getElementById("checkout-button");

        checkoutButton.addEventListener("click", function () {
            fetch("{{ route('payment.process') }}", {
                method: "POST",
                credentials: "same-origin",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': document.head.querySelector("[name~=csrf-token][content]").content
                }
            })
                .then(function (response) {
                    return response.json();
                })
                .then(function (session) {
                    return stripe.redirectToCheckout({sessionId: session.id});
                })
                .then(function (result) {
                    // If redirectToCheckout fails due to a browser or network
                    // error, you should display the localized error message to your
                    // customer using error.message.
                    if (result.error) {
                        alert(result.error.message);
                    }
                })
                .catch(function (error) {
                    console.error("Error:", error);
                });
        });
    </script>
@endsection
