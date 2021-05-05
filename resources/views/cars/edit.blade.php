@extends('layouts')

@section('contents')

<h3>{{ $title }}</h3>


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

{{ Form::model($car, ['route' => ['car.update', $car->id]]) }}
@csrf

<div class="form-row detail">
    <div class="form-group col-md-6" style="left: 0px; top: 0px">
        {!! Form::label('in_number', '入庫No', ['for' => 'exampleFormControlInput10']) !!}
        {!! Form::text('in_number', null, ['class' => "form-control", 'id' => 'exampleFormControlInput1','disabled']) !!}
    </div>
</div>
<div class="form-row detail">
    <div class="form-group col-md-4">
        {!! Form::label('name', '車名', ['for' => 'exampleFormControlInput10']) !!}
        {!! Form::text('name', null, ['class' => "form-control", 'id' => 'exampleFormControlInput3','disabled']) !!}
    </div>
    <div class="form-group col-md-4">
        {!! Form::label('model_type', '型式', ['for' => 'exampleFormControlInput10']) !!}
        {!! Form::text('model_type', null, ['class' => "form-control", 'id' => 'exampleFormControlInput4','disabled']) !!}
    </div>
    <div class="form-group col-md-4">
        {!! Form::label('made_date', '年式', ['for' => 'exampleFormControlInput10']) !!}
        {!! Form::text('made_date', null, ['class' => "form-control", 'id' => 'exampleFormControlInput5','disabled']) !!}
    </div>
</div>
<div class="form-row detail">
    <div class="form-group col-md-4">
        {!! Form::label('model_grade', 'グレード', ['for' => 'exampleFormControlInput10']) !!}
        {!! Form::text('model_grade', null, ['class' => "form-control", 'id' => 'exampleFormControlInput6']) !!}
    </div>
</div>
<div class="form-row detail">
    <div class="form-group col-md-4">
        {!! Form::label('color', '色', ['for' => 'exampleFormControlInput10']) !!}
        {!! Form::text('color', null, ['class' => "form-control", 'id' => 'exampleFormControlInput3']) !!}
    </div>
    <div class="form-group col-md-4">
        {!! Form::label('color_no', 'カラーNo.', ['for' => 'exampleFormControlInput10']) !!}
        {!! Form::text('color_no', null, ['class' => "form-control", 'id' => 'exampleFormControlInput10']) !!}
    </div>
    <div class="form-group col-md-4">
        {!! Form::label('trim_no', 'トリムNo.', ['for' => 'exampleFormControlInput10']) !!}
        {!! Form::text('trim_no', null, ['class' => "form-control", 'id' => 'exampleFormControlInput5']) !!}
    </div>
    <div class="form-group col-md-4">
        {!! Form::label('mileage', '走行距離', ['for' => 'exampleFormControlInput10']) !!}
        {!! Form::text('mileage', null, ['class' => "form-control", 'id' => 'exampleFormControlInput5']) !!}
    </div>
</div>	
{{ Form::submit('更新する', ['class' => 'btn btn-outline-primary']) }}
{{ Form::close() }}
<a href={{ route('car.index') }}>一覧に戻る</a>
@endsection