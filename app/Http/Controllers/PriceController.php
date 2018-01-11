<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\PricesRecord;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function index()
    {
        $detail = (bool)request('detail');

        $currencies = Currency::active()
            ->orderBy('order')
            ->get();

        $records = PricesRecord::with('prices_record_lines')
            ->orderBy('recorded_at', 'desc')
            ->paginate(240);

        $records->getCollection()->transform(function($record){

            $min=100;
            $max=-100;
            $minid=null;
            $maxid=null;


            $lines = [];
            foreach($record->prices_record_lines as $line){
                $lines[$line->currency->code] = $line;

                if($line->premium_rate > $max){
                    $max = $line->premium_rate;
                    $maxid = $line->id;
                }
                if($line->premium_rate < $min){
                    $min = $line->premium_rate;
                    $minid = $line->id;
                }
            }

            $record->max = $maxid;
            $record->min = $minid;
            $record->rate_diff = $max-$min;
            $record->lines = $lines;

            return $record;
        });

        return $detail?
            view('list-detail', compact('records', 'currencies')):
            view('list', compact('records', 'currencies'));
    }


}
