@extends('layouts')

@section('contents')

<h3>{{ $title }}</h3>


{{-- CSVを取り込む表示 --}}
{{ Form::open(['url' => route('car.importCSV'), 'method' => 'POST', 'class' => '', 'files' => true]) }}

  <div class='form-group'>
    <input type="file" name="file" value="">
    <input type="hidden" value="1">
  </div>

  <button type="submit">csv読み込み</button>

  {{ Form::close() }}

@endsection