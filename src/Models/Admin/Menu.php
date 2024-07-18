<?php

namespace SujanSht\AdminMaster\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    const ACTIVE = 1;

    use HasFactory;

    protected $guarded = [];

    // Scopes

    public function scopePosition($query)
    {
        return $query->orderBy('position', 'asc');
    }

    public function scopeActive($query)
    {
        return $query->where('active', Menu::ACTIVE);
    }
}
