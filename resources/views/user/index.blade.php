@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row row-offcanvas row-offcanvas-right">

            @include('common.sidebar')

            <div class="col-xs-12 col-sm-9">
                <h1>User Listing</h1>

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

                <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">Create User</a>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Role</th>
                            <th>Date Created</th>
                            <th>Actions</th>
                        </tr>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->first_name}}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ ($user->role == 0) ? 'User' : 'Admin'}}</td>
                                <td>{{ $user->created_at->toFormattedDateString()}}</td>
                                <td>
                                    <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-info btn-sm">Edit</a>
                                    <a href="{{ route('userDelete', ['id' => $user->id]) }}" class="btn btn-danger btn-sm {{ (Auth::user()->id == $user->id) ? 'disabled' : ' ' }}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                    {{ $users->links() }}
                </div> <!-- .table-responsive -->
            </div><!--/.col-xs-12.col-sm-9-->
        </div><!--/row-->

    </div><!--/.container-->

@endsection