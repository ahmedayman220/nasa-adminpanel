<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChallengeUserChallenge extends Model
{
    use HasFactory;

    public $table = 'challenge_user_challenge';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'challenge_id',
        'user_challenge_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Relationship to the Challenge model.
     */
    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }

    /**
     * Relationship to the UserChallenge model.
     */
    public function userChallenge()
    {
        return $this->belongsTo(UserChallenge::class);
    }

}
