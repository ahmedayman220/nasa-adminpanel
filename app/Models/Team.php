<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Team extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'teams';

    public const STATUS_SELECT = [
        'accepted' => 'Accepted',
        'rejected' => 'Eejected',
    ];

    protected $dates = [
        'submission_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'uuid',
        'team_leader_id',
        'team_name',
        'challenge_id',
        'actual_solution_id',
        'mentorship_needed_id',
        'participation_method_id',
        'limited_capacity',
        'members_participated_before',
        'project_proposal_url',
        'project_video_url',
        'team_rating',
        'total_score',
        'status',
        'submission_date',
        'extra_field',
        'nots',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function team_leader()
    {
        return $this->belongsTo(Member::class, 'team_leader_id');
    }

    public function challenge()
    {
        return $this->belongsTo(Challenge::class, 'challenge_id');
    }

    public function actual_solution()
    {
        return $this->belongsTo(ActualSolution::class, 'actual_solution_id');
    }

    public function mentorship_needed()
    {
        return $this->belongsTo(MentorshipNeeded::class, 'mentorship_needed_id');
    }

    public function participation_method()
    {
        return $this->belongsTo(ParticipationMethod::class, 'participation_method_id');
    }

    public function getSubmissionDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setSubmissionDateAttribute($value)
    {
        $this->attributes['submission_date'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid()->substr(0, 4); // Generate a unique 4-digit UUID
        });
    }

}
