@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header"><b>User Details</b></div>

                <div class="card-body">
                    @include('components.errors')

                    @isset($user)
                        {{ Form::open([ 'route' => ['user.update', $user] ]) }}
                        @method('patch')
                        {!! Form::hidden('id', $user->id, []) !!}
                    @else
                        {{ Form::open([ 'route' => ['user.store'], 'class' => "form-horizontal" ]) }}
                    @endif

                        <div class="form-group">
                            {{ Form::label('name', 'Name') }}
                            {{ Form::text('name', old('name', $user->name ?? null), ['class' => 'form-control', 'required'=>true]) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('email', 'Email') }}
                            {{ Form::email('email', old('email', $user->email ?? null), ['class' => 'form-control', 'required'=>true]) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('role', 'Role') }}
                            {{ Form::select('role', [''=>'--Select--', 'admin'=>'Admin', 'user'=>'User'], old('role', $user->role ?? null), ['class'=>'form-control', 'required'=>true] ) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('password', 'Password') }}
                            {!! Form::password('password', ['class'=>'form-control', 'required'=> isset($user) ? false : true ]) !!}
                        </div>

                        <div class="form-group">
                            {{ Form::label('confirm_password', 'Confirm Password') }}
                            {!! Form::password('password_confirmation', ['class'=>'form-control', 'required'=> isset($user) ? false : true]) !!}
                        </div>

                        <div class="form-group">
                            {{ Form::label('status', 'Status') }} <br>
                            {{ Form::radio('status', '1', old('status', $user->status ?? 1) == 1 ? true : false) }} Active <br>
                            {{ Form::radio('status', '0', old('status', $user->status ?? 1) == 0 ? true : false) }} Inactive
                        </div>

                        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
