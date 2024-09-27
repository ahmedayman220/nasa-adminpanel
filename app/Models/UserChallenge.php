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

    public function challenges()
    {
        return $this->belongsToMany(Challenge::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->using(UserUserChallenge::class); // Use the pivot model
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    

}
