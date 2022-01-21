@extends('layouts')

@section('contents')
<table class="table">
    <tr>
        <td>車名：{{ $car->name }}</td>
        <td>カルテ番号：{{ $car->record_number }}</td>
    </tr>
</table>
{{ Form::open(['url' => route('parts.store'), 'method' => 'POST', 'class' => '']) }}
@csrf
{!! Form::hidden('id', $car->id) !!}

<h2>{{ $inputData['titleName'] }}</h2>
{!! Form::hidden('title', $inputData['titleName']) !!}


{!! Form::close() !!}

@endsection