<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Member extends Model
{
    use HasFactory;
    protected $primaryKey = "member_id";

    public function group(): BelongsTo
    {
        return $this->belongsTo('App\Models\Group', 'group_id');
    }
}
