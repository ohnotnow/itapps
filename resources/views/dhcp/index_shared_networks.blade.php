@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" id="option_list">
        <h3>DHCP Shared Networks</h3>
        <a class="btn btn-primary" href="{!! action('DhcpController@createNetwork') !!}">Add New</a>
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
                        <td>{{ $network->name }}</td>
                        <td>
                            @foreach ($network->subnets as $subnet)
                                <a href="{!! action('DhcpController@showSubnet', $subnet->id) !!}">
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