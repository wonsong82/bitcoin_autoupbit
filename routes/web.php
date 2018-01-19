<?php
Route::get('/', function(){
	return view('welcome');	
});

Route::get('price', 'PriceController@index');





// Test
Route::get('price/add', function(){
    $tasker = new \App\Tasks\Price();
    $tasker->addPriceRecord();

});


Route::get('test', function(){

    $client = new \App\Exchanges\Clients\Upbit();
    $client->getPrices();



});