<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TshirtSize extends Model
{
    use SoftDeletes, MultiTenantModelTrait, Auditable, HasFactory;

    public $table = 'tshirt_sizes';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'extra_field',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function tshirtSizeMembers()
    {
        return $this->hasMany(Member::class, 'tshirt_size_id', 'id');
    }

    public function scopeWithAcceptedOnsiteTeam($query)
    {
        return $query->whereHas('teams', function ($q) {
            $q->where('accepted_onsite', true);
        });
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
