@extends('layouts')

@section('contents')
<h1>{{ $title }}</h1>

<table class="table">
    <tr>
        <td >車名：{{ $car->name }}</td>
        <td>カルテ番号：{{ $car->recode_number }}</td>
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

<h3>登録済みパーツ</h3>


<script>
    function loadImage(obj)
    {
        
        for (i = 0; i < obj.files.length; i++) {
            var fileReader = new FileReader();
            fileReader.onload = (function (e) {
                document.getElementById('preview').innerHTML += '<img src="' + e.target.result + '">';
            });
            fileReader.readAsDataURL(obj.files[i]);
        }
    }
</script>
<div class="form-row detail">
    <div class="alert alert-primary col-md-12" role="alert">
    <h4>登録済み部品</h4>
    ドア・ナビ・フロント・ドアミラー・シート
    </div>
</div>
{{ Form::open(['url' => route('parts.post'), 'method' => 'POST', 'class' => '', 'files' => true]) }}
<div class="container">
    
        <div class="form-row detail">
            <div class="form-group col-md-6">
                <label for="storage_no">棚番</label>
                <input class="form-control" id="storage_no">
            </div>
            <div class="form-group col-md-4">
                <label for="parts_name">部品名</label>
                <input class="form-control" id="parts_name">
            </div>
            <div class="form-group col-md-4">
                <label for="parts_makers">部品メーカー名</label>
                <input class="form-control" id="parts_makers">
            </div>
            <div class="form-group col-md-4">
                <label for="parts_makers_no">部品メーカー番号</label>
                <input class="form-control" id="parts_makers_no">
            </div>
        </div>

        <div><label for="pre_title">プレタイトル</label>
            <input class="form-control" id="parts_makers_no"></div>
        <!--
        <div class="form-row detail">
            <div class="form-group col-md-12">
                <label for="exampleFormControlInput1">タイトル</label>
                <input class="form-control" id="exampleFormControlInput1">
            </div>
        </div>
        -->
        <div>
            <a class="btn btn-primary" data-toggle="collapse" href="#tire_wheel" role="button" aria-expanded="false" aria-controls="tire_wheel">タイヤホイール</a>
        </div>
        <div class="collapse" id="tire_wheel">
            <div class="card card-body">
        <div class="form-row detail">
            <div class="form-group col-md-4 row">
                <div class="col">
                    <label for="starting_price">ホイール</label>
                    <input class="form-control col-md-2" id="hoile1">x
                </div>
                <div class="col">
                    <input class="form-control col-md-2" id="hoile2">	
                </div>
                
            </div>
            <div class="form-group col-md-2">
                <label for="starting_price">OFF</label>
                <input class="form-control" id="starting_price">
            </div>
            <div class="form-group col-md-2">
                <label for="starting_price">PCD</label>
                <input class="form-control" id="starting_price">
            </div>
            <div class="form-group col-md-2">
                <label for="starting_price">穴</label>
                <input class="form-control" id="starting_price">
            </div>
            
        </div>
        <div class="form-row detail">
            <div class="form-group col-md-3">
                <label for="starting_price">ハブ径</label>
                <input class="form-control" id="starting_price">
            </div>
            <div class="form-group col-md-3">
                <label for="starting_price">本数</label>
                <input class="form-control" id="starting_price">
            </div>
            <div class="form-group col-md-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="condition" id="condition" value="A">
                    <label class="form-check-label" for="A">純正</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="condition" id="condition" value="B">
                    <label class="form-check-label" for="B">社外</label>
                </div>
            </div>
            <div class="form-group col-md-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="condition" id="condition" value="A">
                    <label class="form-check-label" for="A">鉄</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="condition" id="condition" value="B">
                    <label class="form-check-label" for="B">アルミ</label>
                </div>
            </div>
        </div>
        <div class="form-row detail">
            <div class="form-group col-md-3">
                <label for="starting_price">メーカー</label>
                <input class="form-control" id="starting_price">
            </div>
            <div class="form-group col-md-3">
                <label for="starting_price">タイヤ</label>
                <input class="form-control" id="starting_price">
            </div>
            <div class="form-group col-md-3">
                <label for="starting_price">メーカー</label>
                <input class="form-control" id="starting_price">
            </div>
        </div>
    </div>
    </div>
        <div class="form-row detail">
            <fieldset class="form-group">
                <div class="row">						
                    <legend class="col-form-label col-sm-2 pt-0">状態</legend>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="condition" id="condition" value="A">
                            <label class="form-check-label" for="A">A</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="condition" id="condition" value="B">
                            <label class="form-check-label" for="B">B</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="condition" id="condition" value="C">
                            <label class="form-check-label" for="C">C</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="condition" id="condition" value="D">
                            <label class="form-check-label" for="D">D</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="condition" id="condition" value="E">
                            <label class="form-check-label" for="E">E</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="condition" id="condition" value="F">
                            <label class="form-check-label" for="F">F</label>
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
                            <input class="form-check-input" type="radio" name="operating_status" id="operating_status1" value="動作確認済み">
                            <label class="form-check-label" for="operating_status1">動作確認済</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="operating_status" id="operating_status2" value="動作未確認">
                            <label class="form-check-label" for="operating_status2">動作未確認</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="operating_status" id="operating_status3" value="ジャンク品">
                            <label class="form-check-label" for="operating_status2">ジャンク品</label>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="form-row detail">
            <div class="form-group col-md-">
                <label for="check_video">動作確認動画</label>
                <select class="form-control" id="check_video">
                    <option>なし</option>
                    <option>あり</option>
                </select>
            </div>
            <div class="form-group col-md-10">
                <label for="video_url">URL</label>
                <input class="form-control" id="video_url">
            </div>
        </div>
        <div class="form-row detail">
            <div class="form-group row">
                <div class="col-sm-2">送料区分</div>
                <div class="col-sm-10">
                    <div class="form-check  form-check-inline">
                    <input class="form-check-input" type="checkbox" id="gridCheck1">
                    <label class="form-check-label" for="gridCheck1">
                    130cmまたは20kg以上
                    </label>
                </div>
                <div class="form-check  form-check-inline">
                    <input class="form-check-input" type="checkbox" id="gridCheck1">
                    <label class="form-check-label" for="gridCheck1">
                    大
                    </label>
                </div>
                <div class="form-check  form-check-inline">
                    <input class="form-check-input" type="checkbox" id="gridCheck1">
                    <label class="form-check-label" for="gridCheck1">
                    中
                    </label>
                </div>
                <div class="form-check  form-check-inline">
                    <input class="form-check-input" type="checkbox" id="gridCheck1">
                    <label class="form-check-label" for="gridCheck1">
                    小
                    </label>
                </div>
                <div class="form-check  form-check-inline">
                    <input class="form-check-input" type="checkbox" id="gridCheck1">
                    <label class="form-check-label" for="gridCheck1">
                    ネコポス
                    </label>
                </div>
                </div>
                
            </div>
        </div>
        <div class="form-row detail">
            <div class="form-group col-md-6">
                <label for="starting_price">開始価格</label>
                <input class="form-control" id="starting_price">
            </div>
            <div class="form-group col-md-6">
                <label for="pompt_decision">即決価格</label>
                <input class="form-control" id="pompt_decision">
            </div>
        </div>
        <div class="form-row detail">
            <div class="form-group col-md-12">
                <label for="memo">商品説明</label>
                <textarea class="form-control" id="memo" rows="6"></textarea>
            </div>
        </div>
        <div class="form-row detail">
            <div class="form-group col-md-6">
                <label for="memo">登録画像(複数枚選択できます）</label><br>
                <input type="file" name="example" accept="image/*" multiple onchange="loadImage(this);">						
            </div>
            <div class="col-md-12" id="preview"></div>
        </div>

        <div class="form-row detail">
            <input name="Submit1" type="submit" value="登録" /><input name="Reset1" type="reset" value="reset" />
        </div>

        </div>
        { Form::close() }}


@endsection