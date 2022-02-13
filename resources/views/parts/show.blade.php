@extends('layouts')

@section('contents')

    <h2>{{ $title }}</h2>
    <div class="row">
        <table class="table">
            <tr>
                <td>車名：{{ $parts->car_name }}</td>
                <td>カルテ番号：{{ $parts->record_number }}</td>
            </tr>
        </table>
    </div>
    <div class="swiper">
        <div class="swiper-wrapper">
            @foreach ($fileNames as $item)
                <div class="swiper-slide"><img src="{{ asset('storage/save/' . $item) }}" width="500px"></div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>

    <dl class="row">
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

        <dt class="col-sm-2">カテゴリ</dt>
        <dd class="col-sm-10">{{ $parts->category_name }}</dd>

        <dt class="col-sm-2">状態</dt>
        <dd class="col-sm-10">{{ $parts->condition }}</dd>

        <dt class="col-sm-2">動作状態</dt>
        <dd class="col-sm-10">
            @if ($parts->operating_status == 0 || $parts->operating_status == '')
                動作確認不要
            @else
                {{ $parts->operating_status }}
            @endif
        </dd>

        <dt class="col-sm-2">動作確認URL</dt>
        <dd class="col-sm-10">
            @if ($parts->video_url != '')
                {{ $parts->video_url }}
            @else
                なし
            @endif
        </dd>
    </dl>
    <dl class="row">
        @if (count(array_filter($tire)) > 0)
            <dt class="col-sm-2">タイヤサイズ</dt>
            <dd class="col-sm-10">
                {{ $tire[0] }}/{{ $tire[1] }}R{{ $tire[2] }}
            </dd>
            <dt class="col-sm-2">タイヤ本数</dt>
            <dd class="col-sm-10">{{ $tire[3] }}</dd>
            <dt class="col-sm-2">タイヤ製造年</dt>
            <dd class="col-sm-10">{{ $tire[4] }}</dd>
            <dt class="col-sm-2">タイヤメーカー</dt>
            <dd class="col-sm-10">{{ $tire[5] }}</dd>
        @endif
        @if (count(array_filter($wheel)) > 0)
            <dt class="col-sm-2">ホイールサイズ</dt>
            <dd class="col-sm-10">
                {{ $wheel[0] }}×{{ $wheel[1] }}J
            </dd>
            <dt class="col-sm-2">OFF/PCD/穴</dt>
            <dd class="col-sm-10">
                {{ $wheel[2] }}/{{ $wheel[3] }}/{{ $wheel[4] }}
            </dd>
            <dt class="col-sm-2">ハブ径/ハブ数</dt>
            <dd class="col-sm-10">
                {{ $wheel[5] }}/{{ $wheel[6] }}
            </dd>
            <dt class="col-sm-2">素材</dt>
            <dd class="col-sm-10">{{ $wheel[7] }}
        @endif
    </dl>
    <dl class="row">
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
    </div>
    <div class="card">
        <div class="card-body">
            <div class="card-title"><b>商品説明</b></div>
            <div class="card-text">{!! $parts->memo !!}</div>
        </div>
    </div>
    <a href={{ route('auction.create', ['id' => $parts->id]) }}><button type="button"
            class="btn btn-outline-primary btn-lg btn-sm">オークション登録</button>
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
