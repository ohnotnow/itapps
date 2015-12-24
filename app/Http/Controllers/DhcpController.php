<?php

namespace App\Http\Controllers;

use Auth;
use App\DhcpEntry;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\DhcpRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\DhcpCreateRequest;
use App\Http\Requests\DhcpUpdateRequest;

class DhcpController extends Controller
{
    public function index()
    {
        $entries = DhcpEntry::latest()->take(30)->get();
        return view('dhcp.index', compact('entries'));
    }

    public function create()
    {
        $entry = new DhcpEntry;
        return view('dhcp.create', compact('entry'));
    }

    public function store(DhcpCreateRequest $request)
    {
        $owner_email = $request->owner_email;
        $notes = $request->notes;
        $is_ssd = $request->is_ssd;
        $is_disabled = $request->is_disabled;
        $added_by = Auth::user()->email;
        foreach ($request->macs as $index => $mac) {
            $entry = new DhcpEntry;
            $entry->mac = $mac;
            $entry->hostname = $request->hostnames[$index] ? $request->hostnames[$index] : 'dhcphost-' . str_random(8);
            $entry->ip = $request->ips[$index];
            $entry->owner_email = $owner_email;
            $entry->notes = $notes;
            $entry->is_ssd = $is_ssd;
            $entry->is_disabled = $is_disabled;
            $entry->added_by = $added_by;
            $entry->save();
        }
        return redirect()->action('DhcpController@index')->with('success_message', 'Saved');
    }

    public function edit($id)
    {
        $entry = DhcpEntry::findOrFail($id);
        return view('dhcp.edit', compact('entry'));
    }

    public function update(DhcpUpdateRequest $request)
    {
        $entry = DhcpEntry::findOrFail($id);
        $entry->fill($request->all());
        $entry->save();
        return redirect()->action('DhcpController@index')->with('success_message', 'Updated');
    }

    public function destroy($id)
    {
        $entry = DhcpEntry::findOrFail($id);
        $entry->delete();
        return redirect()->action('DhcpController@index')->with('success_message', 'Deleted');
    }

    public function search($term)
    {
        return DhcpEntry::searchFor($term);
    }

    public function dhcpFile()
    {
        $entries = DhcpEntry::all();
        $lines = $this->entriesToIscDhcpFormat($entries);
        return $lines;
    }

    private function entriesToIscDhcpFormat($entries)
    {
        $lines = '';
        foreach ($entries as $entry) {
            $lines .= $this->iscFormat($entry);
        }
        return $lines;
    }

    private function iscFormat($entry)
    {
        $fixed = '';
        if ($entry->ip) {
            $fixed = "; fixed-address: {$entry->ip}";
        }
        return "host {$entry->hostname} {hardware-address: {$entry->mac} $fixed}\n";
    }
}