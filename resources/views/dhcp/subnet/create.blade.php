@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" id="option_list">
        <h3>New DHCP Subnet</h3>
        <hr />
        <form method="POST" action="{!! action('DhcpSubnetController@store') !!}">
            {!! csrf_field() !!}
            <input type="hidden" name="edited_by" value="{{ Auth::user()->id }}">
            <div class="form-group">
                <label for="inputName">Name</label>
                <input type="text" id="inputName" name="name" value="" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="inputNetwork">Network</label>
                <input type="text" id="inputNetwork" name="network" value="" class="form-control" placeholder="Eg, 192.168.10.0" required>
            </div>
            <div class="form-group">
                <label for="inputNetmask">Netmask</label>
                <input type="text" id="inputNetmask" name="netmask" value="" class="form-control" placeholder="Eg, 255.255.255.0" required>
            </div>
            <div class="form-group">
                <label for="inputSubnets">Belongs to Shared Network?</label>
                <select id="inputSubnets" name="network_id" class="form-control">
                    <option value=""></option>
                    @foreach ($networks as $network)
                        <option value="{{ $network->id }}">{{ $network->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection