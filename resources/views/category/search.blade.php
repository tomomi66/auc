<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>カテゴリ検索</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <!-- BootstrapのCSS読み込み -->
    <link href="{{ asset('css/common.css') }}" rel="stylesheet" type="text/css">


    <!-- BootstrapのJS読み込み -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!-- Bootstrap icon -->
    <script src="{{ asset('js/bootstrap-icons.json') }}"></script>
    <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet" type="text/css">

    <!-- ツールチップCSS読み込み -->
    <link href="{{ asset('css/microtip.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="container">
        <h3>カテゴリ検索</h3>
        {{ Form::open(['url' => route('category.search'), 'method' => 'get']) }}
        {{ csrf_field() }}
        <div class='form-group'>
            {{ Form::label('keyword', 'キーワード') }}
            <button aria-label="空白を間に入れることでAND検索できます" data-microtip-position="top-right" role="tooltip"
                class="btn btn-light btn-sm">
                <img src="{{ asset('img/icons/question-circle.svg') }}">
            </button>
            {{ Form::text('keyword', $keyword, ['class' => 'form-control']) }}
        </div>
        <div class='form-group'>
            {{ Form::submit('検索', ['class' => 'btn btn-outline-primary']) }}
            <a href={{ route('category.search') }}>クリア</a>
        </div>
        {{ Form::close() }}
        <table class="table">
            <tbody>
                @foreach ($categories as $item)
                    <tr>
                        <td>{{ $item['number'] }}</td>
                        <td>{{ $item['category_name'] }}</td>
                        <td><button type="button" class="btn btn-primary categoryButton"
                                value="{{ $item['category_name'] }}:{{ $item['number'] }}">選択</td>
                    </tr>
                @endforeach
            </tbody>
            {{ $categories->links() }}
        </table>

        <script>
            $('.categoryButton').click(function() {
                if (!window.opener || window.opener.closed) {
                    alert("呼び出し元が既に閉じられています。");
                    return false;
                }
                var category = $(this).val();
                var categoryErea = window.opener.document.getElementById('category');

                if(categoryErea != null){  //値をセットする先が存在する場合は値をセットする
                    categoryErea.value = category
                }
                // alert(category);
                window.close();
            })
        </script>
</body>

</html>
