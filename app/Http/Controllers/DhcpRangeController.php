<?php

namespace App\Http\Controllers;

use App\DhcpSubnet;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DhcpRangeController extends Controller
{
    public function edit($subnetId)
    {
        $subnet = DhcpSubnet::findOrFail($subnetId);
        $ranges = $subnet->ranges;
        return view('dhcp.range.edit', compact('ranges', 'subnet'));
    }

    public function update(Request $request, $subnetId)
    {
    }
}
