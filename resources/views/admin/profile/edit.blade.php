@extends('layouts.admin')
@section('title', 'プロフィールの新規作成')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
        <h1>プロフィール編集画面</h1>
        <form action="{{ action('Admin\ProfileController@update') }}" method="post" enctype="multipart/form-data">

            @if (count($errors) > 0)
                <ul>
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="form-group row">
                <label class="col-md-2">氏名</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="name" value="{{ $user->name }}" disabled>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2">性別</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="gender" value="{{ $user->gender }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2">自己紹介</label>
                <div class="col-md-10">
                    <textarea class="form-control" name="introduction" rows="20">{{ $user->introduction }}</textarea>
                </div>
            </div>
            <input type="hidden" name="id" value="{{ $user->id }}">
            {{ csrf_field() }}
            <input type="submit" class="btn btn-primary" value="更新">
        </form>
    </body>
</html>
@endsection