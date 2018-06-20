@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row row-offcanvas row-offcanvas-right">

            @include('common.sidebar')

            <div class="col-xs-12 col-sm-9">
                <form method="POST" action="{{ route('article.store') }}" aria-label="{{ __('Register') }}" class="form-horizontal">
                    {{ csrf_field() }}

                    <input type="hidden" name="updated_user_id" value="{{ Auth::id() }}">

                    <div class="form-group">
                        <label for="title" class="col-md-4 control-label">{{ __('title') }}</label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required autofocus>

                            @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="contents" class="col-md-4 control-label">{{ __('contents') }}</label>

                        <div class="col-md-6">
                            <textarea name="content" id="content" cols="30" rows="10" autofocus></textarea>

                            @if ($errors->has('content'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Add Article') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div><!--/.col-xs-12.col-sm-9-->
        </div><!--/row-->

        @include('common.footer')

    </div><!--/.container-->

@endsection