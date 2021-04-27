<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>車輌一覧</title>
        <!-- BootstrapのCSS読み込み -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/common.css') }}" rel="stylesheet" type="text/css">
        <!-- jQuery読み込み -->
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <!-- BootstrapのJS読み込み -->
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    </head>
    <body>
        <h3>車輌一覧</h3>
        <input name="Text1" type="text" /><input name="検索" type="button" value="検索" />


        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">登録完了</th>
                    <th scope="col">入庫No.</th>
                    <th scope="col">車名</th>
                    <th scope="col">登録部品数</th>
                    <th scope="col">登録部品</th>
                    <th scope="col"></th>
                    
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td><input name="Checkbox1" type="checkbox" /></td>
                    <td>12345</td>
                    <td>アルト</td>
                    <td>5点</td>
                    <td>ドア<br>ナビ<br>フロント<br>ドアミラー<br>シート</th>
                    <td><a href="product_registration.html"><button type="button" class="btn btn-primary btn-lg btn-sm">商品登録</button></a></td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td><input name="Checkbox1" type="checkbox" /></td>
                    <td>12345</td>
                    <td>アルト</td>
                    <td>5点</td>
                    <td>ドア<br>ナビ<br>フロント<br>ドアミラー<br>シート</th>
                    <td><a href="product_registration.html"><button type="button" class="btn btn-primary btn-lg btn-sm">商品登録</button></a></td>
                </tr>
            </tbody>
        </table>
    </body>
</html>