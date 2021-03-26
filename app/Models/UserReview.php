<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReview extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'from_user',
        'to_user',
        'rating',
        'message',
    ];

    /**
     * Who left a review.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function from_user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Who received the review.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function to_user()
    {
        return $this->belongsTo(User::class);
    }
}
