<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wish extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'type',
        'price',
        'link',
        'date',
        'status',
        'comment',
        'completed_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
