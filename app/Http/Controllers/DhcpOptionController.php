<?php

namespace App\Http\Controllers;

use App\DhcpOption;
use App\DhcpSubnet;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DhcpOptionController extends Controller
{
    public function edit($subnetId = null)
    {
        $options = DhcpOption::forSubnet($subnetId);
        $subnetName = '';
        if ($subnetId) {
            $subnet = DhcpSubnet::findOrFail($subnetId);
            $subnetName = $subnet->name;
        }
        return view('dhcp.option.edit', compact('options', 'subnetId', 'subnetName'));
    }

    public function update(Request $request, $subnetId = null)
    {
        if (!$request->has('ids')) {
            return redirect()->action('DhcpOptionsController@edit');
        }
        foreach ($request->ids as $index => $id) {
            $option = new DhcpOption;
            $option->subnet_id = $request->subnet_id;
            if ($id) {
                $option = DhcpOption::findOrFail($id);
            }
            $option->optional = $request->optionals[$index];
            $option->name = $request->names[$index];
            $option->value = $request->values[$index];
            if ((! ($option->optional or $option->name or $option->value)) and $option->id) {
                $option->delete();
            } else {
                if ($option->id or $option->name) {
                    $option->save();
                }
            }
        }
        return redirect()->action('DhcpOptionController@edit', $subnetId)->with('success_message', 'Updated!');
    }
}
