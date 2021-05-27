<?php

namespace App\Console\Commands;

use App\Models\Promo;
use Illuminate\Console\Command;
use function date;
use function dd;
use function ddd;

class CheckPromo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:promo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $all_promos_active = Promo::where([
            ['active', true],
            ['visible', true],
            ['type_date', true]
        ])->get();

        foreach ($all_promos_active as $promo) {
            if (date('Y-m-d H:i:s') >= ($promo->end_date . ' ' . $promo->end_time)) {
                $data['active'] = false;

                $promo_update = Promo::findOrFail($promo->id);
                $promo_update->update($data);
            }
        }
    }
}
