<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    /**
     * user
     *
     * @return void Illuminate\Database\Eloquent\Relations\BelongsTo;
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
