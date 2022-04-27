@extends('layouts.app')
@section('title', '投稿詳細')
@section('header', 'id: ' .  $message->id . 'の投稿詳細')
@section('content')
            <div class="row mt-2">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>id</th>
                        <td>{{ $message->id }}</td>
                    </tr>
                    <tr>
                        <th>名前</th>
                        <td>{{ $message->name }}</td>
                    </tr>
                    <tr>
                        <th>タイトル</th>
                        <td>{{ $message->title }}</td>
                    </tr>
                    <tr>
                        <th>内容</th>
                        <td>{{ $message->body }}</td>
                    </tr>
                    <tr>
                        <th>画像</th>
                        <td><img src="{{ asset('uploads/' . $message->image) }}" alt="表示する画像がありません。"></td>
                    </tr>
                </table>
            </div> 
            
            <div class="row">
                {!! link_to_route('messages.edit', '編集', ['id' => $message->id], ['class' => 'col-sm-6  btn btn-primary']) !!}
                
                {!! Form::model($message, ['route' => ['messages.destroy', $message->id], 'method' => 'delete', 'class' => 'col-sm-6']) !!}
                    {!! Form::submit('削除', ['class' => 'btn btn-danger col-sm-12', 'onclick' => 'return confirm("投稿を削除します。よろしいですか？")']) !!}
                {!! Form::close() !!}
            </div>
            
            <div class="offset-sm-2 col-sm-8 comments mt-4">
            @if(count($comments) !== 0)
            <div class="row mt-4">
                <h3 class="offset-sm-3 col-sm-6 text-center mt-3 mb-3">コメント一覧</h3>
            </div>
            <div class="row">
                <p class="offset-sm-1 col-sm-1">{{ count($comments) }}件</p>
            </div>
            <div class="row">
                <table class="offset-sm-1 col-sm-10 table table-bordered table-striped">
                    <tr>
                        <th>コメントID</th>
                        <th>名前</th>
                        <th>コメント</th>
                        <th>コメント時刻</th>
                    </tr>   
                    @foreach($comments as $comment)
                    <tr>
                        <td>{{ $comment->id }}</td>
                        <td>{{ $comment->name }}</td>
                        <td>{{ $comment->body }}</td>
                        <td>{{ $comment->created_at }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
            @else
            <p class="offset-sm-1 col-sm-10 text-center mt-4">コメントはまだありません</p>
            @endif
       
            <div class="row mt-3 offset-sm-12">
                {!! Form::open(['route' => ['comments.store'], 'class' => 'form-group offset-sm-1 col-sm-10']) !!}
                    {!! Form::hidden('message_id', $message->id) !!}
                    <div class="form-group row">
                        {!! Form::label('name', '名前', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
    
                    <div class="form-group row">
                        {!! Form::label('body', 'コメント', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('body',  old('body'), ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    {!! Form::submit('コメント投稿', ['class' => 'btn btn-primary btn-block']) !!}
                {!! Form::close() !!}

            </div>
        
             <div class="row mt-5">
                {!! link_to_route('messages.index', '投稿一覧', [], ['class' => 'btn btn-primary']) !!}
            </div>
@endsection