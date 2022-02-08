@extends('layouts')

@section('contents')

    <h2>{{ $title }}</h2>
    <div class="row">
        <table class="table">
            <tr>
                <td>車名：{{ $car->name }}</td>
                <td>カルテ番号：{{ $car->record_number }}</td>
            </tr>
        </table>
    </div>
    <div class="swiper">
        <div class="swiper-wrapper">
            @foreach ($fileNames as $item)
            <div class="swiper-slide"><img src="{{ asset('storage/save/'.$item) }}" width="500px"></div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
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
