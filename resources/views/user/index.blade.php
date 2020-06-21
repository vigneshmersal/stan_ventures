@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">

                    @include('components.success')

                    <button class="btn btn-small btn-info">
                        <a href="{{ route('user.create') }}">Create</a>
                    </button>

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Name</td>
                                <td>Email</td>
                                <td>Role</td>
                                <td>Status</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($users as $user)
                            <tr>
                                <td>{{ $loop->index + $users->firstItem() }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>{{ $user->active }}</td>
                                <td>
                                    <a class="btn btn-small btn-success" href="{{ route('user.show', $user) }}">Show</a>

                                    <a class="btn btn-small btn-warning" href="{{ route('user.edit', $user) }}">Edit</a>

                                    {{ Form::open([ 'route' => ['user.destroy', $user], 'class' => 'pull-right deleteUser']) }}
                                        @method("DELETE")
                                        {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                                    {{ Form::close() }}
                                </td>
                            </tr>
                            @endforeach

                            <tr style="background-color: whitesmoke;">
                                <td colspan="5" class="text-center">
                                    {!! $users->links() !!}
                                </td>

                                <td class="font-weight-bolder text-center">
                                    {{ $users->firstItem() }}-{{ $users->lastItem() }}
                                </td>
                            </tr>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function() {
            $(".deleteUser").on('click', function(e) {
                e.preventDefault();
                if(confirm('Are you really want to delete?')) {
                    $(this).submit();
                }
            });
        });
    </script>
@endpush
