<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title }}</title>
        <!-- BootstrapのCSS読み込み -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/common.css') }}" rel="stylesheet" type="text/css">
        <!-- jQuery読み込み -->
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <!-- BootstrapのJS読み込み -->
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    </head>
    <body>

        @yield('contents')

    </body>
</html>