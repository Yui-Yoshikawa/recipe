@extends('layouts.admin')
@section('title', 'レシピの新規作成')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>レシピ新規作成</h2>
                <form action="{{ action('Admin\RecipeController@create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">料理名</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">レシピ</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="body" rows="20">{{ old('body') }}</textarea>
                        </div>
                    </div>
                    
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <div class="col-md-6 text-right">
                            <button type="button" class="btn btn-secondary" onclick="history.back()">戻る</button>
                        </div>
                        <div class="col-md-6">
                            <input type="submit" class="btn btn-primary" value="登録">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection