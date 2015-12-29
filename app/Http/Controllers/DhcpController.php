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
use App\Http\Requests\DhcpBulkUpdateRequest;

/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
class DhcpController extends Controller
{
    public function index()
    {
        $entries = DhcpEntry::latest('updated_at')->take(30)->get();
        return view('dhcp.index', compact('entries'));
    }

    public function create()
    {
        $entry = new DhcpEntry;
        return view('dhcp.create', compact('entry'));
    }

    public function store(DhcpCreateRequest $request)
    {
        foreach ($request->macs as $index => $mac) {
            DhcpEntry::createFromForm($index, $mac, $request);
        }
        return redirect()->action('DhcpController@index')->with('success_message', 'Saved');
    }

    public function edit($id)
    {
        $entry = DhcpEntry::findOrFail($id);
        return view('dhcp.edit', compact('entry'));
    }

    public function update(DhcpUpdateRequest $request, $id)
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
        if (!$term) {
            return [];
        }
        $limit = $this->calculateResultsLimit($term);
        return DhcpEntry::searchFor($term, $limit);
    }

    private function calculateResultsLimit($term)
    {
        if (strlen($term) < 5) {
            return 50;
        }
        return 100;
    }

    public function bulkEdit($term)
    {
        $limit = $this->calculateResultsLimit($term);
        $entries = DhcpEntry::searchFor($term, $limit);
        return view('dhcp.bulkedit', compact('entries'));
    }

    public function bulkUpdate(DhcpBulkUpdateRequest $request)
    {
        foreach ($request->macs as $id => $mac) {
            $entry = DhcpEntry::findOrFail($id);
            $entry->mac = $mac;
            $entry->ip = $request->ips[$id];
            $entry->hostname = $request->hostnames[$id];
            $entry->save();
        }
        return redirect()->action('DhcpController@index')->with('success_message', 'Updated');
    }

    public function editGlobalOptions()
    {
        $options = DhcpOption::latest()->first();
        return view('dhcp.options_global', compact('options'));
    }
}
