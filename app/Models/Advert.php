<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'image',
        'description',
        'city',
        'contact',
        'views',
        'status',
    ];

    /**
     * Get user by advert.
     *
     * @return
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
