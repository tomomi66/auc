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
                @foreach ($cars as $key=>$data)
                <tr>
                    <th scope="row">{{ $key+1 }}</th>
                    <td></td>
                    <td>{{ $data['in_number'] }}</td>
                    <td>{{ $data['name'] }}</td>
                    <td>{{ count($data->part) }}</td>
                    <td>
                        @foreach ($data->part as $parts)
                            {{ ($parts->parts_name)."　"}}
                        @endforeach
                    </td>
                    <td><a href={{ route('car.show', ['id' =>  $data->id]) }}><button type="button" class="btn btn-secondary btn-lg btn-sm">車両詳細</button></a></td>
                    <td><a href={{ route('parts.create', ['id' =>  $data->id]) }}><button type="button" class="btn btn-outline-primary btn-lg btn-sm">パーツ登録</button></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $cars->links() }}
@endsection