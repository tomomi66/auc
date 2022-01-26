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
    <div class="swiper">
        <div class="swiper-wrapper">
            @foreach ($inputData['fileNames'] as $item)
            <div class="swiper-slide"><img src="{{ asset('storage/temp/'.$item) }}" width="500px"></div>
            {!! Form::hidden('fileNames[]', $item) !!}
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>

    {!! Form::close() !!}

@endsection

@section('pagejs')
<script>
    let swiper = new Swiper('.swiper', {
        // Optional parameters
        // direction: 'vertical',
        loop: true,

        // If we need pagination
        pagination: {
            el: '.swiper-pagination',
        },

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>
@endsection
