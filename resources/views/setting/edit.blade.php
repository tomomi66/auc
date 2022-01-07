@extends('layouts')

@section('contents')
    <div class="container">
		<h1>ヤフオク設定変更画面</h1>
		<div class="col-12">
			
			<div class="general">
				<h3>{{ $title }}</h3>
				<a href="#"><button type="button" class="btn btn-primary btn-lg btn-lg">送料設定</button></a>
				<a href="#"><button type="button" class="btn btn-primary btn-lg btn-lg">送料地域設定</button></a>
			</div>
			
			<div class="general">
				<h3>詳細文字テンプレート</h3>
				<a href="#"><button type="button" class="btn btn-primary btn-lg btn-lg">詳細設定</button>
			</div>

		</div>
	</div>
@endsection