@extends('layouts')

@section('contents')

<h3>{{ $title }}</h3>


{{-- CSVを取り込む表示 --}}
{{ Form::open(['url' => route('car.post'), 'method' => 'POST', 'class' => '', 'files' => true]) }}
@csrf
  <div class='form-group'>
    {!! Form::label('csvfile', 'CSVファイル') !!}
    {!! Form::file('csvfile', ['accept' => '.csv']) !!}
  </div>

  <button type="submit">csv読み込み</button>

  {{ Form::close() }}
  <a href=" {{ url('/') }}"><button type="button" class="btn btn-primary">TOPページ</button></a>
@endsection