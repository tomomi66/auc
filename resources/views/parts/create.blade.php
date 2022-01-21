@extends('layouts')

@section('contents')
    <h1>{{ $title }}</h1>

    <table class="table">
        <tr>
            <td>車名：{{ $car->name }}</td>
            <td>カルテ番号：{{ $car->record_number }}</td>
            <td>型式：{{ $car->model_type }}</td>
        </tr>
        <tr>
            <td>色：{{ $car->color }}</td>
            <td>カラーナンバー：{{ $car->color_no }}</td>
            <td>グレード：{{ $car->model_grade }}</td>
        </tr>
        <tr>
            <td>走行距離：{{ $car->mileage }}</td>
            <td>シフト：{{ $car->gear_shift }}</td>
            <td>年式：{{ $car->made_year }}年{{ $car->made_month }}月</td>
        </tr>
    </table>

    @if ($errors->any())
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>    
    @endif
    {{ Form::open(['url' => route('parts.post'), 'method' => 'POST', 'class' => '', 'files' => true]) }}
    @csrf
    {!! Form::hidden('id', $car->id, old('id')) !!}
    <div class="container">
        <div class="form-row detail">
            <div class="form-group col-md-6">
                <label for="storage_no">
                    棚番
                    <a href="" class="tooltip_target"><img src="{{ asset('img/icons/question-circle.svg') }}" ></a>
                    
                </label>
                <input type="text" class="form-control" id="storage_no" name="storage_no" value="{{ old('strage_no') }}" required>
            </div>
            <div class="form-group col-md-6">
                <label for="parts_name">
                    部品名
                    <button aria-label="部品名を入力" data-microtip-position="top-right" role="tooltip" class="btn btn-light btn-sm">
                        <img src="{{ asset('img/icons/question-circle.svg') }}" >
                    </button>
                </label>
                <input type="text" class="form-control" id="parts_name" name="parts_name" value="{{ old('parts_name') }}"  required>
            </div>
            <div class="form-group col-md-6">
                <label for="parts_makers">
                    部品メーカー名
                    <button aria-label="部品メーカー（純正の場合は「トヨタ純正」と入れる）" data-microtip-position="top-right" role="tooltip" class="btn btn-light btn-sm">
                        <img src="{{ asset('img/icons/question-circle.svg') }}" >
                    </button>
                </label>
                <input type="text" class="form-control" id="parts_makers" name="parts_makers" value="{{ old('parts_makers') }}">
            </div>
            <div class="form-group col-md-6">
                <label for="parts_makers_no">
                    部品メーカー番号
                    <button aria-label="部品番号があれば入力" data-microtip-position="top-right" role="tooltip" class="btn btn-light btn-sm">
                        <img src="{{ asset('img/icons/question-circle.svg') }}" >
                    </button>
                </label>
                <input type="text" class="form-control" id="parts_makers_no" name="parts_makers_no" value="{{ old('parts_makers_no') }}">
            </div>
        </div>

        <div class="form-row detail">
            <div class="form-group col-md-12">
                <label for="category">
                    カテゴリ
                    <button aria-label="カテゴリ検索を検索" data-microtip-position="top-right" role="tooltip" class="btn btn-light btn-sm">
                        <img src="{{ asset('img/icons/question-circle.svg') }}" >
                    </button>
                </label>
            </div>
            <div class="form-group col-md-8">
                <input type="text" class="form-control" id="category" name="category" value="{{ old('category')}}" readonly>
            </div>
            <div class="form-group col-md-6">
                <input type="button" id="searchCategory" class="btn btn-warning" value="カテゴリ検索">
            </div>
        </div>
