<?php

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencyTableSeeder extends Seeder
{
    public function currencies()
    {
        /*
            btc
            eth
            etc
            xrp
            ada
            trx
            ltc
            bch
            neo
            zec
            omg
            xmr
            btg
            sc
            dcr
            dash
         */

        return [
            [
                'code' => 'BTC',
                'name' => 'Bitcoin',
                'name_kr' => '비트코인',
                'base_pair' => 'BTC/USDT',
                'base_pair_intermediate' => null,
                'premium_pair' => 'BTC/KRW',
                'premium_pair_intermediate' => null,
                'is_active' => true,
                'order' => 1
            ],
            [
                'code' => 'ETH',
                'name' => 'Ethereum',
                'name_kr' => '이더리움',
                'base_pair' => 'ETH/USDT',
                'base_pair_intermediate' => null,
                'premium_pair' => 'ETH/KRW',
                'premium_pair_intermediate' => null,
                'is_active' => true,
                'order' => 2
            ],
            [
                'code' => 'ETC',
                'name' => 'Ethereum Classic',
                'name_kr' => '이더리움클래식',
                'base_pair' => 'ETC/USDT',
                'base_pair_intermediate' => null,
                'premium_pair' => 'ETC/KRW',
                'premium_pair_intermediate' => null,
                'is_active' => true,
                'order' => 3
            ],
            [
                'code' => 'XRP',
                'name' => 'Ripple',
                'name_kr' => '리플',
                'base_pair' => 'XRP/USDT',
                'base_pair_intermediate' => null,
                'premium_pair' => 'XRP/KRW',
                'premium_pair_intermediate' => null,
                'is_active' => true,
                'order' => 4
            ],
            [
                'code' => 'ADA',
                'name' => 'Ada',
                'name_kr' => '에이다',
                'base_pair' => 'ADA/USDT',
                'base_pair_intermediate' => null,
                'premium_pair' => 'ADA/KRW',
                'premium_pair_intermediate' => null,
                'is_active' => true,
                'order' => 5
            ],
            [
                'code' => 'TRX',
                'name' => 'Tron',
                'name_kr' => '트론',
                'base_pair' => 'TRX/USDT',
                'base_pair_intermediate' => null,
                'premium_pair' => 'TRX/KRW',
                'premium_pair_intermediate' => null,
                'is_active' => true,
                'order' => 6
            ],
            [
                'code' => 'LTC',
                'name' => 'Litecoin',
                'name_kr' => '라이트코인',
                'base_pair' => 'LTC/USDT',
                'base_pair_intermediate' => null,
                'premium_pair' => 'LTC/KRW',
                'premium_pair_intermediate' => null,
                'is_active' => true,
                'order' => 7
            ],
            [
                'code' => 'BCH',
                'name' => 'Bitcoin Cash',
                'name_kr' => '비트코인캐시',
                'base_pair' => 'BCH/USDT',
                'base_pair_intermediate' => null,
                'premium_pair' => 'BCH/KRW',
                'premium_pair_intermediate' => null,
                'is_active' => true,
                'order' => 8
            ],
            [
                'code' => 'NEO',
                'name' => 'NEO',
                'name_kr' => '네오',
                'base_pair' => 'NEO/USDT',
                'base_pair_intermediate' => null,
                'premium_pair' => 'NEO/KRW',
                'premium_pair_intermediate' => null,
                'is_active' => true,
                'order' => 9
            ],
            [
                'code' => 'ZEC',
                'name' => 'Zcash',
                'name_kr' => '지캐시',
                'base_pair' => 'ZEC/USDT',
                'base_pair_intermediate' => null,
                'premium_pair' => 'ZEC/KRW',
                'premium_pair_intermediate' => null,
                'is_active' => true,
                'order' => 10
            ],
            [
                'code' => 'OMG',
                'name' => 'OmiseGo',
                'name_kr' => '오미세고',
                'base_pair' => 'OMG/USDT',
                'base_pair_intermediate' => null,
                'premium_pair' => 'OMG/KRW',
                'premium_pair_intermediate' => null,
                'is_active' => true,
                'order' => 11
            ],
            [
                'code' => 'XMR',
                'name' => 'Monero',
                'name_kr' => '모네로',
                'base_pair' => 'XMR/USDT',
                'base_pair_intermediate' => null,
                'premium_pair' => 'XMR/KRW',
                'premium_pair_intermediate' => null,
                'is_active' => true,
                'order' => 12
            ],
            [
                'code' => 'BTG',
                'name' => 'Bitcoin Gold',
                'name_kr' => '비트코인골드',
                'base_pair' => 'BTG/USDT',
                'base_pair_intermediate' => null,
                'premium_pair' => 'BTG/KRW',
                'premium_pair_intermediate' => null,
                'is_active' => true,
                'order' => 13
            ],
            [
                'code' => 'SC',
                'name' => 'Sia Coin',
                'name_kr' => '시아코인',
                'base_pair' => 'SC/USDT',
                'base_pair_intermediate' => null,
                'premium_pair' => 'SC/KRW',
                'premium_pair_intermediate' => null,
                'is_active' => true,
                'order' => 14
            ],
            [
                'code' => 'DCR',
                'name' => 'Decred',
                'name_kr' => '디크레드',
                'base_pair' => 'DCR/USDT',
                'base_pair_intermediate' => null,
                'premium_pair' => 'DCR/KRW',
                'premium_pair_intermediate' => null,
                'is_active' => true,
                'order' => 15
            ],
            [
                'code' => 'DASH',
                'name' => 'Dash',
                'name_kr' => '대시',
                'base_pair' => 'DASH/USDT',
                'base_pair_intermediate' => null,
                'premium_pair' => 'DASH/BTC',
                'premium_pair_intermediate' => 'BTC/KRW',
                'is_active' => true,
                'order' => 16
            ],


        ];
    }


    public function run()
    {
        foreach ($this->currencies() as $currency) {
            Currency::create($currency);
        }
    }
}
