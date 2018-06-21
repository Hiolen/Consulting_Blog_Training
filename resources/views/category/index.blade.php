@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row row-offcanvas row-offcanvas-right">

            @include('common.sidebar')

            <div class="col-xs-12 col-sm-9">
                <h1>Category Listing</h1>

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

                <a href="{{ route('category.create') }}" class="btn btn-sm btn-primary">Create Category</a>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <th>Author</th>
                            <th>Date Created</th>
                            <th>Actions</th>
                        </tr>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->user->username }}</td>
                                <td>{{ $category->created_at->toFormattedDateString()}}</td>
                                <td>
                                    <a href="{{ route('category.edit', ['id' => $category->id]) }}" class="btn btn-info btn-sm">Edit</a>
                                    <a href="{{ route('categoryDelete', ['id' => $category->id]) }}" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                    {{ $categories->links() }}
                </div> <!-- .table-responsive -->
            </div><!--/.col-xs-12.col-sm-9-->

        </div><!--/row-->

        @include('common.footer')

    </div><!--/.container-->

@endsection