<br>
        <div class="form-row detail">
            <div class="form-group col-md-8">
                <label for="title">タイトル</label>　<input type="button" id="buildTitle" class="btn btn-warning btn-sm" value="タイトル自動生成">
                <button aria-label="自動生成ボタンをクリックしてから編集" data-microtip-position="top-right" role="tooltip" class="btn btn-light btn-sm">
                    <img src="{{ asset('img/icons/question-circle.svg') }}" >
                </button>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                <p id=count>あと<span id="charaLeft"></span>文字</p>
            </div>
            
        </div>
    <!--
        <div class="form-row detail">
            <div class="form-group col-md-12">
                <label for="exampleFormControlInput1">タイトル</label>
                <input class="form-control" id="exampleFormControlInput1">
            </div>
        </div>
        -->


    <div>
        <a class="btn btn-primary" data-toggle="collapse" href="#tire_wheel" role="button" aria-expanded="false"
            aria-controls="tire_wheel">タイヤホイール</a>
    </div>
    <div class="collapse" id="tire_wheel">
        <div class="card card-body">
            <div class="form-row detail">
                <div class="form-group col-md-4 row">
                    <div class="col">
                        <label for="starting_price">ホイール</label>
                        <div class="form-inline">
                            <input type="text" class="form-control col-md-2" id="hoile1" name="hoile1">&emsp;x&emsp;<input type="text" class="form-control col-md-2" id="hoile2">
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <label for="starting_price">OFF</label>
                    <input type="text" class="form-control" id="starting_price">
                </div>
                <div class="form-group col-md-2">
                    <label for="starting_price">PCD</label>
                    <input type="text" class="form-control" id="starting_price">
                </div>
                <div class="form-group col-md-2">
                    <label for="starting_price">穴</label>
                    <input type="text" class="form-control" id="starting_price">
                </div>
            </div>
            <div class="form-row detail">
                <div class="form-group col-md-3">
                    <label for="starting_price">ハブ径</label>
                    <input type="text" class="form-control" id="starting_price">
                </div>
                <div class="form-group col-md-3">
                    <label for="starting_price">本数</label>
                    <input type="text" class="form-control" id="starting_price">
                </div>
                <div class="form-group col-md-3">
                    <div>
                        <label for="material">材質</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="material" id="material" value="鉄">
                        <label class="form-check-label" for="鉄">鉄</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="material" id="material" value="アルミ">
                        <label class="form-check-label" for="アルミ">アルミ</label>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
