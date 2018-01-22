<!doctype html>
<html>
<head>
<title>autoupbit</title>
</head>
<body>
<h1>AUTOUPBIT</h1>

@php(
$coins = ['BTC','XRP','ETH','BCC','NEO','ADA','LTC','ETC','ZEC','OMG','BTG','XMR','DASH'];
)


<ul>
@foreach($coins as $coin)
    <li><a href="/?USDT-{{$coin}}" target="_blank">USDT-{{$coin}}</a></li>
    <li><a href="/?KRW-{{$coin}}" target="_blank">KRW-{{$coin}}</a></li>
@endforeach
</ul>

</body>
</html>