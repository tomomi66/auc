@extends('layouts')

@section('contents')
    <h3>{{ $title }}</h3>
    {!! Form::open(['url' => route('auction.store'), 'method' => 'POST', 'class' => '', 'name' => 'auctionRegist']) !!}
    {!! Form::hidden('id', $id) !!}
    <h4>車両：{{ $parts->name }}　パーツ：{{ $parts->parts_name }}</h4>
    <hr>

    <dl class="row">
        <dt class="col-sm-2">タイトル</dt>
        <dd class="col-sm-10">{{ $parts->title }}</dd>

        <dt class="col-sm-2">カテゴリ</dt>
        <dd class="col-sm-10">{{ $parts->category_name }}</dd>

        <dt class="col-sm-2">開始価格</dt>
        <dd class="col-sm-10">{{ $parts->starting_price }}円</dd>

        <dt class="col-sm-2">即決価格</dt>
        <dd class="col-sm-10">
            @if ($parts->pompt_decision != '')
                {{ $parts->pompt_decision }}円
            @else
                指定なし
            @endif
        </dd>

        <dt class="col-sm-2">状態</dt>
        <dd class="col-sm-10">{{ $parts->condition }}</dd>

        @if ($parts->finish_day != '')
            <dt class="col-sm-2">終了日</dt>
            <dd class="col-sm-10">{{ $parts->finish_day }}日後</dd>
        @else
            <dt class="col-sm-2">終了日</dt>
            <dd class="col-sm-10">指定なし</dd>
        @endif

        @if ($parts->finish_hour != '')
            <dt class="col-sm-2">終了時間</dt>
            <dd class="col-sm-10">{{ $parts->finish_hour }}時台</dd>
        @else
            <dt class="col-sm-2">終了時間</dt>
            <dd class="col-sm-10">指定なし</dd>
        @endif
    </dl>

    <div class="card">
        <div class="card-body">
            <div class="card-title"><b>商品説明</b></div>
            <div class="card-text">{!! $aucData['memo'] !!}</div>
            {!! Form::hidden('discript', $aucData['memo']) !!}
        </div>
    </div>
    <div class="swiper">
        <div class="swiper-wrapper">
            @foreach ($aucData['fileNames'] as $item)
                <div class="swiper-slide"><img src="{{ asset('storage/save/' . $item) }}" width="500px"></div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
    <br>
    <div class="form-group row justify-content-center">
        <input class="btn btn-primary btn-lg mx-auto d-block" name="submit" type="submit" value="オークション登録" />
    </div>
    {!! Form::close() !!}
@endsection

@section('pagejs')
    <script>
        let swiper = new Swiper('.swiper', {
            // Optional parameters
            // direction: 'vertical',
            loop: true,

            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>
@endsection