<br>
    <div class="form-row detail">
        <fieldset class="form-group">
            <div class="row">
                <legend class="col-form-label col-sm-2 pt-0">状態</legend>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="condition" id="condition" value="新品、未使用" {{ old('condition', "新品、未使用") == "新品、未使用" ? 'checked' : '' }}>
                        <label class="form-check-label" for="新品、未使用">新品、未使用</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="condition" id="condition" value="未使用に近い" {{ old('condition', "未使用に近い") == "未使用に近い" ? 'checked' : '' }}>
                        <label class="form-check-label" for="未使用に近い">未使用に近い</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="condition" id="condition" value="目立った傷や汚れなし" {{ old('condition', "目立った傷や汚れなし") == "目立った傷や汚れなし" ? 'checked' : '' }}>
                        <label class="form-check-label" for="目立った傷や汚れなし">目立った傷や汚れなし</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="condition" id="condition" value="やや傷や汚れあり" {{ old('condition', "やや傷や汚れあり") == "やや傷や汚れあり" ? 'checked' : '' }}>
                        <label class="form-check-label" for="やや傷や汚れあり">やや傷や汚れあり</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="condition" id="condition" value="傷や汚れあり" {{ old('condition', "傷や汚れあり") == "傷や汚れあり" ? 'checked' : '' }}>
                        <label class="form-check-label" for="傷や汚れあり">傷や汚れあり</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="condition" id="condition" value="全体的に状態が悪い" {{ old('condition', "全体的に状態が悪い") == "全体的に状態が悪い" ? 'checked' : '' }}>
                        <label class="form-check-label" for="全体的に状態が悪い">全体的に状態が悪い</label>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="form-row detail">
        <fieldset class="form-group">
            <div class="row">
                <legend class="col-form-label col-sm-2 pt-0">動作状態</legend>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="operating_status" id="operating_status1" value="動作確認済み" {{ old('operating_status', "動作確認済み") == "動作確認済み" ? 'checked' : '' }}>
                        <label class="form-check-label" for="operating_status1">動作確認済</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="operating_status" id="operating_status2" value="動作未確認" {{ old('operating_status', "動作未確認") == "動作未確認" ? 'checked' : '' }}>
                        <label class="form-check-label" for="operating_status2">動作未確認</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="operating_status" id="operating_status3" value="ジャンク品" {{ old('operating_status', "ジャンク品") == "ジャンク品" ? 'checked' : '' }}>
                        <label class="form-check-label" for="operating_status2">ジャンク品</label>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="form-row detail">
        <div class="form-group col-md-10">
            <label for="check_video">動作確認動画URL</label>
            <input type="text" class="form-control" name="video_url" id="video_url" placeholder="https://">
        </div>
    </div>
    <div class="form-row detail">
            <div class="form-group col-md-6">
                <label class="form-check-label" for="shipping">送料区分</label>
                <select class="form-control" id="shipping" name="shipping">
                    <option value="2" selected>A</option>
                    <option value="3" @if(3 === (int)old('shipping')) selected @endif>B</option>
                    <option value="4" @if(4 === (int)old('shipping')) selected @endif>C</option>
                    <option value="5" @if(5 === (int)old('shipping')) selected @endif>D</option>
                    <option value="6" @if(6 === (int)old('shipping')) selected @endif>E</option>
                    <option value="7" @if(7 === (int)old('shipping')) selected @endif>F</option>
                    <option value="8" @if(8 === (int)old('shipping')) selected @endif>ネコポス</option>
                </select>
            </div>
    </div>
    <div class="form-row detail">
        <div class="form-group col-md-6">
            <label for="starting_price">開始価格</label>
            <input type="number" class="form-control" id="starting_price" name="starting_price" value="{{ old('starting_price') }}"  required>
        </div>
        <div class="form-group col-md-6">
            <label for="pompt_decision">即決価格</label>
            <input type="number" class="form-control" id="pompt_decision" name="pompt_decision" value="{{ old('pompt_decision') }}">
        </div>
    </div>
    <div class="form-row detail">
        <div class="form-group col-md-12">
            <label for="memo">商品説明</label>
            {!! Form::textarea('memo', old('memo'), ['class' => 'form-control', 'id' => 'summernote']) !!}
        </div>
    </div>
    <div class="form-row detail">
        <div class="form-group col-md-6">
            <label for="images">登録画像(複数枚選択できます）</label><br>
            <input type="file" name="images[]" accept="image/*" multiple onchange="loadImage(this);" value="{{old("images[]")}}"  required>
        </div>
        <div class="col-md-12" id="preview"></div>
    </div>

    <div class="form-row detail">
        <input name="Submit1" type="submit" value="登録" /><input name="Reset1" type="reset" value="reset" />
    </div>
    {!! Form::close() !!}
@endsection

@section('pagejs')
    <script>
        // カテゴリ検索ポップアップ
        $("#searchCategory").on("click", function(){
            var swin = window.open("{{ route('category.search') }}", "subWindow", "scrollbars=yes, width=600, height=500");
            swindow.focus();
        });

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

        // タイトル自動生成
        $("#buildTitle").on("click", function(){
            var title4 = document.getElementById("parts_name");
            var title5 = document.getElementById("parts_makers");
            var title6 = document.getElementById("parts_makers_no");
            var concatTitle = "{{ $car->name }}" + "{{ $car->model_grade }}" + "{{ $car->model_type }}" + title4.value + title5.value + title6.value;
            var titleText = document.getElementById("title");
            titleText.value = concatTitle + "{{ $car->color_no }}" + "{{ $car->recode_number }}";
        });

        // タイトル文字数制限
        $(function(){
            $("#title").on("keydown keyup keypress change focus", function(){
            let count = $(this).val().length;
            let limit = 65 - count;
            $("#charaLeft").text(limit);
            })
        });

        // 複数画像読み込み用
        function loadImage(obj) {
            for (i = 0; i < obj.files.length; i++) {
                var fileReader = new FileReader();
                fileReader.onload = (function(e) {
                    document.getElementById('preview').innerHTML += '<img src="' + e.target.result + '" width="150px">';
                });
                fileReader.readAsDataURL(obj.files[i]);
            }
        }
    </script>
@endsection
