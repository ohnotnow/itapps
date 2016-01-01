<?php

namespace App\Http\Controllers;

use App\DhcpSubnet;
use App\Http\Requests;
use App\DhcpSharedNetwork;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DhcpNetworkController extends Controller
{
    public function index()
    {
        $networks = DhcpSharedNetwork::all();
        return view('dhcp.network.index', compact('networks'));
    }

    public function create()
    {
        $subnets = DhcpSubnet::all();
        return view('dhcp.network.create', compact('subnets'));
    }

    public function store(Request $request)
    {
        $network = new DhcpSharedNetwork;
        $network->name = $request->name;
        $network->save();
        if ($request->has('subnets')) {
            $subnets = DhcpSubnet::whereIn('id', $request->subnets)->get();
            $network->subnets()->saveMany($subnets);
        }
        return redirect()->action('DhcpNetworkController@index');
    }

    public function edit($id)
    {
        $network = DhcpSharedNetwork::findOrFail($id);
        $subnets = DhcpSubnet::all();
        return view('dhcp.network.edit', compact('subnets', 'network'));
    }

    public function update(Request $request, $id)
    {
        $network = DhcpSharedNetwork::findOrFail($id);
        $network->fill($request->all());
        $network->save();
        $network->subnets()->update(['network_id' => null]);
        if ($request->has('subnets')) {
            $subnets = DhcpSubnet::whereIn('id', $request->subnets)->get();
            $network->subnets()->saveMany($subnets);
        }
        return redirect()->action('DhcpNetworkController@index');
    }
}
