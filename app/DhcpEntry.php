<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DhcpEntry extends Model
{
    protected $fillable = ['mac', 'ip', 'owner_email', 'notes', 'is_ssd', 'is_disabled'];

    public static function searchFor($term, $limit = 50)
    {
        return static::where('mac', 'like', "%{$term}%")
                        ->orWhere('ip', 'like', "%{$term}%")
                        ->orWhere('hostname', 'like', "%{$term}%")
                        ->orderBy('updated_at')
                        ->take($limit)
                        ->get();
    }

    public function addedByName()
    {
        return preg_replace('/@.+$/', '', $this->added_by);
    }

    public function ownerName()
    {
        return preg_replace('/@.+$/', '', $this->owner_email);
    }

    public function setHostnameAttribute($hostname)
    {
        if (!$hostname) {
            $hostname = 'dhcphost-' . preg_replace("/[^0-9a-fA-F]/", '-', $this->mac);
        }
        $this->attributes['hostname'] = $hostname;
        return $hostname;
    }

    public function getHostnameAttribute($hostname)
    {
        if (!$hostname) {
            return strtolower('dhcphost-' . preg_replace("/[^0-9a-fA-F]/", '-', $this->mac));
        }
        return $hostname;
    }
}
