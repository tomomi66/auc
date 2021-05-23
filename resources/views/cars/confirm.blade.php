@extends('layouts')

@section('contents')

<h3>確認画面</h3>
<table class="table">
    <thead>
        <tr>
            <th scope="col">カルテ番号</th>
            <th scope="col">車名</th>
            <th scope="col">認定型式</th>
            <th scope="col">年式：年</th>
            <th scope="col">年式：月</th>
            <th scope="col">グレード</th>
            <th scope="col">カラーＮＯ</th>
            <th scope="col">トリムＮＯ</th>
            <th scope="col">車体カラー</th>
            <th scope="col">シフト</th>
            <th scope="col">走行距離</th>
        </tr>
    </thead>
    <tbody>
        <tr>
@if (@isset($header))
    @foreach ($header[0] as $data)
        <td scope="col"> {{ $data }} </td>     
    @endforeach
@else
    <p>中身からでした</p>
@endif
        </tr>
    </tbody>
</table>
<h3>上下の表示が同じ場合DB登録をクリックしてください。</h3>
<p>違う場合誤作動を起こしますので、CSVファイルを作りなおしてください。</p>
@if (@isset($header))

{{ Form::open(['url' => route('car.store'), 'method' => 'POST', 'class' => '', 'files' => true]) }}
<button type="submit" class="btn btn-primary">DB登録</button>
{{ Form::close() }}

@endif
<br>

<a href=" {{ url('/') }}"><button type="button" class="btn btn-primary">TOPページ</button></a>
@endsection