<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;

class TableTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transactions = [
            [
                'trx_id' => 'a',
                'user_id' => 1,
                'amount' => 0.01000000,
                'created_at' => '2022-03-07 09:55:44',
                'updated_at' => '2022-03-07 09:55:44',
            ],
            [
                'trx_id' => 'B',
                'user_id' => 1,
                'amount' => 0.02000000,
                'created_at' => '2022-03-07 09:55:44',
                'updated_at' => '2022-03-07 09:55:44',
            ],
        ];

        foreach ($transactions as $t) {
            $store_trx = new Transaction();
            $store_trx->trx_id = $t['trx_id'];
            $store_trx->user_id = $t['user_id'];
            $store_trx->amount = $t['amount'];
            $store_trx->created_at = $t['created_at'];
            $store_trx->updated_at = $t['updated_at'];
            $store_trx->save();
        }
    }
}
