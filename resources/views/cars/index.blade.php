@extends('layouts')

@section('contents')
    

        <h3>{{ $title }}</h3>
        @include('cars.search')

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">登録完了</th>
                    <th scope="col">入庫No.</th>
                    <th scope="col">車名</th>
                    <th scope="col">登録部品数</th>
                    <th scope="col">登録部品</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cars as $data)
                <tr>
                    <th scope="row">1</th>
                    <td><input name="Checkbox1" type="checkbox" /></td>
                    <td>{{ $data['in_number'] }}</td>
                    <td>{{ $data['name'] }}</td>
                    <td>5点</td>
                    <td>パーツいろいろ</td>
                    <td><a href={{ route('car.show', ['id' =>  $data->id]) }}><button type="button" class="btn btn-primary btn-lg btn-sm">車両詳細</button></a></td>
                    <td><a href="product_registration.html"><button type="button" class="btn btn-primary btn-lg btn-sm">商品登録</button></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $cars->links() }}
@endsection