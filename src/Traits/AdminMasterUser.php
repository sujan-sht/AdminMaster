<?php

namespace SujanSht\AdminMaster\Traits;

/**
 * AdminMaster User.
 */
trait AdminMasterUser
{
    use HasRole;

    // Accessors
    public function getImageAttribute()
    {
        return !is_null($this->getFirstMedia('image')) ? $this->getFirstMediaUrl('image') : asset('admin-master/assets/static-img/profile.png');
    }

}
