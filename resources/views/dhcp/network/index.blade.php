@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" id="option_list">
        <h3>DHCP Shared Networks</h3>
        <a class="btn btn-primary" href="{!! action('DhcpNetworkController@create') !!}">Add New</a>
        <hr />
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Subnets</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($networks as $network)
                    <tr>
                        <td>
                            <a href="{!! action('DhcpNetworkController@edit', $network->id) !!}">
                                {{ $network->name }}
                            </a>
                        </td>
                        <td>
                            @foreach ($network->subnets as $subnet)
                                <a href="{!! action('DhcpSubnetController@edit', $subnet->id) !!}">
                                    {{ $subnet->name }}
                                </a>,
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection