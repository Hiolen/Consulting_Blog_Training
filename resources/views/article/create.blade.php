@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row row-offcanvas row-offcanvas-right">

            @include('common.sidebar')

            <div class="col-xs-12 col-sm-9">
                <form method="POST" action="{{ route('article.store') }}" aria-label="{{ __('Register') }}" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <input type="hidden" name="updated_user_id" value="{{ Auth::id() }}">

                    <div class="form-group row">
                        <label for="title" class="col-md-2 control-label">{{ __('title') }}</label>

                        <div class="col-md-10">
                            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required autofocus>

                            @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="slug" class="col-md-2 control-label">{{ __('slug') }}</label>

                        <div class="col-md-10">
                            <input id="slug" type="text" class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" name="slug" value="{{ old('slug') }}" autofocus>

                            @if ($errors->has('slug'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="contents" class="col-md-2 control-label">{{ __('contents') }}</label>

                        <div class="col-md-10">
                            <textarea name="contents" id="editor1" class="form-control{{ $errors->has('contents') ? ' is-invalid' : '' }}" cols="30" rows="5" autofocus>{{ old('contents') }}</textarea>

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
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('article_category_id'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('article_category_id') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="image" class="col-md-2 control-label">{{ __('image') }}</label>

                        <div class="col-md-8">
                            <input type="hidden" name="image_path" id="image_path" />
                            <a href="#" class="btn btn-info" id="ckFinder-popUp">Select file</a> &nbsp;&nbsp;
                            <span><img src="" id="image_path_text" alt="" style="width:20%"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Add Article') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div><!--/.col-xs-12.col-sm-9-->
        </div><!--/row-->

    </div><!--/.container-->

@endsection