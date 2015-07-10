@extends('app')

@section('content')
    <h2>Editing {!! $production->name !!}</h2>

    {!! Form::model($production, ['route' => ['productions.update', $production->id]]) !!}
    @include('production._form')

    {!! Form::submit("Update") !!}
    {!! Form::close() !!}

@endsection