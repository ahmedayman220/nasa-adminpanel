<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li>
            <select class="searchable-field form-control">

            </select>
        </li>
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }} {{ request()->is("admin/audit-logs*") ? "c-show" : "" }} {{ request()->is("admin/user-challenges*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('audit_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.auditLog.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_challenge_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.user-challenges.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-challenges") || request()->is("admin/user-challenges/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.userChallenge.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('bootcamp_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/bootcamp-participants*") ? "c-show" : "" }} {{ request()->is("admin/*") ? "c-show" : "" }} {{ request()->is("admin/*") ? "c-show" : "" }} {{ request()->is("admin/*") ? "c-show" : "" }} {{ request()->is("admin/*") ? "c-show" : "" }} {{ request()->is("admin/qr-codes*") ? "c-show" : "" }} {{ request()->is("admin/emails*") ? "c-show" : "" }} {{ request()->is("admin/bootcamp-confirmations*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.bootcamp.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('bootcamp_participant_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.bootcamp-participants.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/bootcamp-participants") || request()->is("admin/bootcamp-participants/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-database c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.bootcampParticipant.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('participant_access')
                        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/participant-workshop-assignments*") ? "c-show" : "" }} {{ request()->is("admin/participant-workshop-preferences*") ? "c-show" : "" }}">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-users-cog c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.participant.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('participant_workshop_assignment_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.participant-workshop-assignments.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/participant-workshop-assignments") || request()->is("admin/participant-workshop-assignments/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-chalkboard-teacher c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.participantWorkshopAssignment.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('participant_workshop_preference_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.participant-workshop-preferences.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/participant-workshop-preferences") || request()->is("admin/participant-workshop-preferences/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-user-check c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.participantWorkshopPreference.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('bootcamp_management_access')
                        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/bootcamp-details*") ? "c-show" : "" }} {{ request()->is("admin/bootcamp-attendees*") ? "c-show" : "" }}">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.bootcampManagement.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('bootcamp_detail_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.bootcamp-details.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/bootcamp-details") || request()->is("admin/bootcamp-details/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-info c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.bootcampDetail.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('bootcamp_attendee_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.bootcamp-attendees.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/bootcamp-attendees") || request()->is("admin/bootcamp-attendees/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-user-edit c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.bootcampAttendee.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('workshops_management_access')
                        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/workshops*") ? "c-show" : "" }} {{ request()->is("admin/workshop-schedules*") ? "c-show" : "" }}">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.workshopsManagement.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('workshop_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.workshops.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/workshops") || request()->is("admin/workshops/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.workshop.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('workshop_schedule_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.workshop-schedules.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/workshop-schedules") || request()->is("admin/workshop-schedules/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-calendar-alt c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.workshopSchedule.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('handel_option_access')
                        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/bootcamp-form-descriptions*") ? "c-show" : "" }} {{ request()->is("admin/education-levels*") ? "c-show" : "" }} {{ request()->is("admin/mention-your-fields*") ? "c-show" : "" }} {{ request()->is("admin/study-levels*") ? "c-show" : "" }}">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.handelOption.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('bootcamp_form_description_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.bootcamp-form-descriptions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/bootcamp-form-descriptions") || request()->is("admin/bootcamp-form-descriptions/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-align-center c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.bootcampFormDescription.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('education_level_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.education-levels.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/education-levels") || request()->is("admin/education-levels/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-edit c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.educationLevel.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('mention_your_field_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.mention-your-fields.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/mention-your-fields") || request()->is("admin/mention-your-fields/*") ? "c-active" : "" }}">
                                            <i class="fa-fw far fa-caret-square-down c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.mentionYourField.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('study_level_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.study-levels.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/study-levels") || request()->is("admin/study-levels/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-bolt c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.studyLevel.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('qr_code_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.qr-codes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/qr-codes") || request()->is("admin/qr-codes/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-qrcode c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.qrCode.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('email_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.emails.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/emails") || request()->is("admin/emails/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-envelope c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.email.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('bootcamp_confirmation_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.bootcamp-confirmations.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/bootcamp-confirmations") || request()->is("admin/bootcamp-confirmations/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.bootcampConfirmation.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('hackthon_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/*") ? "c-show" : "" }} {{ request()->is("admin/*") ? "c-show" : "" }} {{ request()->is("admin/*") ? "c-show" : "" }} {{ request()->is("admin/*") ? "c-show" : "" }} {{ request()->is("admin/*") ? "c-show" : "" }} {{ request()->is("admin/*") ? "c-show" : "" }} {{ request()->is("admin/*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.hackthon.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('team_management_access')
                        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/teams*") ? "c-show" : "" }} {{ request()->is("admin/team-skills*") ? "c-show" : "" }} {{ request()->is("admin/team-achievements*") ? "c-show" : "" }}">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.teamManagement.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('team_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.teams.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/teams") || request()->is("admin/teams/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.team.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('team_skill_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.team-skills.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/team-skills") || request()->is("admin/team-skills/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.teamSkill.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('team_achievement_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.team-achievements.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/team-achievements") || request()->is("admin/team-achievements/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.teamAchievement.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('member_management_access')
                        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/members*") ? "c-show" : "" }} {{ request()->is("admin/member-checkpoints*") ? "c-show" : "" }} {{ request()->is("admin/hackathon-qr-codes*") ? "c-show" : "" }}">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.memberManagement.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('member_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.members.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/members") || request()->is("admin/members/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.member.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('member_checkpoint_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.member-checkpoints.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/member-checkpoints") || request()->is("admin/member-checkpoints/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.memberCheckpoint.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('hackathon_qr_code_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.hackathon-qr-codes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/hackathon-qr-codes") || request()->is("admin/hackathon-qr-codes/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.hackathonQrCode.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('challenge_management_access')
                        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/challenges*") ? "c-show" : "" }} {{ request()->is("admin/challenge-categories*") ? "c-show" : "" }} {{ request()->is("admin/h-event-managements*") ? "c-show" : "" }} {{ request()->is("admin/difficulty-levels*") ? "c-show" : "" }}">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.challengeManagement.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('challenge_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.challenges.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/challenges") || request()->is("admin/challenges/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-chalkboard-teacher c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.challenge.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('challenge_category_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.challenge-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/challenge-categories") || request()->is("admin/challenge-categories/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.challengeCategory.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('h_event_management_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.h-event-managements.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/h-event-managements") || request()->is("admin/h-event-managements/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.hEventManagement.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('difficulty_level_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.difficulty-levels.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/difficulty-levels") || request()->is("admin/difficulty-levels/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.difficultyLevel.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('event_management_access')
                        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/events*") ? "c-show" : "" }} {{ request()->is("admin/checkpoints*") ? "c-show" : "" }} {{ request()->is("admin/checkpoint-types*") ? "c-show" : "" }} {{ request()->is("admin/transportations*") ? "c-show" : "" }}">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.eventManagement.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('event_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.events.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/events") || request()->is("admin/events/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.event.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('checkpoint_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.checkpoints.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/checkpoints") || request()->is("admin/checkpoints/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.checkpoint.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('checkpoint_type_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.checkpoint-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/checkpoint-types") || request()->is("admin/checkpoint-types/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.checkpointType.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('transportation_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.transportations.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/transportations") || request()->is("admin/transportations/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.transportation.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('evaluation_system_access')
                        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/evaluations*") ? "c-show" : "" }} {{ request()->is("admin/evaluation-criteria*") ? "c-show" : "" }} {{ request()->is("admin/judges*") ? "c-show" : "" }}">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.evaluationSystem.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('evaluation_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.evaluations.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/evaluations") || request()->is("admin/evaluations/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.evaluation.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('evaluation_criterion_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.evaluation-criteria.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/evaluation-criteria") || request()->is("admin/evaluation-criteria/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.evaluationCriterion.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('judge_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.judges.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/judges") || request()->is("admin/judges/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.judge.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('skills_and_achievement_access')
                        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/skills*") ? "c-show" : "" }} {{ request()->is("admin/achievements*") ? "c-show" : "" }}">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.skillsAndAchievement.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('skill_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.skills.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/skills") || request()->is("admin/skills/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.skill.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('achievement_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.achievements.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/achievements") || request()->is("admin/achievements/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.achievement.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('hackathon_form_option_access')
                        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/actual-solutions*") ? "c-show" : "" }} {{ request()->is("admin/mentorship-neededs*") ? "c-show" : "" }} {{ request()->is("admin/participation-methods*") ? "c-show" : "" }} {{ request()->is("admin/member-roles*") ? "c-show" : "" }} {{ request()->is("admin/study-levelsses*") ? "c-show" : "" }} {{ request()->is("admin/majors*") ? "c-show" : "" }} {{ request()->is("admin/tshirt-sizes*") ? "c-show" : "" }}">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.hackathonFormOption.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('actual_solution_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.actual-solutions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/actual-solutions") || request()->is("admin/actual-solutions/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.actualSolution.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('mentorship_needed_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.mentorship-neededs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/mentorship-neededs") || request()->is("admin/mentorship-neededs/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.mentorshipNeeded.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('participation_method_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.participation-methods.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/participation-methods") || request()->is("admin/participation-methods/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.participationMethod.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('member_role_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.member-roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/member-roles") || request()->is("admin/member-roles/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.memberRole.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('study_levelss_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.study-levelsses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/study-levelsses") || request()->is("admin/study-levelsses/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.studyLevelss.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('major_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.majors.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/majors") || request()->is("admin/majors/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.major.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('tshirt_size_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.tshirt-sizes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tshirt-sizes") || request()->is("admin/tshirt-sizes/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.tshirtSize.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('chatbot_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/chatbot-traning-datas*") ? "c-show" : "" }} {{ request()->is("admin/chatbot-replies*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-headset c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.chatbot.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('chatbot_traning_data_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.chatbot-traning-datas.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/chatbot-traning-datas") || request()->is("admin/chatbot-traning-datas/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-globe c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.chatbotTraningData.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('chatbot_reply_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.chatbot-replies.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/chatbot-replies") || request()->is("admin/chatbot-replies/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.chatbotReply.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('time_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/time-work-types*") ? "c-show" : "" }} {{ request()->is("admin/time-projects*") ? "c-show" : "" }} {{ request()->is("admin/time-entries*") ? "c-show" : "" }} {{ request()->is("admin/time-reports*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-clock c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.timeManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('time_work_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.time-work-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/time-work-types") || request()->is("admin/time-work-types/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-th c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.timeWorkType.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('time_project_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.time-projects.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/time-projects") || request()->is("admin/time-projects/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.timeProject.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('time_entry_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.time-entries.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/time-entries") || request()->is("admin/time-entries/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.timeEntry.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('time_report_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.time-reports.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/time-reports") || request()->is("admin/time-reports/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-chart-line c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.timeReport.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('contact_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/contact-companies*") ? "c-show" : "" }} {{ request()->is("admin/contact-contacts*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-phone-square c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.contactManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('contact_company_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.contact-companies.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/contact-companies") || request()->is("admin/contact-companies/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-building c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contactCompany.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('contact_contact_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.contact-contacts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/contact-contacts") || request()->is("admin/contact-contacts/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user-plus c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contactContact.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('user_alert_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.user-alerts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-bell c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userAlert.title') }}
                </a>
            </li>
        @endcan
        @can('task_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/task-statuses*") ? "c-show" : "" }} {{ request()->is("admin/task-tags*") ? "c-show" : "" }} {{ request()->is("admin/tasks*") ? "c-show" : "" }} {{ request()->is("admin/tasks-calendars*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-list c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.taskManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('task_status_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.task-statuses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/task-statuses") || request()->is("admin/task-statuses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-server c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.taskStatus.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('task_tag_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.task-tags.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/task-tags") || request()->is("admin/task-tags/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-server c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.taskTag.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('task_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tasks.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tasks") || request()->is("admin/tasks/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.task.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('tasks_calendar_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tasks-calendars.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tasks-calendars") || request()->is("admin/tasks-calendars/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-calendar c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.tasksCalendar.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('asset_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/asset-categories*") ? "c-show" : "" }} {{ request()->is("admin/asset-locations*") ? "c-show" : "" }} {{ request()->is("admin/asset-statuses*") ? "c-show" : "" }} {{ request()->is("admin/assets*") ? "c-show" : "" }} {{ request()->is("admin/assets-histories*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-book c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.assetManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('asset_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.asset-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/asset-categories") || request()->is("admin/asset-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-tags c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.assetCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('asset_location_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.asset-locations.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/asset-locations") || request()->is("admin/asset-locations/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-map-marker c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.assetLocation.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('asset_status_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.asset-statuses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/asset-statuses") || request()->is("admin/asset-statuses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-server c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.assetStatus.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('asset_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.assets.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/assets") || request()->is("admin/assets/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-book c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.asset.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('assets_history_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.assets-histories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/assets-histories") || request()->is("admin/assets-histories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-th-list c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.assetsHistory.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.systemCalendar") }}" class="c-sidebar-nav-link {{ request()->is("admin/system-calendar") || request()->is("admin/system-calendar/*") ? "c-active" : "" }}">
                <i class="c-sidebar-nav-icon fa-fw fas fa-calendar">

                </i>
                {{ trans('global.systemCalendar') }}
            </a>
        </li>
        @php($unread = \App\Models\QaTopic::unreadCount())
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.messenger.index") }}" class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "c-active" : "" }} c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fa-fw fa fa-envelope">

                </i>
                <span>{{ trans('global.messages') }}</span>
                @if($unread > 0)
                    <strong>( {{ $unread }} )</strong>
                @endif

            </a>
        </li>
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>
