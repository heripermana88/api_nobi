<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Balance;

class TableBalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $balances = [
            [
                'user_id' => 1,
                // 'amount_available' =>  0.01000000,
                'amount_available' =>  0.00674223,
                'created_at' => '2022-03-07 09:57:13',
                'updated_at' => '2022-03-07 09:57:13',
            ],
            [
                'user_id' => 2,
                'amount_available' => 1.00000000,
                'created_at' => '2022-03-07 09:57:13',
                'updated_at' => '2022-03-07 09:57:13',
            ],
            [
                'user_id' => 3,
                'amount_available' => 0.00000001,
                'created_at' => '2022-03-07 09:57:13',
                'updated_at' => '2022-03-07 09:57:13',
            ],
            [
                'user_id' => 4,
                'amount_available' => 21.00000000,
                'created_at' => '2022-03-07 09:57:13',
                'updated_at' => '2022-03-07 09:57:13',
            ],
        ];

        foreach ($balances as $b) {
            $store_balance = new Balance();
            $store_balance->user_id = $b['user_id'];
            $store_balance->amount_available = $b['amount_available'];
            $store_balance->created_at = $b['created_at'];
            $store_balance->updated_at = $b['updated_at'];
            $store_balance->save();
        }
    }
}
