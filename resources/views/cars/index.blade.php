@extends('layouts')

@section('contents')
    

        <h3>{{ $title }}</h3>
        @include('cars.search')
        {{ Form::open(['action'=>'CarController@statusEnd', 'method' => 'post']) }}
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <td scope="col">カルテNo.</td>
                    <td scope="col">車名</td>
                    <td scope="col"></td>
                    <td scope="col"></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($cars as $key=>$data)
                <tr>
                    <th scope="row">{!! Form::checkbox("delte", $data->id, false,['class' => 'form-check-input']) !!}</th>
                    <td>{{ $data['record_number'] }}</td>
                    <td>{{ $data['name'] }}</td>
                    <td><a href={{ route('car.show', ['id' =>  $data->id]) }}><button type="button" class="btn btn-secondary btn-lg btn-sm">車両詳細</button></a></td>
                    <td></td>
                    {{-- <td><a href={{ route('parts.create', ['id' =>  $data->id]) }}><button type="button" class="btn btn-outline-primary btn-lg btn-sm">パーツ登録</button></a></td> --}}
                </tr>
                @endforeach
            </tbody>
        </table>
        {!! Form::submit('完了登録', ['class' => 'btn btn-outline-info']) !!}
        {{ Form::close() }}
        <br><br><br>
        {{ $cars->links() }}
    </div>
@endsection