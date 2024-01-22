<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
    ];


    public function detaiComment()
    {
        return $this->belongsTo(DetailComment::class, 'comment_id', 'id');
    }
}
