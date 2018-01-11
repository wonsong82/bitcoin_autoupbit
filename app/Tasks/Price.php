<?php
namespace App\Tasks;



use App\Exchanges\Clients\Upbit;
use App\Exchanges\Traits\MathTrait;
use App\Models\PricesRecord;
use App\Models\PricesRecordLine;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Price {

    use MathTrait;


    public function addPriceRecord()
    {
        // get time before any api calls
        $time = Carbon::now();

        // Currencies to get prices
        $record = PricesRecord::create([
            'recorded_at' => $time
        ]);

        $upbit = new Upbit();
        $currencies = $upbit->getPrices();


        foreach($currencies as $currency){

            $basePrice = $currency->base_price;
            $premPrice = $currency->premium_price;
            $premAmt = doubleval($premPrice) - doubleval($basePrice);
            $premRate = $premAmt / doubleval($basePrice);

            // SD
            $prevRecords = PricesRecordLine::where('currency_id', $currency->id)
                ->orderBy('created_at', 'desc')
                ->limit(479)
                ->get();

            $sd5 = $this->getStandardDeviations($prevRecords, 4, [$basePrice, $premPrice, $premRate]);
            $sd10 = $this->getStandardDeviations($prevRecords, 9, [$basePrice, $premPrice, $premRate]);
            $sd30 = $this->getStandardDeviations($prevRecords, 29, [$basePrice, $premPrice, $premRate]);
            $sd60 = $this->getStandardDeviations($prevRecords, 59, [$basePrice, $premPrice, $premRate]);
            $sd120 = $this->getStandardDeviations($prevRecords, 119, [$basePrice, $premPrice, $premRate]);
            $sd240 = $this->getStandardDeviations($prevRecords, 239, [$basePrice, $premPrice, $premRate]);


            $data = [
                'currency_id' => $currency->id,

                'base_price' => $basePrice,
                'premium_price' => $premPrice,
                'premium_amount' => $premAmt,
                'premium_rate' => $premRate,

                'sd_bp_5' => $sd5['bp'],
                'sd_bp_10' => $sd10['bp'],
                'sd_bp_30' => $sd30['bp'],
                'sd_bp_60' => $sd60['bp'],
                'sd_bp_120' => $sd120['bp'],
                'sd_bp_240' => $sd240['bp'],
                'sd_pp_5' => $sd5['pp'],
                'sd_pp_10' => $sd10['pp'],
                'sd_pp_30' => $sd30['pp'],
                'sd_pp_60' => $sd60['pp'],
                'sd_pp_120' => $sd120['pp'],
                'sd_pp_240' => $sd240['pp'],
                'sd_pr_5' => $sd5['pr'],
                'sd_pr_10' => $sd10['pr'],
                'sd_pr_30' => $sd30['pr'],
                'sd_pr_60' => $sd60['pr'],
                'sd_pr_120' => $sd120['pr'],
                'sd_pr_240' => $sd240['pr'],
            ];


            $record->prices_record_lines()->create($data);

        }




    }


    public function clearPriceRecords()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        PricesRecord::truncate();
        PricesRecordLine::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }


    protected function getStandardDeviations($records, $limit, $start)
    {
        $return = [
            'bp' => null,
            'pp' => null,
            'pr' => null,
        ];

        if(count($records) < $limit){
            return $return;
        }

        $bps = [doubleval($start[0])];
        $pps = [doubleval($start[1])];
        $prs = [doubleval($start[2])];

        for($i=0; $i<$limit; $i++){
            $bps[] = $records[$i]['base_price'];
            $pps[] = $records[$i]['premium_price'];
            $prs[] = $records[$i]['premium_rate'];
        }

        // Return the standard deviation as rate
        return [
            'bp' => $this->standardDeviation($bps) / $bps[0],
            'pp' => $this->standardDeviation($pps) / $pps[0],
            'pr' => $this->standardDeviation($prs) / $prs[0],
        ];
    }


}