<?php

namespace App\Http\Controllers;

use Cache;
use App\DhcpSubnet;
use App\Http\Requests;
use App\DhcpSharedNetwork;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DhcpSubnetController extends Controller
{
    public function index()
    {
        $subnets = DhcpSubnet::orderBy('name')->get();
        return view('dhcp.subnet.index', compact('subnets'));
    }

    public function create()
    {
        $networks = DhcpSharedNetwork::all();
        return view('dhcp.subnet.create', compact('networks'));
    }

    public function store(Request $request)
    {
        $subnet = new DhcpSubnet;
        $subnet->fill($request->all());
        $subnet->save();
        Cache::forget('dhcpfile');
        return redirect()->action('DhcpSubnetController@index');
    }

    public function edit($id)
    {
        $subnet = DhcpSubnet::findOrFail($id);
        $networks = DhcpSharedNetwork::all();
        return view('dhcp.subnet.edit', compact('subnet', 'networks'));
    }

    public function update(Request $request, $id)
    {
        $subnet = DhcpSubnet::findOrFail($id);
        $subnet->fill($request->all());
        $subnet->save();
        Cache::forget('dhcpfile');
        return redirect()->action('DhcpSubnetController@index');
    }

    public function destroy($id)
    {
        $subnet = DhcpSubnet::findOrFail($id);
        $subnet->delete();
        Cache::forget('dhcpfile');
        return redirect()->action('DhcpSubnetController@index');
    }
}
