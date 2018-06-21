@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row row-offcanvas row-offcanvas-right">

            @include('common.sidebar')

            <div class="col-xs-12 col-sm-9">
                <form id="deleteForm" class="form-horizontal" method="post"
                      action="@if (isset($category)){{ route('category.destroy', ['id' => $category->id]) }}@endif">

                    {{ csrf_field() }}
                    {{method_field('DELETE')}}
                    <input type="hidden" name="id" value="{{ $category->id }}" />
                    <div class="form-group">
                        <div class="controls">
                            Do you want to delete this name {{ $category->name}}?<br>
                            <button type="submit" class="btn btn-sm btn-danger">
                                Delete Category
                            </button>
                            <a href="{{ route('user.index') }}" class="btn btn-warning btn-sm">Cancel</a>

                        </div>
                    </div>
                </form>
            </div><!--/.col-xs-12.col-sm-9-->
        </div><!--/row-->

        @include('common.footer')

    </div><!--/.container-->

@endsection