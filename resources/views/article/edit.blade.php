@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row row-offcanvas row-offcanvas-right">

            @include('common.sidebar')

            <div class="col-xs-12 col-sm-9">
                <form method="POST" action="{{ route('article.update', ['id' => $article->id]) }}" aria-label="{{ __('Register') }}">
                    {{ csrf_field() }}

                    {{ method_field('PATCH') }}

                    <input type="hidden" name="updated_user_id" value="{{ Auth::id() }}">

                    <div class="form-group row">
                        <label for="title" class="col-md-2 control-label">{{ __('title') }}</label>

                        <div class="col-md-10">
                            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title', isset($article) ? $article->title : null) }}" required autofocus>

                            @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="contents" class="col-md-2 control-label">{{ __('contents') }}</label>

                        <div class="col-md-10">
                            <textarea name="contents" id="editor1" class="form-control{{ $errors->has('contents') ? ' is-invalid' : '' }}" cols="30" rows="5" autofocus>{{ old('contents', isset($article) ? $article->contents : null) }}</textarea>

                            @if ($errors->has('contents'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contents') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="title" class="col-md-2 control-label">{{ __('Category') }}</label>

                        <div class="col-md-10">
                            <select name="article_category_id" id="article_category_id">
                                @foreach ($categories as $value => $key)
                                    <option value="{{ $key }}" {{old('article_category_id', $article->article_category_id)==$key? 'selected':''}}>{{ $value }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="image" class="col-md-2 control-label">{{ __('image') }}</label>

                        <div class="col-md-8">
                            <input type="text" class="form-control" size="48" name="image_path" id="image_path" value="{{ old('title', isset($article) ? $article->title : null) }}" />
                            @if ($errors->has('image_path'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image_path') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="col-md-2">
                            <a href="#" class="btn btn-info" id="ckFinder-popUp">Select file</a>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Edit Article') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div><!--/.col-xs-12.col-sm-9-->
        </div><!--/row-->

    </div><!--/.container-->

@endsection