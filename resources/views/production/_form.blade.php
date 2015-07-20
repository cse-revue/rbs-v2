<div class="row">
    <div class="one third padded">
        Production Name *:
    </div>
    <div class="two thirds padded">
        {!! Form::text('name') !!}
    </div>

    <div class="one third padded">
        Show Header: </div>
    <div class="two thirds padded">
        {!! Form::textarea('header') !!}
    </div>

    <div class="one third padded">
        Show Footer:
    </div>
    <div class="two thirds padded">
        {!! Form::textarea('footer') !!}
    </div>

    <div class="one third padded">
        CSS File Location:
    </div>
    <div class="two thirds padded">
        {!! Form::text('styles') !!}
    </div>

    <div class="one third padded">
        Location:
    </div>
    <div class="two thirds padded">
        {!! Form::select('theatre', $theatres) !!}
    </div>
    <div class="one third padded">
        Is the show closed?:
    </div>
    <div class="two thirds padded">
        {!! Form::checkbox('is_closed', false) !!}
    </div>

    {{--TODO - Add datepicker --}}
    <div class="one third padded clear">
        Closing Date (yyyy-mm-dd) *:
    </div>
    <div class="two thirds padded">
        {!! Form::text('close_date') !!}
    </div>

    <div class="one third padded clear">
        Minimum Group Ticket Size *:
    </div>
    <div class="two thirds padded">
        {!! Form::text('group_tickets_amount') !!}
    </div>

    <div class="one third padded clear">
        Group Tickets Message:</div>
    <div class="two thirds padded">
        {!! Form::textarea('group_tickets_message') !!}
    </div>

    <div class="one third padded clear">
        Show Website Location:
    </div>
    <div class="two thirds padded">
        {!! Form::text('site_location') !!}
    </div>

    <div class="one third padded clear">
        Show FAQ Location:</div>
    <div class="two thirds padded">
        {!! Form::text('faq_location') !!}
    </div>

    <div class="one third padded clear">
        Accept Sales Booth Reservations:
    </div>
    <div class="two thirds padded">
        {!! Form::checkbox('accept_sales', false) !!}
    </div>

    <div class="one third padded clear">Sales Desk Information:</div>
    <div class="two thirds padded">
        {!! Form::textarea('sales_info') !!}
    </div>

    <div class="one third padded clear">
        Accept Direct Debit:
    </div>
    <div class="two thirds padded">
        {!! Form::checkbox('accept_dd', false) !!}
    </div>

    <div class="one third padded clear">
        Direct Debit Information:
    </div>
    <div class="two thirds padded">
        {!! Form::text('dd_info') !!}
    </div>

    <div class="one third padded clear">
        Accept Paypal:
    </div>
    <div class="two thirds padded">
        {!! Form::checkbox('accept_paypal', false) !!}
    </div>

    <div class="one third padded clear">
        Paypal Account:
    </div>
    <div class="two thirds padded">
        {!! Form::text('paypal_account') !!}
    </div>

    <div class="one third padded clear">
        Paypal Information:
    </div>
    <div class="two thirds padded">
        {!! Form::textarea('paypal_info') !!}
    </div>

    <div class="one third padded clear">
        Accept Stripe:
    </div>
    <div class="two thirds padded">
        {!! Form::checkbox('accept_stripe', false) !!}
    </div>

    <div class="one third padded clear">
        Stripe Publishable Key:
    </div>
    <div class="two thirds padded">
        {!! Form::text('stripe_publishable_key') !!}
    </div>

    <div class="one third padded clear">
        Stripe Secret Key:
    </div>
    <div class="two thirds padded">
        {!! Form::text('stripe_secret_key') !!}
    </div>

    <div class="one third padded clear">
        Stripe Information:
    </div>
    <div class="two thirds padded">
        {!! Form::textarea('stripe_info') !!}
    </div>
</div>