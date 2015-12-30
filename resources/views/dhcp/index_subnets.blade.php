@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" id="option_list">
        <h3>DHCP Subnets</h3>
        <a class="btn btn-primary" href="{!! action('DhcpController@createNetwork') !!}">Add New</a>
        <hr />
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Shared Network</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subnets as $subnet)
                    <tr>
                        <td>{{ $subnet->name }}</td>
                        <td>
                            {{ $subnet->network or 'N/A' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection