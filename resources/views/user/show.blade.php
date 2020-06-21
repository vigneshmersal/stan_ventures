@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header"><b>User Details</b></div>

                <div class="card-body">
                    @include('components.success')

                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>Name</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>{{ $user->role }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{ $user->active }}</td>
                        </tr>
                    </table>
                    <button class="btn btn-small btn-info"><a href="{{ route('user.edit', $user) }}">Edit</a></button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
