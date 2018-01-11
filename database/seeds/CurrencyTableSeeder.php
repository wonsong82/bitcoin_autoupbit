<?php

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencyTableSeeder extends Seeder
{
    public function currencies()
    {
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
                'code' => 'XRP',
                'name' => 'Ripple',
                'name_kr' => '리플',
                'base_pair' => 'XRP/USDT',
                'base_pair_intermediate' => null,
                'premium_pair' => 'XRP/BTC',
                'premium_pair_intermediate' => 'BTC/KRW',
                'is_active' => true,
                'order' => 2
            ],
            [
                'code' => 'ETH',
                'name' => 'Ethereum',
                'name_kr' => '이더리움',
                'base_pair' => 'ETH/USDT',
                'base_pair_intermediate' => null,
                'premium_pair' => 'ETH/BTC',
                'premium_pair_intermediate' => 'BTC/KRW',
                'is_active' => true,
                'order' => 3
            ],
            [
                'code' => 'XVG',
                'name' => 'Verge',
                'name_kr' => '버지',
                'base_pair' => 'XVG/USDT',
                'base_pair_intermediate' => null,
                'premium_pair' => 'XVG/BTC',
                'premium_pair_intermediate' => 'BTC/KRW',
                'is_active' => true,
                'order' => 4
            ],
            [
                'code' => 'NEO',
                'name' => 'NEO',
                'name_kr' => '네오',
                'base_pair' => 'NEO/USDT',
                'base_pair_intermediate' => null,
                'premium_pair' => 'NEO/BTC',
                'premium_pair_intermediate' => 'BTC/KRW',
                'is_active' => true,
                'order' => 5
            ],
            [
                'code' => 'BCC',
                'name' => 'Bitcoin Cash',
                'name_kr' => '비트코인캐시',
                'base_pair' => 'BCC/USDT',
                'base_pair_intermediate' => null,
                'premium_pair' => 'BCC/BTC',
                'premium_pair_intermediate' => 'BTC/KRW',
                'is_active' => true,
                'order' => 6
            ],
            [
                'code' => 'ETC',
                'name' => 'Ethereum Classic',
                'name_kr' => '이더리움클래식',
                'base_pair' => 'ETC/USDT',
                'base_pair_intermediate' => null,
                'premium_pair' => 'ETC/BTC',
                'premium_pair_intermediate' => 'BTC/KRW',
                'is_active' => true,
                'order' => 7
            ],
            [
                'code' => 'ADA',
                'name' => 'Ada',
                'name_kr' => '에이다',
                'base_pair' => 'ADA/USDT',
                'base_pair_intermediate' => null,
                'premium_pair' => 'ADA/BTC',
                'premium_pair_intermediate' => 'BTC/KRW',
                'is_active' => true,
                'order' => 8
            ],
            [
                'code' => 'LTC',
                'name' => 'Litecoin',
                'name_kr' => '라이트코인',
                'base_pair' => 'LTC/USDT',
                'base_pair_intermediate' => null,
                'premium_pair' => 'LTC/BTC',
                'premium_pair_intermediate' => 'BTC/KRW',
                'is_active' => true,
                'order' => 9
            ],
            [
                'code' => 'BTG',
                'name' => 'Bitcoin Gold',
                'name_kr' => '비트코인골드',
                'base_pair' => 'BTG/USDT',
                'base_pair_intermediate' => null,
                'premium_pair' => 'BTG/BTC',
                'premium_pair_intermediate' => 'BTC/KRW',
                'is_active' => true,
                'order' => 10
            ],
            [
                'code' => 'OMG',
                'name' => 'OmiseGo',
                'name_kr' => '오미세고',
                'base_pair' => 'OMG/USDT',
                'base_pair_intermediate' => null,
                'premium_pair' => 'OMG/BTC',
                'premium_pair_intermediate' => 'BTC/KRW',
                'is_active' => true,
                'order' => 11
            ],
            [
                'code' => 'XMR',
                'name' => 'Monero',
                'name_kr' => '모네로',
                'base_pair' => 'XMR/USDT',
                'base_pair_intermediate' => null,
                'premium_pair' => 'XMR/BTC',
                'premium_pair_intermediate' => 'BTC/KRW',
                'is_active' => true,
                'order' => 12
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
                'order' => 13
            ],
            [
                'code' => 'ZEC',
                'name' => 'Zcash',
                'name_kr' => '지캐시',
                'base_pair' => 'ZEC/USDT',
                'base_pair_intermediate' => null,
                'premium_pair' => 'ZEC/BTC',
                'premium_pair_intermediate' => 'BTC/KRW',
                'is_active' => true,
                'order' => 14
            ],
            [
                'code' => 'NXT',
                'name' => 'Nxt',
                'name_kr' => '엔엑스티',
                'base_pair' => 'NXT/USDT',
                'base_pair_intermediate' => null,
                'premium_pair' => 'NXT/BTC',
                'premium_pair_intermediate' => 'BTC/KRW',
                'is_active' => true,
                'order' => 15
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
