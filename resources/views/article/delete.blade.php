@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row row-offcanvas row-offcanvas-right">

            @include('common.sidebar')

            <div class="col-xs-12 col-sm-9">
                <form id="deleteForm" class="form-horizontal" method="post"
                      action="@if (isset($article)){{ route('article.destroy', ['id' => $article->id]) }}@endif">

                    {{ csrf_field() }}
                    {{method_field('DELETE')}}
                    <input type="hidden" name="id" value="{{ $article->id }}" />
                    <div class="form-group">
                        <div class="controls">
                            Do you want to delete this username {{ $article->title }}?<br>
                            <button type="submit" class="btn btn-sm btn-danger">
                                Delete Article
                            </button>
                            <a href="{{ route('article.index') }}" class="btn btn-warning btn-sm">Cancel</a>

                        </div>
                    </div>
                </form>
            </div><!--/.col-xs-12.col-sm-9-->
        </div><!--/row-->

    </div><!--/.container-->

@endsection