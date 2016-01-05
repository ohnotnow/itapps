<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DhcpOption extends Model
{
    public function subnet()
    {
        return $this->belongsTo(App\DhcpSubnet::class, 'subnet_id');
    }

    public function setSubnetIdAttribute($value)
    {
        if (!$value) {
            $value = null;
        }
        $this->attributes['subnet_id'] = $value;
    }

    public function scopeGlobals($query)
    {
        return $query->whereNull('subnet_id');
    }

    public static function forSubnet($subnetId)
    {
        if (!$subnetId) {
            return static::whereNull('subnet_id')->get();
        }
        return static::where('subnet_id', '=', $subnetId)->get();
    }

    public function inIscFormat()
    {
        $line = "";
        if ($this->optional) {
            $line = "{$this->optional} ";
        }
        $line .= "{$this->name} {$this->value};\n";
        return $line;
    }
}
