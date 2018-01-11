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
            $lines = [];
            foreach($record->prices_record_lines as $line){
                $lines[$line->currency->code] = $line;
            }
            $record->lines = $lines;

            return $record;
        });

        return $detail?
            view('list-detail', compact('records', 'currencies')):
            view('list', compact('records', 'currencies'));
    }
}
