<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserUserChallenge extends Model
{
    use HasFactory;

    protected $table = 'user_user_challenge'; // Specify the table name if it's different from the default

    protected $fillable = [
        'user_id',
        'user_challenge_id',
    ];

    public function userChallenge()
    {
        return $this->belongsTo(UserChallenge::class);
    }


    public $timestamps = true; // If the pivot table has timestamps


}
