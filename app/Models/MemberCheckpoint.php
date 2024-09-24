<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MemberCheckpoint extends Model
{
    use SoftDeletes, MultiTenantModelTrait, Auditable, HasFactory;

    public $table = 'member_checkpoints';

    protected $dates = [
        'created_at',
        'completion_time',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'created_at',
        'member_id',
        'checkpoint_id',
        'completed',
        'completion_time',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function checkpoint()
    {
        return $this->belongsTo(Checkpoint::class, 'checkpoint_id');
    }

    public function getCompletionTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setCompletionTimeAttribute($value)
    {
        $this->attributes['completion_time'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
