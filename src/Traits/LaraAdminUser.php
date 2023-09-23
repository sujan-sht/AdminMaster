<?php

namespace SujanSht\LaraAdmin\Traits;

/**
 * LaraAdmin User.
 */
trait LaraAdminUser
{
    use HasRole;

    // Accessors
    public function getImageAttribute()
    {
        return !is_null($this->getFirstMedia('image')) ? $this->getFirstMediaUrl('image') : asset('lara-admin/assets/static-img/profile.png');
    }

}
