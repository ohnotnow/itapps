<?php

namespace App\Http\Controllers;

use App\DhcpRange;
use App\DhcpSubnet;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
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
        if (!$request->has('ids')) {
            return redirect()->action('DhcpRangeController@edit', $subnetId)->with('success_message', 'Awww');
        }
        $subnet = DhcpSubnet::findOrFail($subnetId);
        foreach ($request->ids as $index => $id) {
            $range = DhcpRange::findOrNew($id);
            $range->start = $request->starts[$index];
            $range->end = $request->ends[$index];
            $range->subnet_id = $subnetId;
            if (!$range->start and !$range->end) {
                $range->delete();
            } else {
                $range->save();
            }
        }
        // $ranges = $subnet->ranges;
        // foreach ($ranges as $range) {
        //     $parts = preg_split('\.', $range->start);
        //     $ip1 = $parts[3];
        //     $parts = preg_split('\.', $range->end);
        //     $ip2 = $parts[3];
        //     $valueRange = range($ip1, $ip1);
        // }
        return redirect()->action('DhcpRangeController@edit', $subnetId)->with('success_message', 'Updated!');
    }
}
