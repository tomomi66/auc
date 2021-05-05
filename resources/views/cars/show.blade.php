@extends('layouts')

@section('contents')
    

        <h3>{{ $title }}</h3>

        <table>
            <tr>
                <td>車名</td>
                <td>{{$data->name}}</td>
            </tr>
            <tr>
                <td>入庫番号</td>
                <td>{{$data->in_number}}</td>
            </tr>
            <tr>
                <td>年式</td>
                <td>{{$data->made_data}}</td>
            </tr>
            <tr>
                <td>型式</td>
                <td>{{$data->model_type}}</td>
            </tr>
            <tr>
                <td>グレード</td>
                <td>{{$data->model_grade}}</td>
            </tr>
            <tr>
                <td>色</td>
                <td>{{$data->color}}</td>
            </tr>
            <tr>
                <td>カラーナンバー</td>
                <td>{{$data->color_no}}</td>
            </tr>
            <tr>
                <td>トリムナンバー</td>
                <td>{{$data->trim_no}}</td>
            </tr>
            <tr>
                <td>走行距離</td>
                <td>{{$data->mileage}}km</td>
            </tr>
        </table>
    
@endsection
