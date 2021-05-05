@extends('layouts')

@section('contents')
    

        <h3>{{ $title }}</h3>

        <table>
            <tr>
                <td>車名</td>
                <td>{{$car->name}}</td>
            </tr>
            <tr>
                <td>入庫番号</td>
                <td>{{$car->in_number}}</td>
            </tr>
            <tr>
                <td>年式</td>
                <td>{{$car->made_data}}</td>
            </tr>
            <tr>
                <td>型式</td>
                <td>{{$car->model_type}}</td>
            </tr>
            <tr>
                <td>グレード</td>
                <td>{{$car->model_grade}}</td>
            </tr>
            <tr>
                <td>色</td>
                <td>{{$car->color}}</td>
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
                <td>{{$car->mileage}}km</td>
            </tr>
        </table>
        <a href={{ route('car.edit', ['id' =>  $car->id]) }}><button type="button" class="btn btn-outline-primary btn-lg btn-sm">詳細編集</button></a>
        <a href={{ route('car.index') }}><button type="button" class="btn btn-outline-primary btn-lg btn-sm">一覧に戻る</button>

    
@endsection
