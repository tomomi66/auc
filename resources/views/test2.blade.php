@extends('layouts')

@section('contents')
ここがテストです。
{{ session()->get('testArea')}}

@endsection

@section('pagejs')
    {{-- <script src="{{ asset('ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace('memo',{
            removeButtons: 'Source, NewPage, DocProps, Preview, Print, Templates, PasteFromWord, Find, Replace, SelectAll, Scayt, Form, Checkbox, Radio, TextField, Textarea, Select, Button, ImageButton, HiddenField, Subscript, Superscript, RemoveFormat, BidiLtr, BidiRtl, Language, Link, Unlink, Anchor, Image, Flash, SpecialChar, Smiley, PageBreak, Iframe, Maximize, ShowBlocks, About'
        });
    </script> --}}
    <script>
        var quill = new Quill('#editor', {
            theme: 'snow'
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