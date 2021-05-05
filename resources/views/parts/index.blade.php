@extends('layouts')

@section('contents')
    

        <h3>{{ $title }}</h3>
        @include('parts.search')

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
                
            </tbody>
        </table>

@endsection