@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Bulk Edit DHCP Entries</h3>
    <hr />
    <form method="POST" action="{!! action('DhcpController@bulkUpdate') !!}">
    {!! csrf_field() !!}
    @foreach ($entries as $entry)
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>MAC Address</label>
                    <input type="text" id="inputMac" autofocus="autofocus" name="macs[{{ $entry->id }}]" value="{{ $entry->mac }}" class="form-control" pattern="^([0-9A-F]{2}[:-]){5}([0-9A-F]{2})$" oninvalid="this.setCustomValidity('Invalid MAC address')" oninput="setCustomValidity('')">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="inputHostname">Host Name (optional)</label>
                    <input type="text" id="inputHostname" name="hostnames[{{ $entry->id }}]" value="{{ $entry->hostname }}" class="form-control" pattern="^[a-zA-Z0-9\-\.\ ]+$" oninvalid="this.setCustomValidity('Invalid hostname')" oninput="setCustomValidity('')">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="inputIp">Fixed IP Address (optional)</label>
                    <input type="text" id="inputIp" name="ips[{{ $entry->id }}]" value="{{ $entry->ip }}" class="form-control" pattern="^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$" oninvalid="this.setCustomValidity('Invalid IP address')" oninput="setCustomValidity('')">
                </div>
            </div>
        </div>
    @endforeach
    <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection