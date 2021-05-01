@extends('layouts')

@section('contents')

<h3>確認画面</h3>
<table class="table">
    <thead>
        <tr>
            <th scope="col">メーカー車名</th>
            <th scope="col">入庫番号</th>
            <th scope="col">年式</th>
            <th scope="col">認定型式</th>
            <th scope="col">外装色</th>
            <th scope="col">走行距離</th>
        </tr>
    </thead>
    <tbody>
        <tr>
@if (@isset($input))
    @foreach ($input[1] as $data)
        <td> {{ $data }} <td>     
    @endforeach
@else
    <p>中身からでした</p>
@endif
        </tr>
    </tbody>
</table>
{{ print_r( $input )}}

@endsection