@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row row-offcanvas row-offcanvas-right">

            @include('common.sidebar')

            <div class="col-xs-12 col-sm-9">
                <form method="POST" action="{{ route('category.store') }}" aria-label="{{ __('Register') }}" class="form-horizontal">
                    {{ csrf_field() }}

                    <input type="hidden" name="updated_user_id" value="{{ Auth::id() }}">

                    <div class="form-group">
                        <label for="name" class="col-md-4 control-label">{{ __('name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Add Category') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div><!--/.col-xs-12.col-sm-9-->
        </div><!--/row-->

        <hr>

        <footer>
            <p>&copy; 2016 Company, Inc.</p>
        </footer>

    </div><!--/.container-->

@endsection