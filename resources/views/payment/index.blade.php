@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Payment</div>

                <div class="panel-body">
                    <div class="border-t">
                        <div class="card-section">
                            <ticket-checkout
                                :concert-id="1"
                                service-title="Products$Services"
                            ></ticket-checkout>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('beforeScripts')
<script src="https://checkout.stripe.com/checkout.js"></script>
@endpush
