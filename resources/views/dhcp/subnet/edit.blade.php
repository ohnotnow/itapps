@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" id="option_list">
        <h3>Edit DHCP Subnet</h3>
        <hr />
        <form method="POST" action="{!! action('DhcpSubnetController@update', $subnet->id) !!}">
            {!! csrf_field() !!}
            <input type="hidden" name="edited_by" value="{{ Auth::user()->id }}">
            <div class="form-group">
                <label for="inputName">Name</label>
                <input type="text" id="inputName" name="name" value="{{ $subnet->name }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="inputNetwork">Network</label>
                <input type="text" id="inputNetwork" name="network" value="{{ $subnet->network }}" class="form-control" placeholder="Eg, 192.168.10.0" required>
            </div>
            <div class="form-group">
                <label for="inputNetmask">Netmask</label>
                <input type="text" id="inputNetmask" name="netmask" value="{{ $subnet->netmask }}" class="form-control" placeholder="Eg, 255.255.255.0" required>
            </div>
            <div class="form-group">
                <label for="inputSubnets">Belongs to Shared Network?</label>
                <select id="inputSubnets" name="network_id" class="form-control">
                    <option value=""></option>
                    @foreach ($networks as $network)
                        <option value="{{ $network->id }}" @if ($subnet->network_id = $network->id) selected @endif>
                            {{ $network->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection