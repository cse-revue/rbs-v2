@extends('app')

@section('content')
    <h2>Production List</h2>

    <p>Select the production you wish to make a booking for:</p>
    <ul>
        @foreach($productions as $production)
            <li>
                Production {!! $production->id !!}: {!! HTML::link("/productions/$production->id", $production->name, null)  !!}
            </li>
        @endforeach

    </ul>
@endsection