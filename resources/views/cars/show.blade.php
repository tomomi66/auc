@extends('layouts')

@section('contents')
<div class="container">

        <h3>{{ $title }}</h3>

        <table class="table">
            <tr>
                <td>車名</td>
                <td>{{$car->name}}</td>
            </tr>
            <tr>
                <td>カルテ番号</td>
                <td>{{$car->record_number}}</td>
            </tr>
            <tr>
                <td>年式</td>
                <td>{{$car->made_year}}年 
                    @if($car->made_month == "不明") <span font-color="red"><b>不明</b></span> 
                    @else {{$car->made_month}}月
                    @endif
                </td>
            </tr>
            <tr>
                <td>型式</td>
                <td>{{$car->model_type}}</td>
            </tr>
            <tr>
                <td>グレード</td>
                <td>
                    @if($car->model_grade == "不明") <span font-color="red"><b>不明</b></span> 
                    @else {{$car->model_grade}}
                    @endif
                </td>
            </tr>
            <tr>
                <td>色</td>
                <td>
                    @if($car->color == "不明") <span font-color="red"><b>不明</b></span> 
                    @else {{$car->color}}
                    @endif
                </td>
            </tr>
            <tr>
                <td>カラーナンバー</td>
                <td>{{$car->color_no}}</td>
            </tr>
            <tr>
                <td>トリムナンバー</td>
                <td>{{$car->trim_no}}</td>
            </tr>
            <tr>
                <td>走行距離</td>
                <td>
                    @if($car->mileage == "不明") <span font-color="red"><b>9999999</b></span> 
                    @else {{$car->mileage}}
                    @endif
                    km
                </td>
            </tr>
            <tr>
                <td> パーツ登録数</td>
                <td> {{ count($parts) }}</td>
            </tr>
            <tr>
                <td> 登録パーツ</td>
                <td> 
                    @if(count($parts) > 0)
                        @foreach ($parts as $item)
                            {{ $item }} <br>
                        @endforeach
                    @else
                        なし
                    @endif

                </td>
            </tr>
        </table>
        <a href={{ route('car.edit', ['id' =>  $car->id]) }}><button type="button" class="btn btn-outline-primary btn-lg btn-sm">詳細編集</button></a>
        {{-- <a href={{ route('parts.create', ['id' =>  $car->id]) }}><button type="button" class="btn btn-outline-primary btn-lg btn-sm">パーツ登録</button> --}}
        <a href={{ route('car.index') }}><button type="button" class="btn btn-outline-primary btn-lg btn-sm">一覧に戻る</button></a>

        </div>
@endsection
