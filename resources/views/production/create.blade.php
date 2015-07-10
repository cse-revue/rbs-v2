@extends('app')

@section('content')
    <h2>Add a new production</h2>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {!! Form::open(['route' => 'productions.store']) !!}
            @include('production._form')

            {!! Form::submit("Create") !!}
        {!! Form::close() !!}

@endsection