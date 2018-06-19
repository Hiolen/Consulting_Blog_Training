@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row row-offcanvas row-offcanvas-right">

            @include('user.partials.sidebar')

            <div class="col-xs-12 col-sm-9">
                <form id="deleteForm" class="form-horizontal" method="post"
                      action="@if (isset($user)){{ route('userDestroy', ['id' => $user->id]) }}@endif">

                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                    <input type="hidden" name="id" value="{{ $user->id }}" />
                    <div class="form-group">
                        <div class="controls">
                            Do you want to delete this username {{ $user->username }}?<br>
                            <button type="submit" class="btn btn-sm btn-danger">
                                Delete User
                            </button>
                            <a href="{{ route('userIndex') }}" class="btn btn-warning btn-sm">Cancel</a>

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