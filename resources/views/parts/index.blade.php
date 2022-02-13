@extends('layouts')

@section('contents')


    <h3>{{ $title }}</h3>
    @include('parts.search')

    <h4>オークション登録前パーツ</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">入庫NO</th>
                <th scope="col">車名</th>
                <th scope="col">パーツ名</th>
                <th scope="col">状態</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($parts as $part)
                <tr>
                    <td></td>
                    <td>{{ $part->car->in_number }}</td>
                    <td>{{ $part->car->name }}</td>
                    <td>{{ $part->parts_name }}</td>
                    <td>{{ $part->status }}</td>
                    <td></td>
                    <td>
                        <a href={{ route('parts.show', ['id' => $part->id]) }}><button type="button"
                                class="btn btn-secondary btn-lg btn-sm">パーツ詳細</button></a>
                    </td>
                    <td>
                        <a href={{ route('auction.create', ['id' => $part->id]) }}><button type="button"
                            class="btn btn-secondary btn-lg btn-sm">オークション登録</button></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
