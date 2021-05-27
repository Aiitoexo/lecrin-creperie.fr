<?php


namespace App\Services;


use App\Models\Promo;
use function array_push;
use function date;
use function dd;
use function strtolower;

class PromoService
{
    public function active_promo()
    {
        $all_promos_active = Promo::where([
            ['active', true],
            ['visible', true]
        ])->get();

        $result_promo = [];

        foreach ($all_promos_active as $promo_active) {

            if ($promo_active->type_code === true) {
                if ($promo_active->type_date === true) {
                    if (date('Y-m-d H:i:s') >= ($promo_active->start_date . ' ' . $promo_active->start_time) &&
                        date('Y-m-d H:i:s') <= ($promo_active->end_date . ' ' . $promo_active->end_time)) {
                            array_push($result_promo, $promo_active);
                    }
                }

                if ($promo_active->type_days === true) {
                    $days = $this->check_days($promo_active);

                    foreach ($days as $day) {
                        if (strtolower(date('D')) === $day) {
                            array_push($result_promo, $promo_active);
                        }
                    }
                }
            }

            if ($promo_active->type_quantity === true) {
                if ($promo_active->type_date === true) {
                    if (date('Y-m-d H:i:s') >= ($promo_active->start_date . ' ' . $promo_active->start_time) &&
                        date('Y-m-d H:i:s') <= ($promo_active->end_date . ' ' . $promo_active->end_time)) {
                        array_push($result_promo, $promo_active);
                    }
                }

                if ($promo_active->type_days === true) {
                    $days = $this->check_days($promo_active);

                    foreach ($days as $day) {
                        if (strtolower(date('D')) === $day) {
                            array_push($result_promo, $promo_active);
                        }
                    }
                }
            }

            if ($promo_active->type_price === true) {
                if ($promo_active->type_date === true) {
                    if (date('Y-m-d H:i:s') >= ($promo_active->start_date . ' ' . $promo_active->start_time) &&
                        date('Y-m-d H:i:s') <= ($promo_active->end_date . ' ' . $promo_active->end_time)) {
                        array_push($result_promo, $promo_active);
                    }
                }

                if ($promo_active->type_days === true) {
                    $days = $this->check_days($promo_active);

                    foreach ($days as $day) {
                        if (strtolower(date('D')) === $day) {
                            array_push($result_promo, $promo_active);
                        }
                    }
                }
            }
        }
        return $result_promo;
    }

    private function check_days($promo)
    {
        $promo_days_active = [];

        $promo->mon === true ? array_push($promo_days_active, 'mon') : null;
        $promo->tue === true ? array_push($promo_days_active, 'tue') : null;
        $promo->wed === true ? array_push($promo_days_active, 'wed') : null;
        $promo->thu === true ? array_push($promo_days_active, 'thu') : null;
        $promo->fri === true ? array_push($promo_days_active, 'fri') : null;
        $promo->sat === true ? array_push($promo_days_active, 'sat') : null;
        $promo->sun === true ? array_push($promo_days_active, 'sun') : null;

        return $promo_days_active;
    }
}

