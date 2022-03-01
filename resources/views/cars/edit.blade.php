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
        {!! Form::label('record_number', 'カルテNo', ['for' => 'record_number']) !!}
        {!! Form::text('record_number', null, ['class' => "form-control", 'id' => 'record_number']) !!}
    </div>
</div>
<div class="form-row detail">
    <div class="form-group col-md-4">
        {!! Form::label('name', '車名', ['for' => 'name0']) !!}
        {!! Form::text('name', null, ['class' => "form-control", 'id' => 'name']) !!}
    </div>
    <div class="form-group col-md-4">
        {!! Form::label('model_type', '型式', ['for' => 'model_type']) !!}
        {!! Form::text('model_type', null, ['class' => "form-control", 'id' => 'model_type']) !!}
    </div>
    <div class="form-group col-md-2">
        {!! Form::label('made_year', '年式-年', ['for' => 'made_year']) !!}
        {!! Form::text('made_year', null, ['class' => "form-control", 'id' => 'made_year']) !!}
    </div>
    <div class="form-group col-md-2">
        {!! Form::label('made_month', '年式-月', ['for' => 'made_month']) !!}
        {!! Form::text('made_month', null, ['class' => "form-control", 'id' => 'made_month']) !!}
    </div>
</div>
<div class="form-row detail">
    <div class="form-group col-md-4">
        {!! Form::label('model_grade', 'グレード', ['for' => 'model_grade']) !!}
        {!! Form::text('model_grade', null, ['class' => "form-control", 'id' => 'model_grade']) !!}
    </div>
    <div class="form-group col-md-4">
        {!! Form::label('mileage', '走行距離', ['for' => 'mileage']) !!}
        {!! Form::text('mileage', null, ['class' => "form-control", 'id' => 'mileage']) !!}
    </div>
    <div class="form-group col-md-4">
        {!! Form::label('gear_shift', 'シフト', ['for' => 'gear_shift']) !!}
        {!! Form::text('gear_shift', null, ['class' => "form-control", 'id' => 'gear_shift']) !!}
    </div>
</div>
<div class="form-row detail">
    <div class="form-group col-md-4">
        {!! Form::label('color', '色', ['for' => 'color']) !!}
        {!! Form::text('color', null, ['class' => "form-control", 'id' => 'color']) !!}
    </div>
    <div class="form-group col-md-4">
        {!! Form::label('color_no', 'カラーNo.', ['for' => 'color_no']) !!}
        {!! Form::text('color_no', null, ['class' => "form-control", 'id' => 'color_no']) !!}
    </div>
    <div class="form-group col-md-4">
        {!! Form::label('trim_no', 'トリムNo.', ['for' => 'trim_no']) !!}
        {!! Form::text('trim_no', null, ['class' => "form-control", 'id' => 'trim_no']) !!}
    </div>
    
</div>	
{{ Form::submit('更新する', ['class' => 'btn btn-outline-primary']) }}
{{ Form::close() }}
<a href={{ route('car.index') }}>一覧に戻る</a>
@endsection