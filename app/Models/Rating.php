<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'stadium_id',
        'rating',
        'comment'
    ];

    // Validation rules for ratings
    public static $rules = [
        'rating' => 'required|integer|between:1,5',
        'comment' => 'nullable|string|max:500'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stadium()
    {
        return $this->belongsTo(Stadium::class);
    }
}