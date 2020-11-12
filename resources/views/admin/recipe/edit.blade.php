@extends('layouts.admin')
@section('title', 'レシピの編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>レシピ編集</h2>
                <form action="{{ action('Admin\RecipeController@update') }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="{{ $recipe_form->id }}">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="title">料理名</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="{{ $recipe_form->title }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="body">本文</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="body" rows="20">{{ $recipe_form->body }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="image">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                            <div class="form-text text-info">
                                設定中: {{ $recipe_form->image_path }}
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <div class="col-md-6 text-right">
                                    <button type="button" class="btn btn-secondary" onclick="history.back()">戻る</button>
                                </div>
                                <div class="col-md-6">
                                    <input type="submit" class="btn btn-primary" value="登録">
                                </div>
                    </div>
                        </div>
                    </div>
                </form>
                <div class="row mt-5">
                    <div class="col-md-4 mx-auto">
                        <h2>編集履歴</h2>
                        <ul class="list-group">
                            @if ($recipe_form->histories != NULL)
                                @foreach ($recipe_form->histories as $history)
                                    <li class="list-group-item">{{ $history->edited_at }}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection