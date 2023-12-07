<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    use HasFactory;
    protected $primaryKey = "group_id";

    public function members(): HasMany
    {
        return $this->hasMany(Member::class, 'group_id', 'group_id');
    }
}
