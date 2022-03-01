@extends('layouts')

@section('contents')


    <h3>{{ $title }}</h3>
    @isset($message)
    <div class="row">
        <div class="col">
            {{$message}}
        </div>
    </div>
    @endisset
    
    <div class="row">
        <div class="col">
            <a href={{ route('auction.index', ['status' => 0]) }}>
                <button type="button" class="btn btn-outline-primary btn-lg">CSV未出力</button>
            </a>
        </div>
        <div class="col">
            <a href={{ route('auction.index', ['status' => 5]) }}>
                <button type="button" class="btn btn-outline-danger btn-lg">エラー</button>
            </a>
        </div>
        <div class="col">
            <a href={{ route('auction.index', ['status' => 9]) }}>
                <button type="button" class="btn btn-secondary btn-lg">出力済み</button>
            </a>
        </div>
    </div>
    <br>
    {!! Form::open(['url' => route('auction.csv'), 'method' => 'POST', 'class' => '', 'name' => 'csvput']) !!}
    <div class="row">
        @if (isset($aucData))
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">入庫NO</th>
                        <th scope="col">車名</th>
                        <th scope="col">パーツ名</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($aucData as $item)
                        <tr>
                            @if ($status == 0)
                                <td>
                                    <input type="checkbox" name="output[]" value="{{ $item->id }}">
                                </td>
                            @else
                                <td></td>
                            @endif
                            <td>{{ $item->number }}</td>
                            <td>{{ $item->car_name }}</td>
                            <td>{{ $item->parts_name }}</td>
                            <td>
                                <a href={{ route('auction.show', ['id' => $item->id]) }}>
                                    <button type="button" class="btn btn-secondary btn-lg btn-sm">
                                        オークション詳細
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
    <div class="form-group row justify-content-center">
        <input class="btn btn-primary btn-lg mx-auto d-block" name="submit" type="submit" value="CSV出力" />
    </div>
    {!! Form::close() !!}
@else
    <h4>該当のオークション情報はありません。</h4>
    @endif

@endsection
