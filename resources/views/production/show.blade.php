@extends('app')

@section('content')
    <h2>Production Information</h2>
    <h3>Ticket Totals</h3>
    <div class="row">
        @foreach ($ticket_totals as $tt) {
            <div class="one fourth padded">
                <h4>{!! $tt->title !!}</h4>
                <ul>
                    <li>Booked seats: {!! $tt->bookedseats  !!}</li>
                    <li>Paid seats: {!! $tt->paidseats  !!}</li>
                    <li>Confirmed seats: {!! $tt->confirmedseats  !!}</li>
                    <li>Payment Pending seats: {!! $tt->ppseats  !!}</li>
                    <li>VIP seats: {!! $tt->vipseats  !!}</li>
                </ul>
                <p class="info box">
                    <strong>Total confirmed or paid:</strong> {!! $tt->paidseats + $tt->confirmedseats + $tt->ppseats + $tt->vipseats !!}
                </p>
            </div>

            @if(isset($tt->confirmed) and count($tt->confirmed) > 0)
                <div class="one fourth padded">
                    <h4>Total paid by price class:</h4>
                    <ul>
                        @foreach($tt->confirmed as $price)
                            <li class='margin-left: 5em;'>{!! $price->name !!}: {!! $price->count !!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @endforeach
    </div>
@endsection