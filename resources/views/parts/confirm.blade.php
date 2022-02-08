@extends('layouts')

@section('contents')
    <table class="table">
        <tr>
            <td>車名：{{ $car->name }}</td>
            <td>カルテ番号：{{ $car->record_number }}</td>
        </tr>
    </table>
    {{ Form::open(['url' => route('parts.store'), 'method' => 'POST', 'class' => '']) }}
    @csrf
    {!! Form::hidden('id', $car->id) !!}

    <h2>{{ $inputData['titleName'] }}</h2>
    {!! Form::hidden('title', $inputData['titleName']) !!}
    <div class="swiper">
        <div class="swiper-wrapper">
            @foreach ($inputData['fileNames'] as $item)
                <div class="swiper-slide"><img src="{{ asset('storage/temp/' . $item) }}" width="500px"></div>
                {!! Form::hidden('fileNames[]', $item) !!}
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
    <div>
        <dl class="row">
            <dt class="col-sm-2">開始価格</dt>
            <dd class="col-sm-10">{{ $inputData['startPrice'] }}円</dd>

            <dt class="col-sm-2">即決価格</dt>
            <dd class="col-sm-10">
                @if ($inputData['pompDecision'] != '')
                    {{ $inputData['pompDecision'] }}
                @else
                    指定なし
                @endif
            </dd>

            <dt class="col-sm-2">カテゴリ</dt>
            <dd class="col-sm-10">{{ $inputData['category'] }}</dd>

            <dt class="col-sm-2">状態</dt>
            <dd class="col-sm-10">{{ $inputData['condition'] }}</dd>

            <dt class="col-sm-2">動作状態</dt>
            <dd class="col-sm-10">
                @if ($inputData['condition'] == 0)
                    動作確認不要
                @else
                    {{ $inputData['condition'] }}
                @endif
            </dd>

            <dt class="col-sm-2">動作確認URL</dt>
            <dd class="col-sm-10">
                @if ($inputData['url'] != '')
                    {{ $inputData['url'] }}
                @else
                    なし
                @endif
            </dd>
        </dl>
        <dl  class="row">
            @if (count(array_filter($inputData['tireWheel']['tire'])) > 0)
                <dt class="col-sm-2">タイヤサイズ</dt>
                <dd class="col-sm-10">
                    {{ $inputData['tireWheel']['tire'][0] }}/{{ $inputData['tireWheel']['tire'][1] }}R{{ $inputData['tireWheel']['tire'][2] }}
                </dd>
                <dt class="col-sm-2">タイヤ本数</dt>
                <dd class="col-sm-10">{{ $inputData['tireWheel']['tire']['count'] }}</dd>
                <dt class="col-sm-2">タイヤ製造年</dt>
                <dd class="col-sm-10">{{ $inputData['tireWheel']['tire']['year'] }}</dd>
            @endif
            @if (count(array_filter($inputData['tireWheel']['wheel'])) > 0)
                <dt class="col-sm-2">ホイールサイズ</dt>
                <dd class="col-sm-10">
                    {{ $inputData['tireWheel']['wheel'][1] }}×{{ $inputData['tireWheel']['wheel'][2] }}J
                </dd>
                <dt class="col-sm-2">OFF/PCD/穴</dt>
                <dd class="col-sm-10">
                    {{ $inputData['tireWheel']['wheel']['off'] }}/{{ $inputData['tireWheel']['wheel']['pcd'] }}/{{ $inputData['tireWheel']['wheel']['hole'] }}
                </dd>
                <dt class="col-sm-2">ハブ径/ハブ数</dt>
                <dd class="col-sm-10">
                    {{ $inputData['tireWheel']['wheel']['holehub'] }}/{{ $inputData['tireWheel']['wheel']['holehubC'] }}
                </dd>
                <dt class="col-sm-2">ハブ素材</dt>
                <dd class="col-sm-10">{{ $inputData['tireWheel']['wheel']['material'] }}
            @endif
        </dl>
        <dl  class="row">
            <dt class="col-sm-2">終了日</dt>
            <dd class="col-sm-10">{{ $inputData['finishDay'] }}日後</dd>

            <dt class="col-sm-2">終了時間</dt>
            <dd class="col-sm-10">{{ $inputData['finishHour'] }}時台</dd>
        </dl>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="card-title"><b>商品説明</b></div>
            <div class="card-text">{!! $inputData['memo'] !!}</div>
        </div>
    </div>
    <div class="form-row detail">
        <input name="submit" type="submit" value="登録" />
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
