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
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }} {{ request()->is("admin/audit-logs*") ? "c-show" : "" }}">
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
                </ul>
            </li>
        @endcan
        @can('bootcamp_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/bootcamp-participants*") ? "c-show" : "" }} {{ request()->is("admin/*") ? "c-show" : "" }} {{ request()->is("admin/*") ? "c-show" : "" }} {{ request()->is("admin/*") ? "c-show" : "" }} {{ request()->is("admin/*") ? "c-show" : "" }} {{ request()->is("admin/qr-codes*") ? "c-show" : "" }} {{ request()->is("admin/emails*") ? "c-show" : "" }}">
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