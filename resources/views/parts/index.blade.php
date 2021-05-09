@extends('layouts')

@section('contents')
    

        <h3>{{ $title }}</h3>
        @include('parts.search')


        <table class="table">
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
                <tr>
                    @foreach ($parts as $part)
                    <td></td>
                    <td>{{ $part->car->in_number }}</td>
                    <td>{{ $part->car->name }}</td>    
                    <td>{{ $part->parts_name }}</td>
                    <td>{{ $part->status }}</td>
                    <td></td>
                    <td></td>
                    <td></td>    
                    @endforeach
                </tr>
            </tbody>
        </table>

@endsection