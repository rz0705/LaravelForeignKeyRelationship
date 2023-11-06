<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $primaryKey = "group_id";

    public function member()
    {
        return $this->hasMany('App\Models\Member', 'group_id', 'group_id');
    }
}
