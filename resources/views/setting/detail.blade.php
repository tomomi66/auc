@extends('layouts')

@section('contents')
    <div class="container">
        <h1>ヤフオク詳細設定</h1>
        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        {{ Form::open(['url' => route('setting.update'), 'method' => 'POST', 'class' => '']) }}
        @csrf
        <div class="row">
            <div class="col-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">設定名</th>
                            <th scope="col">現在設定</th>
                            <th scope="col">修正</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>発送元</td>
                            <td>{{ $data->from_prefecture }}</td>
                            <td>
                                {{ Form::text('from_prefecture', $data->from_prefecture, ['class' => 'form-control']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>発送元（市区町村）</td>
                            <td>{{ $data->from_prefecture }}</td>
                            <td>
                                {{ Form::text('from_city', $data->from_city, ['class' => 'form-control']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>送料負担</td>
                            <td>{{ $data->fee_burden }}</td>
                            <td>
                                {{ Form::select('fee_burden', ['落札者' => '落札者', '出品者' => '出品者'], ['class' => 'form-control']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>支払方法(後払い先払い）</td>
                            <td>{{ $data->pay_method }}</td>
                            <td>
                                {{ Form::select('pay_method',['代金先払い' => '代金先払い', '代金後払い' => '代金後払い'],['class' => 'form-control']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>最低評価</td>
                            <td>{{ $data->min_rate }}</td>
                            <td>
                                {{ Form::select('min_rate', ['0' => 0, '-5' => -5], ['class' => 'form-control']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>悪評価割合制限</td>
                            <td>{{ $data->evil_rate_limit }}</td>
                            <td>
                                {{ Form::select('evil_rate_limit', ['はい' => 'はい', 'いいえ' => 'いいえ'], ['class' => 'form-control']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>入札者認証制限</td>
                            <td>{{ $data->authen_limit }}</td>
                            <td>
                                {{ Form::select('authen_limit', ['はい' => 'はい', 'いいえ' => 'いいえ'], ['class' => 'form-control']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>自動延長</td>
                            <td>{{ $data->auto_extend }}</td>
                            <td>
                                {{ Form::select('auto_extend', ['はい' => 'はい', 'いいえ' => 'いいえ'], ['class' => 'form-control']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>商品の自動再出品</td>
                            <td>{{ $data->auto_listing }}</td>
                            <td>
                                {{ Form::select('auto_listing', [0 => 0, 1 => 1, 2 => 2, 3 => 3], ['class' => 'form-control']) }}
                            </td>
                        </tr>
                        {{-- <tr>
                            <td>注目のオークション</td>
                            <td>{{ $data->featured_action }}</td>
                            <td>
                                {{ Form::text('featured_action', $data->featured_action, ['class' => 'form-control']) }}
                            </td>
                        </tr> --}}
                        <tr>
                            <td>消費税設定</td>
                            <td>{{ $data->tax_preference }}%</td>
                            <td>
                                {{ Form::select('tax_preference', [10 => 10, 8 => 8, 0 => 0], ['class' => 'form-control']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>税込み設定フラグ</td>
                            <td>{{ \App\Consts\YahuokuConsts::SETTING_TAX[$data->in_tax_setting_flg] }}</td>
                            <td>
                                {{ Form::select('in_tax_setting_flg',[1 => \App\Consts\YahuokuConsts::SETTING_TAX[1], 0 => \App\Consts\YahuokuConsts::SETTING_TAX[0]],['class' => 'form-control']) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-row detail">
                    <div class="form-group col-md-12">
                        <h5 class="card-header">上段商品説明</h5>
                        <div class="card">
                            <div class="card-body">
                                {!! $data->comment1 !!}
                            </div>
                        </div>
                        <div>
                            <a class="btn btn-outline-primary" data-toggle="collapse" href="#comment1" role="button" aria-expanded="false"
                                aria-controls="comment1"><label for="comment1">上段商品説明修正</label></a>
                        </div>
                        <div class="collapse" id="comment1">
                        {!! Form::textarea('comment1', $data->comment1, ['class' => 'form-control', 'id' => 'summernote']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-row detail">
                    <div class="form-group col-md-12">
                        <h5 class="card-header">中段商品説明</h5>
                        <div class="card">
                            <div class="card-body">
                                {!! $data->comment2 !!}
                            </div>
                        </div>
                        <div>
                            <a class="btn btn-outline-primary" data-toggle="collapse" href="#comment2" role="button" aria-expanded="false"
                                aria-controls="comment2"><label for="comment2">中段商品説明修正</label></a>
                        </div>
                        <div class="collapse" id="comment2">
                        {!! Form::textarea('comment2', $data->comment2, ['class' => 'form-control', 'id' => 'summernote1']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-row detail">
                    <div class="form-group col-md-12">
                        <h5 class="card-header">下段商品説明</h5>
                        <div class="card">
                            <div class="card-body">
                                {!! $data->comment3 !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <a class="btn btn-outline-primary" data-toggle="collapse" href="#comment3" role="button" aria-expanded="false"
                        aria-controls="comment3"><label for="comment3">下段商品説明修正</label></a>
                </div>
                <div class="collapse" id="comment3">
                {!! Form::textarea('comment3', $data->comment3, ['class' => 'form-control', 'id' => 'summernote2']) !!}
                </div>
            </div>
        </div>
        <div class="form-row detail">
            {{ Form::submit('設定登録', ['class' => 'btn btn-primary']) }}
        </div>
        {!! Form::close() !!}
    </div>
    <script>
        // テキストエディタ用
        $(document).ready(function() {
            $('#summernote').summernote({
                lang: 'ja-JP',
                height: 300,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                ],
            });
        });
        $(document).ready(function() {
            $('#summernote1').summernote({
                lang: 'ja-JP',
                height: 300,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                ],
            });
        });
        $(document).ready(function() {
            $('#summernote2').summernote({
                lang: 'ja-JP',
                height: 300,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                ],
            });
        });
    </script>
@endsection
