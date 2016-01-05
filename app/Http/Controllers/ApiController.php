<?php

namespace App\Http\Controllers;

use Cache;
use App\DhcpEntry;
use App\DhcpFile;
use App\DhcpOption;
use App\DhcpSharedNetwork;
use App\DhcpSubnet;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
class ApiController extends Controller
{
    public function getDhcpFile()
    {
        if (Cache::has('dhcpfile')) {
            return (new Response(Cache::get('dhcpfile'), 200))->header('Content-Type', 'text/plain');
        }
        $globals = DhcpOption::globals()->get();
        $networks = DhcpSharedNetwork::all();
        $subnets = DhcpSubnet::notInSharedNetwork()->get();
        $entries = DhcpEntry::all();
        $dhcpFile = new DhcpFile($globals, $networks, $subnets, $entries);
        $contents = Cache::rememberForever('dhcpfile', function () use ($dhcpFile) {
            return $dhcpFile->asText();
        });
        return (new Response($contents, 200))->header('Content-Type', 'text/plain');
    }
}
