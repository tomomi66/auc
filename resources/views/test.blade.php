@extends('layouts')

@section('contents')
{{ Form::open(['route' => 'test.comfirm', 'method' => 'POST']) }}
{{ csrf_field() }}
<div class="form-row detail">
    <div class="form-group col-md-12">
        <label for="testArea">商品説明</label>        
        {!! Form::textarea('testArea', old('memo'), ['class' => 'form-control', 'id' => 'summernote']) !!}
    </div>
</div>
{!! Form::submit('登録', ['class' => 'btn btn-primary']) !!}


{!! Form::close() !!}

@endsection

@section('pagejs')
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            lang: 'ja-JP',
            height: 300,
            toolbar: [
                ['style', ['bold', 'italic', 'underline','strikethrough','clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
            ],
        });
    });
</script>
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
@endsection