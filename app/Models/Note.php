<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Note extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $table = 'notes';

    protected function users () : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
