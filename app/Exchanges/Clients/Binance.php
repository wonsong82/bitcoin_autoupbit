<?php
namespace App\Exchanges\Clients;

use App\Exchanges\Http\Http;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class Binance {

    protected $apiBase = 'https://api.binance.com/';
    protected $apiKey;
    protected $apiSecret;


    public function __construct()
    {
        $this->apiKey = env('BINANCE_API_KEY');
        $this->apiSecret = env('BINANCE_SECRET');
    }


    public function currencyIds()
    {
        return [
            'BTC' => 'BTCUSDT',
            'BCH' => 'BCCUSDT',
            'ETH' => 'ETHUSDT',
            'LTC' => 'LTCUSDT',
            'XRP' => ['XRPETH', 'ETHUSDT'],
            'DASH' => ['DASHETH', 'ETHUSDT'],
            'ETC' => ['ETCETH', 'ETHUSDT'],
            'XMR' => ['XMRETH', 'ETHUSDT'],
            'ZEC' => ['ZECETH', 'ETHUSDT'],
            'QTUM' => ['QTUMETH', 'ETHUSDT'],
            'BTG' => ['BTGETH', 'ETHUSDT'],
            'EOS' => ['EOSETH', 'ETHUSDT']
        ];
    }





    public function getPrices(Collection $currencies)
    {
        // make it to associative array
        $currencies = $currencies
            ->pluck('id', 'currency_code')
            ->map(function($id){
                return [
                    'id' => $id,
                    'currency_id' => null
                ];
            })->toArray();

        // add currencyIds
        foreach($this->currencyIds() as $currencyCode => $currencyID){
            if($currencies[$currencyCode]) {
                $currencies[$currencyCode]['currency_id'] = $currencyID;
            }
        }

        // make api call
        $dataOriginal = $this->publicRequest(Http::GET, 'api/v3/ticker/price');


        // data from API
        $data = [];
        foreach($dataOriginal as $cur){
            $data[$cur['symbol']] = $cur;
        }

        // Finalize data. [id, currency_id, price]
        $currencies = array_map(function($currency) use($data){
            $dataAvailable = true;
            if(is_array($currency['currency_id'])){
                foreach($currency['currency_id'] as $i){
                    if(!isset($data[$i])){
                        $dataAvailable = false;
                    }
                }
            } else {
                $dataAvailable = isset($data[$currency['currency_id']]);
            }


            if($dataAvailable){
                if(is_array($currency['currency_id'])){ // 2 step
                    $level1 = doubleval($data[$currency['currency_id'][0]]['price']);
                    $level2 = doubleval($data[$currency['currency_id'][1]]['price']);
                    $currency['price'] = $level1 * $level2;
                }
                else { // 1 step: string
                    $currency['price'] = doubleval($data[$currency['currency_id']]['price']);
                }

            }
            else {
                $currency['price'] = null;
            }

            return $currency;

        }, $currencies);



        return $currencies;
    }


    public function withdrawHistory()
    {
        $dataOriginal = $this->signedRequest(Http::GET, 'wapi/v3/withdrawHistory.html', []);


        dd($dataOriginal);


    }


    /***
     * Public Request doesnt require API key or signature
     *
     * @param $method
     * @param $uri
     * @param array $params
     * @return mixed
     */
    protected function publicRequest($method, $uri, $params=[])
    {
        if($method == Http::GET){
            $query = http_build_query($params, '', '&');
            $query = $query? '?'.$query : $query;
            $params=[];
        }
        else {
            $query = '';
        }

        $url = $this->apiBase . $uri . $query;



        $res = null;

        try{
            $res = Http::request($method, $url, $params);
        }
        catch (\Exception $e){

            // handle error
            $statusCode = $res->status;

            // Error handling
            echo($e->getMessage());


            exit();
        }

        return json_decode($res->content, true);
    }


    /***
     * Private Request requires APIKEY but no signature
     *
     * @param $method
     * @param $uri
     * @param array $params
     * @return mixed
     */
    protected function privateRequest($method, $uri, $params=[])
    {
        $headers = [
            'X-MBX-APIKEY' => $this->apiKey
        ];

        if($method == Http::GET){
            $query = http_build_query($params, '', '&');
            $query = $query? '?'.$query : $query;
            $params=[];
        }
        else {
            $query = '';
        }

        $url = $this->apiBase . $uri . $query;


        $res = null;

        try{
            $res = Http::request($method, $url, $params, $headers);
        }
        catch (\Exception $e){

            // handle error
            $statusCode = $res->status;

            // Error handling
            echo($e->getMessage());


            exit();
        }

        return json_decode($res->content, true);


    }


    public function test()
    {
        $time = Carbon::createFromTimestamp(1515562464952 / 1000);
        dd($time);

    }



    /***
     * Signed Request requires APIKEY, SHA256 signed signature, and timestamp
     *
     * @param $method
     * @param $uri
     * @param array $params
     * @return mixed
     */
    protected function signedRequest($method, $uri, $params=[])
    {
        $headers = [
            'X-MBX-APIKEY' => $this->apiKey
        ];

        // Add timestamp
        $params['timestamp'] = number_format(microtime(true)*1000,0,'.','');
        //$time = Carbon::createFromTimestamp((double)$params['timestamp']/1000);


        // Make signature
        $signatureData = http_build_query($params, '', '&');
        $signatureKey = $this->apiSecret;
        $signature = hash_hmac('sha256', $signatureData, $signatureKey);

        // Add signature to params
        $params['signature'] = $signature;


        if($method == Http::GET){
            $query = http_build_query($params, '', '&');
            $query = $query? '?'.$query : $query;
            $params=[];
        }
        else {
            $query = '';
        }

        $url = $this->apiBase . $uri . $query;



        $res = null;

        try{
            $res = Http::request($method, $url, $params, $headers);
        }
        catch (\Exception $e){

            // handle error
            $statusCode = $res->status;

            // Error handling
            echo($e->getMessage());


            exit();
        }

        return json_decode($res->content, true);
    }
    


}