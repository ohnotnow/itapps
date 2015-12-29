<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DhcpSubnet extends Model
{
    public function network()
    {
        return $this->belongsTo(App\DhcpSharedNetwork::class, 'network_id');
    }

    public function ranges()
    {
        return $this->hasMany(App\DhcpRange::class, 'subnet_id');
    }

    public function options()
    {
        return $this->hasMany(App\DhcpOption::class, 'subnet_id');
    }
}
