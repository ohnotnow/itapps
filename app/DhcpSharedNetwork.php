<?php

namespace App;

use App\DhcpSubnet;
use Illuminate\Database\Eloquent\Model;

class DhcpSharedNetwork extends Model
{
    protected $fillable = ['name'];

    public function subnets()
    {
        return $this->hasMany(DhcpSubnet::class, 'network_id');
    }
}
