@extends('layouts')

@section('contents')

	<h1>ヤフオク共通設定変更</h1>
	{{ Form::open(['url' => route('setting.edit'), 'method' => 'POST', 'class' => '']) }}
	<button class="btn btn-primary "data-toggle="tooltip" data-placement="bottom"title="ボタンです">
	{!! Form::close() !!}

@endsection