@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row row-offcanvas row-offcanvas-right">

            @include('common.sidebar')

            <div class="col-xs-12 col-sm-9">
                <h1>Article Listing</h1>

                <!-- Flash Session -->
                @if(Session::has('flash_message'))
                    <div class="alert alert-success">
                        {{ Session::get('flash_message') }}
                    </div>
                @endif

                @if(Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('flash_message_error') }}
                    </div>
                @endif

                <a href="{{ route('article.create') }}" class="btn btn-sm btn-primary">Create Article</a>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Title</th>
                            <th>Image Path</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Date Created</th>
                            <th>Actions</th>
                        </tr>
                        @foreach($articles as $article)
                            <tr>
                                <td>{{ $article->title }}</td>
                                <td>{{ $article->image_path }}</td>
                                <td>{{ $article->category->name }}</td>
                                <td>{{ $article->user->username }}</td>
                                <td>{{ $article->created_at->toFormattedDateString()}}</td>
                                <td>
                                    <a href="{{ route('article.edit', ['id' => $article->id]) }}" class="btn btn-info btn-sm">Edit</a>
                                    <a href="{{ route('articleDelete', ['id' => $article->id]) }}" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                    {{ $articles->links() }}
                </div> <!-- .table-responsive -->
            </div><!--/.col-xs-12.col-sm-9-->

        </div><!--/row-->

    </div><!--/.container-->

@endsection