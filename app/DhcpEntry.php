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
                        ->orderBy('updated_at', 'desc')
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
            return static::generateHostname($this->mac);
        }
        return $hostname;
    }

    private static function generateHostname($mac)
    {
        return strtolower('dhcphost-' . preg_replace("/[^0-9a-fA-F]/", '-', $mac));
    }

    public static function createFromForm($index, $mac, $request)
    {
        $entry = new static;
        $entry->mac = $mac;
        $entry->hostname = $request->hostnames[$index] ? $request->hostnames[$index] : static::generateHostname($mac);
        $entry->ip = $request->ips[$index];
        $entry->owner_email = $request->owner_email;
        $entry->notes = $request->notes;
        $entry->is_ssd = $request->is_ssd;
        $entry->is_disabled = $request->is_disabled;
        $entry->added_by = $request->added_by;
        $entry->save();
        return $entry;
    }

    public function inIscFormat()
    {
        $disabled = '';
        $fixed = '';
        if ($this->ip) {
            $fixed = "; fixed-address: {$this->ip}";
        }
        if ($this->is_disabled) {
            $disabled = '### DISABLED ';
        }
        return "{$disabled}host {$this->hostname} {hardware-address: {$this->mac} $fixed}\n";
    }
}
