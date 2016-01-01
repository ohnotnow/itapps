<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DhcpSubnet extends Model
{
    protected $fillable = ['name', 'network', 'netmask', 'network_id'];

    public function sharedNetwork()
    {
        return $this->belongsTo(DhcpSharedNetwork::class, 'network_id');
    }

    public function ranges()
    {
        return $this->hasMany(DhcpRange::class, 'subnet_id');
    }

    public function options()
    {
        return $this->hasMany(DhcpOption::class, 'subnet_id');
    }

    public function setNetworkIdAttribute($value)
    {
        if (!$value) {
            $value = null;
        }
        $this->attributes['network_id'] = $value;
    }

    public function sharedNetworkName()
    {
        if (!$this->network_id) {
            return 'N/A';
        }
        return $this->sharedNetwork->name;
    }
}
