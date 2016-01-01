@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Subnets</h3>
    <a href="{!! action('DhcpSubnetController@create') !!}" class="btn btn-primary">Add New</a>
    <hr />
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Network</th>
                <th>Netmask</th>
                <th>Belongs To</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subnets as $subnet)
                <tr>
                    <td>
                        <a href="{!! action('DhcpSubnetController@edit', $subnet->id) !!}">
                            {{ $subnet->name }}
                        </a>
                    </td>
                    <td>{{ $subnet->network }}</td>
                    <td>{{ $subnet->netmask }}</td>
                    <td>{{ $subnet->sharedNetworkName() }}</td>
                    <td><a href="">Ranges</a></td>
                    <td><a href="{!! action('DhcpOptionController@edit', $subnet->id) !!}">Options</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
