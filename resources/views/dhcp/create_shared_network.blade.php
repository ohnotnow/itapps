@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" id="option_list">
        <h3>New DHCP Shared Network</h3>
        <hr />
        <form method="POST" action="{!! action('DhcpController@storeNetwork') !!}">
            {!! csrf_field() !!}
            <input type="hidden" name="edited_by" value="{{ Auth::user()->id }}">
            <div class="form-group">
                <label for="inputName">Name</label>
                <input type="text" id="inputName" name="name" value="" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="inputSubnets">Subnets</label>
                <select id="inputSubnets" name="subnets[]" class="form-control" multiple>
                    @foreach ($subnets as $subnet)
                        <option value="{{ $subnet->id }}">{{ $subnet->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection