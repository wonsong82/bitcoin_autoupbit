<!doctype html>
<html>
<head>
<title>autoupbit</title>
</head>
<body>
<h1>AUTOUPBIT</h1>

@php
$coins = App\Models\Currency::where('is_active', true)->orderBy('order')->get();
@endphp


<ul>
@foreach($coins as $coin)
    <li><a href="/?USDT-{{$coin->code}}">USDT-{{$coin->code}}</a></li>
    <li><a href="/?KRW-{{$coin->code}}">KRW-{{$coin->code}}</a></li>
@endforeach
</ul>

</body>
</html>