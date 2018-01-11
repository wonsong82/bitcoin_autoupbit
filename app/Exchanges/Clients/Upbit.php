<?php
namespace App\Exchanges\Clients;

use App\Exchanges\Http\Http;
use App\Models\Currency;
use GuzzleHttp\Client;
use function GuzzleHttp\Promise\unwrap;

class Upbit {


    public function getPrices()
    {
        $url = 'https://crix-api-endpoint.upbit.com/v1/crix/candles/minutes/1?count=1&code=CRIX.UPBIT.';

        $exchangeUrl = 'https://quotation-api-cdn.dunamu.com/v1/forex/recent?codes=FRX.KRWUSD';


        $currencies = Currency::active()->orderBy('order')->get();


        $client = new Client();

        // Send async requests
        $promises = [];
        $promises['exchange'] = $client->getAsync($exchangeUrl);

        foreach($currencies as $currency){
            if($currency->base_pair_intermediate){ // intermediate exists
                if(!isset($promises[$currency->base_pair_intermediate])){
                    $promises[$currency->base_pair_intermediate] = $client->getAsync($url . $this->pairToCode($currency->base_pair_intermediate));
                }
            }
            if($currency->premium_pair_intermediate){ // intermediate exists
                if(!isset($promises[$currency->premium_pair_intermediate])){
                    $promises[$currency->premium_pair_intermediate] = $client->getAsync($url . $this->pairToCode($currency->premium_pair_intermediate));
                }
            }
            if(!isset($promises[$currency->base_pair])){
                $promises[$currency->base_pair] = $client->getAsync($url . $this->pairToCode($currency->base_pair));
            }
            if(!isset($promises[$currency->premium_pair])){
                $promises[$currency->premium_pair] = $client->getAsync($url . $this->pairToCode($currency->premium_pair));
            }
        }

        // Get results
        $results = \GuzzleHttp\Promise\unwrap($promises);
        $results = \GuzzleHttp\Promise\settle($promises)->wait();

        $data = array_map(function($d){
            return json_decode($d['value']->getBody()->getContents(), true)[0];
        }, $results);


        // Parse Exchange Rate
        $exchangeRate = doubleval($data['exchange']['basePrice']);


        // Add prices to currency collection
        foreach($currencies as &$currency){

            // BASE
            $basePrice = doubleval($data[$currency->base_pair]['tradePrice']);
            if($currency->base_pair_intermediate){
                $basePrice = $basePrice * doubleval($data[$currency->base_pair_intermediate]['tradePrice']);
            }

            // PREMIUM
            $premiumPrice = doubleval($data[$currency->premium_pair]['tradePrice']);
            if($currency->premium_pair_intermediate){
                $premiumPrice = $premiumPrice * doubleval($data[$currency->premium_pair_intermediate]['tradePrice']);
            }
            $premiumPrice = $premiumPrice / $exchangeRate;

            $currency->base_price = $basePrice;
            $currency->premium_price = $premiumPrice;
        }



        return $currencies;
    }


    protected function pairToCode($pair){
        $codes = explode('/', $pair);
        return $codes[1] . '-' . $codes[0];
    }


    /*protected function getExchangeRate()
    {
        $url = 'https://quotation-api-cdn.dunamu.com/v1/forex/recent?codes=FRX.KRWUSD';

        $client = new Client();
        $res  = $client->get($url);
        $data = json_decode($res->getBody()->getContents(), true);

        return (double)($data[0]['basePrice']);
    }*/

    /*protected function request($method, $url, $params=[], $headers=[])
    {
        if($method == Http::GET){
            $query = http_build_query($params, '', '&');
            $query = $query? '?'.$query : $query;
            $params=[];
        }
        else {
            $query = '';
        }

        $url = $url . $query;


        $res = null;
        try{
            $res = Http::request($method, $url, $params, $headers);
        }
        catch (\Exception $e){

            // handle error
            //$statusCode = $res->status;

            // Error handling
            echo($e->getMessage());


            exit();
        }

        return $res;
    }*/



}