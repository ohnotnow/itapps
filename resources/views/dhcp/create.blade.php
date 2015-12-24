@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" id="dhcp_form">
        <h3>Create New DHCP Entry</h3>
        <hr />
        <form method="POST" action="{!! action('DhcpController@store') !!}">
        {!! csrf_field() !!}
        <div class="row" v-for="entry in entries">
            <div class="col-md-4">
                <div class="form-group">
                    <label>MAC Address</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" @click="addEntry" title="Add another">+</button>
                        </span>
                        <input type="text" id="inputMac" autofocus="autofocus" name="macs[@{{ $index }}]" value="@{{ entry.mac }}" class="form-control" pattern="^([0-9A-F]{2}[:-]){5}([0-9A-F]{2})$" oninvalid="this.setCustomValidity('Invalid MAC address')" oninput="setCustomValidity('')">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="inputHostname">Host Name (optional)</label>
                    <input type="text" id="inputHostname" name="hostnames[@{{ $index }}]" value="@{{ entry.hostname }}" class="form-control" pattern="^[a-zA-Z0-9\-\.\ ]+$" oninvalid="this.setCustomValidity('Invalid hostname')" oninput="setCustomValidity('')">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="inputIp">Fixed IP Address (optional)</label>
                    <input type="text" id="inputIp" name="ips[@{{ $index }}]" value="@{{ entry.ip }}" class="form-control" pattern="^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$" oninvalid="this.setCustomValidity('Invalid IP address')" oninput="setCustomValidity('')">
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
                    <input type="checkbox" name="is_disabled" value="1"> Disabled?
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="hidden" name="is_ssd" value="0">
                    <input type="checkbox" name="is_ssd" value="1"> SSD?
                </label>
            </div>
        </fieldset>
        <br />
        <button type="submit" class="btn btn-primary">Create</button>

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