<?php

namespace SujanSht\LaraAdmin\Models\Admin;

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
        return $query->orderBy('position', 'desc');
    }

    public function scopeActive($query)
    {
        return $query->where('active', Menu::ACTIVE);
    }
}
