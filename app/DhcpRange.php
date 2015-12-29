<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DhcpRange extends Model
{
    public function subnet()
    {
        return $this->belongsTo(App\DhcpSubnet::class, 'subnet_id');
    }
}
