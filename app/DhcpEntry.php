<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DhcpEntry extends Model
{
    protected $fillable = ['mac', 'ip', 'owner_email', 'notes', 'is_ssd', 'is_disabled'];

    public static function searchFor($term)
    {
        return static::where('mac', 'like', "%{$term}%")
                        ->orWhere('ip', 'like', "%{$term}%")
                        ->orWhere('hostname', 'like', "%{$term}%")
                        ->orderBy('updated_at')
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
}
