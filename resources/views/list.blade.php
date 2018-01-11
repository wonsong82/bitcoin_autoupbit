<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Document</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>
<body>



<div class="page-header">
    <div class="btn-group btn-group-sm">
        <a href="{{ url('/price') }}" class="btn btn-primary active">Simple</a>
        <a href="{{ url('/price?detail=true') }}" class="btn btn-primary">Detailed</a>
    </div>
</div>


<table class="table table-fixed table-bordered">
    <thead>
    <tr>
        <th>Time</th>
        @foreach($currencies as $currency)
            <th>{{ $currency->code }}</th>
        @endforeach
    </tr>
    </thead>

    <tbody>
    @foreach($records as $record)
        <tr>
            <td>{{ $record->recorded_at->format('Y/n/j_g:i:sA') }}</td>
            @foreach($currencies as $currency)
                @php
                    $line = isset($record->lines[$currency->code])?
                        $record->lines[$currency->code]:false
                @endphp
                @if($line)
                    <td{!!$record->min==$line->id?' style="background:#f00"':($record->max==$line->id?' style="background:#0f0"':'')!!}><b>{{$line->premium_rate * 100}}% ♥</b></td>
                @else
                    <td>---</td>
                @endif
            @endforeach
        </tr>
    @endforeach
    </tbody>

</table>


<hr>
<div class="page-footer">
    <div class="btn-group btn-group-sm">
        <a href="{{ url('/price') }}" class="btn btn-primary active">Simple</a>
        <a href="{{ url('/price?detail=true') }}" class="btn btn-primary">Detailed</a>
    </div>
</div>




{{--Pagination--}}



<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
    $('')
</script>




</body>
</html>