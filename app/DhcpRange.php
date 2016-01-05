<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DhcpRange extends Model
{
    protected $fillable = ['subnet_id', 'start', 'end'];

    public function subnet()
    {
        return $this->belongsTo(DhcpSubnet::class, 'subnet_id');
    }

    public function inIscFormat()
    {
        return "range {$this->start} {$this->end};\n";
    }
}
