<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Str;

class Team extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;


    public $table = 'teams';

    public const STATUS_SELECT = [
        'accepted_onsite' => 'Accepted On Site',
        'accepted_virtual' => 'Accepted Virtual',
        'rejected' => 'Rejected',
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
        "participated_hackathons",
        'status',
        'submission_date',
        'extra_field',
        'comment',
        'confrimation',
        'nots',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'team_photo',
    ];

    public function members()
    {
        return $this->belongsToMany(Member::class, 'member_team', 'team_id', 'member_id')
            ->withTimestamps();
    }

    public static function getMemberCountCategoriesForAcceptedOnsite()
    {
        return DB::table('member_team')
            ->join('teams', 'member_team.team_id', '=', 'teams.id')
            ->where('teams.status', 'accepted_onsite')
            ->select('member_team.team_id', DB::raw('COUNT(*) as member_count'))
            ->groupBy('member_team.team_id')
            ->get()
            ->groupBy('member_count')
            ->map->count()
            ->sortKeys();
    }


    // Handle adding members to the team
    public function addMembers(array $members, $leaderId)
    {
        foreach ($members as $memberData) {
            // Check if member already exists
            $member = Member::find($memberData['id'] ?? null) ?? new Member();
            $member->fill($memberData);
            $member->save();

            // If the uploaded photo exists, handle the photo
            if (isset($memberData['photo'])) {
                $member->addPhoto($memberData['photo']);
            }

            // Attach member to the team
            $this->members()->attach($member->id);

            // Set the team leader if the ID matches
            if ($member->id == $leaderId) {
                $this->team_leader_id = $member->id;
            }
        }

        // Save the team with updated leader ID
        $this->save();
    }


    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getPhotoAttribute()
    {
        $file = $this->getMedia('team_photo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
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

    public function getTeamPhotoAttribute()
    {
        $file = $this->getMedia('team_photo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
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

    protected static function generateUniqueFourDigitUuid()
    {
        do {
            // Generate a 4-digit number
            $uuid = mt_rand(1000, 9999);
        } while (self::where('uuid', $uuid)->exists()); // Check if the UUID already exists

        return $uuid;
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = self::generateUniqueFourDigitUuid(); // Generate a unique 4-digit UUID
        });
    }


}
