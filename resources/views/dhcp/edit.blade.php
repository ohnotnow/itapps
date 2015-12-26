@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" id="dhcp_form">
        <h3>Create New DHCP Entry</h3>
        <hr />
        <form method="POST" action="{!! action('DhcpController@update', $entry->id) !!}">
        {!! csrf_field() !!}
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>MAC Address</label>
                    <input type="text" id="inputMac" autofocus="autofocus" name="mac" value="{{ old('mac', $entry->mac) }}" class="form-control" pattern="^([0-9A-F]{2}[:-]){5}([0-9A-F]{2})$" oninvalid="this.setCustomValidity('Invalid MAC address')" oninput="setCustomValidity('')">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="inputHostname">Host Name (optional)</label>
                    <input type="text" id="inputHostname" name="hostname" value="{{ old('hostname', $entry->hostname) }}" class="form-control" pattern="^[a-zA-Z0-9\-\.\ ]+$" oninvalid="this.setCustomValidity('Invalid hostname')" oninput="setCustomValidity('')">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="inputIp">Fixed IP Address (optional)</label>
                    <input type="text" id="inputIp" name="ip" value="{{ old('ip', $entry->ip) }}" class="form-control" pattern="^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$" oninvalid="this.setCustomValidity('Invalid IP address')" oninput="setCustomValidity('')">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="inputOwner">Owner Email Address</label>
            <input type="email" id="inputOwner" name="owner_email" value="{{ old('owner_email', $entry->owner_email) }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="inputNotes">Notes</label>
            <textarea class="form-control" id="inputNotes" rows="3" name="notes">{{ old('notes', $entry->notes) }}</textarea>
        </div>
        <fieldset>
            <legend>Options</legend>
            <div class="checkbox">
                <label>
                    <input type="hidden" name="is_disabled" value="0">
                    <input type="checkbox" name="is_disabled" value="1" @if ($entry->is_disabled) checked @endif> Disabled?
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="hidden" name="is_ssd" value="0">
                    <input type="checkbox" name="is_ssd" value="1" @if ($entry->is_ssd) checked @endif> SSD?
                </label>
            </div>
        </fieldset>
        <br />
        <button type="submit" class="btn btn-primary">Update</button>

        </form>
    </div>
</div>

<script>
    new Vue({
        el: '#dhcp_form',
        data: {
            entries: [
                { mac: "", ip: "", hostname: "" }
            ]
        },
        methods: {
            addEntry: function () {
                this.entries.push({ mac: "", ip: "", hostname: "" })
            }
        }
    });
</script>
@endsection