@extends('layouts')

@section('contents')
    <div class="container">
		<h1>ヤフオク登録</h1>
		<div class="col-12">
			
			<div class="general">
				<h3>{{ $title }}</h3>
				<a href="{{ action('CarController@create') }}"><button type="button" class="btn btn-primary btn-lg btn-lg">車輌登録</button></a>
				<a href="{{ action('CarController@index') }}"><button type="button" class="btn btn-primary btn-lg btn-lg">車輌一覧</button></a>
			</div>
			
			<div class="general">
				<h3>ヤフオク商品</h3>
				<a href="#"><button type="button" class="btn btn-primary btn-lg btn-lg">商品一覧</button></a
			</div>

			
			<div class="general">
				<h3>ヤフオク基本設定</h3>
				<button type="button" class="btn btn-primary btn-lg btn-lg">ヤフオク基本設定</button>
			</div>
			
			<div class="general">
				<h3>システム設定</h3>
				<button type="button" class="btn btn-primary btn-lg btn-lg">ユーザー登録</button>
				<button type="button" class="btn btn-primary btn-lg btn-lg">ユーザー一覧</button>
			</div>
		</div>
	</div>
@endsection