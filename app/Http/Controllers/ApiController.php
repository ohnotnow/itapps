<?php

namespace App\Http\Controllers;

use App\DhcpEntry;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
class ApiController extends Controller
{
    public function getDhcpFile()
    {
        $lines = DhcpEntry::inIscFormat();
        return $lines;
    }
}
