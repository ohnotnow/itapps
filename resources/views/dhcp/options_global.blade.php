@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" id="dhcp_form">
        <h3>Global DHCP Options</h3>
        <hr />
        <form method="POST" action="{!! action('DhcpController@store') !!}">
            {!! csrf_field() !!}
            <input type="hidden" name="edited_by" value="{{ Auth::user()->id }}">
            <div class="form-group">
                <label for="inputLeaseTime">Default Lease Time</label>
                <input type="number" id="inputLeaseTime" name="default_lease_time" value="{{ $options->default_lease_time" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="inputMaxLease">Maximum Lease Time</label>
                <input type="number" id="inputMaxLease" name="max_lease_time" value="{{ $options->max_lease_time" class="form-control" required>
            </div>
        </form>
    </div>
</div>
@endsection