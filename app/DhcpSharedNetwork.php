<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DhcpSharedNetwork extends Model
{
    public function subnets()
    {
        return $this->hasMany('DhcpSubnet');
    }
}
