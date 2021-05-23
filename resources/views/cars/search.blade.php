{{ Form::open(['url' => route('car.index'), 'method' => 'get']) }}
    {{ csrf_field() }}
    <div class='form-group'>
        {{ Form::label('keyword', '車名:') }}
        {{ Form::text('keyword', null, ['class' => 'form-control']) }}
    </div>
    <div class='form-group'>
        {{ Form::submit('検索', ['class' => 'btn btn-outline-primary'])}}
        <a href={{ route('car.index') }}>クリア</a>
    </div>
{{ Form::close() }}
{{ Form::open(['url' => route('car.index'), 'method' => 'get']) }}
    {{ csrf_field() }}
    <div class='form-group'>
        {{ Form::label('record_no', 'カルテ番号:') }}
        {{ Form::text('record_no', null, ['class' => 'form-control']) }}
    </div>
    <div class='form-group'>
        {{ Form::submit('検索', ['class' => 'btn btn-outline-primary'])}}
        <a href={{ route('car.index') }}>クリア</a>
    </div>
{{ Form::close() }}