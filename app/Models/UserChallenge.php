<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserChallenge extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'user_challenges';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function challengeUserChallenges()
    {
        return $this->hasMany(ChallengeUserChallenge::class , 'id' , 'user_challenge_id');
    }
    public function challenges()
    {
        return $this->belongsToMany(Challenge::class);
    }
}
