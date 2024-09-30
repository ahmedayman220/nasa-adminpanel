<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', '2fa']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Education Level
    Route::delete('education-levels/destroy', 'EducationLevelController@massDestroy')->name('education-levels.massDestroy');
    Route::post('education-levels/parse-csv-import', 'EducationLevelController@parseCsvImport')->name('education-levels.parseCsvImport');
    Route::post('education-levels/process-csv-import', 'EducationLevelController@processCsvImport')->name('education-levels.processCsvImport');
    Route::resource('education-levels', 'EducationLevelController');

    // Mention Your Field
    Route::delete('mention-your-fields/destroy', 'MentionYourFieldController@massDestroy')->name('mention-your-fields.massDestroy');
    Route::post('mention-your-fields/parse-csv-import', 'MentionYourFieldController@parseCsvImport')->name('mention-your-fields.parseCsvImport');
    Route::post('mention-your-fields/process-csv-import', 'MentionYourFieldController@processCsvImport')->name('mention-your-fields.processCsvImport');
    Route::resource('mention-your-fields', 'MentionYourFieldController');

    // Bootcamp Form Descriptions
    Route::delete('bootcamp-form-descriptions/destroy', 'BootcampFormDescriptionsController@massDestroy')->name('bootcamp-form-descriptions.massDestroy');
    Route::post('bootcamp-form-descriptions/media', 'BootcampFormDescriptionsController@storeMedia')->name('bootcamp-form-descriptions.storeMedia');
    Route::post('bootcamp-form-descriptions/ckmedia', 'BootcampFormDescriptionsController@storeCKEditorImages')->name('bootcamp-form-descriptions.storeCKEditorImages');
    Route::post('bootcamp-form-descriptions/parse-csv-import', 'BootcampFormDescriptionsController@parseCsvImport')->name('bootcamp-form-descriptions.parseCsvImport');
    Route::post('bootcamp-form-descriptions/process-csv-import', 'BootcampFormDescriptionsController@processCsvImport')->name('bootcamp-form-descriptions.processCsvImport');
    Route::resource('bootcamp-form-descriptions', 'BootcampFormDescriptionsController');

    // Study Level
    Route::delete('study-levels/destroy', 'StudyLevelController@massDestroy')->name('study-levels.massDestroy');
    Route::post('study-levels/parse-csv-import', 'StudyLevelController@parseCsvImport')->name('study-levels.parseCsvImport');
    Route::post('study-levels/process-csv-import', 'StudyLevelController@processCsvImport')->name('study-levels.processCsvImport');
    Route::resource('study-levels', 'StudyLevelController');

    // Workshops
    Route::delete('workshops/destroy', 'WorkshopsController@massDestroy')->name('workshops.massDestroy');
    Route::post('workshops/media', 'WorkshopsController@storeMedia')->name('workshops.storeMedia');
    Route::post('workshops/ckmedia', 'WorkshopsController@storeCKEditorImages')->name('workshops.storeCKEditorImages');
    Route::post('workshops/parse-csv-import', 'WorkshopsController@parseCsvImport')->name('workshops.parseCsvImport');
    Route::post('workshops/process-csv-import', 'WorkshopsController@processCsvImport')->name('workshops.processCsvImport');
    Route::resource('workshops', 'WorkshopsController');

    // Workshop Schedules
    Route::delete('workshop-schedules/destroy', 'WorkshopSchedulesController@massDestroy')->name('workshop-schedules.massDestroy');
    Route::post('workshop-schedules/parse-csv-import', 'WorkshopSchedulesController@parseCsvImport')->name('workshop-schedules.parseCsvImport');
    Route::post('workshop-schedules/process-csv-import', 'WorkshopSchedulesController@processCsvImport')->name('workshop-schedules.processCsvImport');
    Route::resource('workshop-schedules', 'WorkshopSchedulesController');

    // Bootcamp Participants
    Route::delete('bootcamp-participants/destroy', 'BootcampParticipantsController@massDestroy')->name('bootcamp-participants.massDestroy');
    Route::post('bootcamp-participants/media', 'BootcampParticipantsController@storeMedia')->name('bootcamp-participants.storeMedia');
    Route::post('bootcamp-participants/ckmedia', 'BootcampParticipantsController@storeCKEditorImages')->name('bootcamp-participants.storeCKEditorImages');
    Route::post('bootcamp-participants/parse-csv-import', 'BootcampParticipantsController@parseCsvImport')->name('bootcamp-participants.parseCsvImport');
    Route::post('bootcamp-participants/process-csv-import', 'BootcampParticipantsController@processCsvImport')->name('bootcamp-participants.processCsvImport');
    Route::get('bootcamp-participants/media','BootcampParticipantsController@getMedia')->name('bootcamp-participants.get.media');
    Route::get('bootcamp-participants/faild-email','BootcampParticipantsController@faildEmail')->name('bootcamp-participants.get.faild.email');
    Route::resource('bootcamp-participants', 'BootcampParticipantsController');

    // Participant Workshop Assignment
    Route::delete('participant-workshop-assignments/destroy', 'ParticipantWorkshopAssignmentController@massDestroy')->name('participant-workshop-assignments.massDestroy');
    Route::post('participant-workshop-assignments/parse-csv-import', 'ParticipantWorkshopAssignmentController@parseCsvImport')->name('participant-workshop-assignments.parseCsvImport');
    Route::post('participant-workshop-assignments/process-csv-import', 'ParticipantWorkshopAssignmentController@processCsvImport')->name('participant-workshop-assignments.processCsvImport');
    Route::resource('participant-workshop-assignments', 'ParticipantWorkshopAssignmentController');

    // Participant Workshop Preference
    Route::delete('participant-workshop-preferences/destroy', 'ParticipantWorkshopPreferenceController@massDestroy')->name('participant-workshop-preferences.massDestroy');
    Route::post('participant-workshop-preferences/parse-csv-import', 'ParticipantWorkshopPreferenceController@parseCsvImport')->name('participant-workshop-preferences.parseCsvImport');
    Route::post('participant-workshop-preferences/process-csv-import', 'ParticipantWorkshopPreferenceController@processCsvImport')->name('participant-workshop-preferences.processCsvImport');
    Route::resource('participant-workshop-preferences', 'ParticipantWorkshopPreferenceController');

    // Bootcamp Details
    Route::delete('bootcamp-details/destroy', 'BootcampDetailsController@massDestroy')->name('bootcamp-details.massDestroy');
    Route::post('bootcamp-details/parse-csv-import', 'BootcampDetailsController@parseCsvImport')->name('bootcamp-details.parseCsvImport');
    Route::post('bootcamp-details/process-csv-import', 'BootcampDetailsController@processCsvImport')->name('bootcamp-details.processCsvImport');
    Route::resource('bootcamp-details', 'BootcampDetailsController');

    // Bootcamp Attendees
    Route::delete('bootcamp-attendees/destroy', 'BootcampAttendeesController@massDestroy')->name('bootcamp-attendees.massDestroy');
    Route::post('bootcamp-attendees/parse-csv-import', 'BootcampAttendeesController@parseCsvImport')->name('bootcamp-attendees.parseCsvImport');
    Route::post('bootcamp-attendees/process-csv-import', 'BootcampAttendeesController@processCsvImport')->name('bootcamp-attendees.processCsvImport');
    Route::resource('bootcamp-attendees', 'BootcampAttendeesController');
    // Bootcamp Attendees Generate and Email
    Route::post('bootcamp-attendees/generateQr','QrGeneratorController@generateAndEmail')->name('bootcamp-attendees.generate.email');
    Route::post('bootcamp-attendees/iu','QrGeneratorController@generateAndEmailIU')->name('bootcamp-attendees.generate.email.iu');
    Route::get('bootcamp-attendees/scan/{value}', 'QrGeneratorController@scanBootcampAttendee')->name('bootcamp-attendees.scan');
    // Scan Participant workshop assignment
    Route::get('workshop-assignment/scan/{value}', 'QrGeneratorController@scanWorkshop')->name('bootcamp-attendees.scan');

    // Time Work Type
    Route::delete('time-work-types/destroy', 'TimeWorkTypeController@massDestroy')->name('time-work-types.massDestroy');
    Route::resource('time-work-types', 'TimeWorkTypeController');

    // Time Project
    Route::delete('time-projects/destroy', 'TimeProjectController@massDestroy')->name('time-projects.massDestroy');
    Route::post('time-projects/parse-csv-import', 'TimeProjectController@parseCsvImport')->name('time-projects.parseCsvImport');
    Route::post('time-projects/process-csv-import', 'TimeProjectController@processCsvImport')->name('time-projects.processCsvImport');
    Route::resource('time-projects', 'TimeProjectController');

    // Time Entry
    Route::delete('time-entries/destroy', 'TimeEntryController@massDestroy')->name('time-entries.massDestroy');
    Route::post('time-entries/parse-csv-import', 'TimeEntryController@parseCsvImport')->name('time-entries.parseCsvImport');
    Route::post('time-entries/process-csv-import', 'TimeEntryController@processCsvImport')->name('time-entries.processCsvImport');
    Route::resource('time-entries', 'TimeEntryController');

    // Time Report
    Route::delete('time-reports/destroy', 'TimeReportController@massDestroy')->name('time-reports.massDestroy');
    Route::resource('time-reports', 'TimeReportController');

    // Contact Company
    Route::delete('contact-companies/destroy', 'ContactCompanyController@massDestroy')->name('contact-companies.massDestroy');
    Route::post('contact-companies/parse-csv-import', 'ContactCompanyController@parseCsvImport')->name('contact-companies.parseCsvImport');
    Route::post('contact-companies/process-csv-import', 'ContactCompanyController@processCsvImport')->name('contact-companies.processCsvImport');
    Route::resource('contact-companies', 'ContactCompanyController');

    // Contact Contacts
    Route::delete('contact-contacts/destroy', 'ContactContactsController@massDestroy')->name('contact-contacts.massDestroy');
    Route::resource('contact-contacts', 'ContactContactsController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Task Status
    Route::delete('task-statuses/destroy', 'TaskStatusController@massDestroy')->name('task-statuses.massDestroy');
    Route::resource('task-statuses', 'TaskStatusController');

    // Task Tag
    Route::delete('task-tags/destroy', 'TaskTagController@massDestroy')->name('task-tags.massDestroy');
    Route::resource('task-tags', 'TaskTagController');

    // Task
    Route::delete('tasks/destroy', 'TaskController@massDestroy')->name('tasks.massDestroy');
    Route::post('tasks/media', 'TaskController@storeMedia')->name('tasks.storeMedia');
    Route::post('tasks/ckmedia', 'TaskController@storeCKEditorImages')->name('tasks.storeCKEditorImages');
    Route::resource('tasks', 'TaskController');

    // Tasks Calendar
    Route::resource('tasks-calendars', 'TasksCalendarController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Asset Category
    Route::delete('asset-categories/destroy', 'AssetCategoryController@massDestroy')->name('asset-categories.massDestroy');
    Route::resource('asset-categories', 'AssetCategoryController');

    // Asset Location
    Route::delete('asset-locations/destroy', 'AssetLocationController@massDestroy')->name('asset-locations.massDestroy');
    Route::resource('asset-locations', 'AssetLocationController');

    // Asset Status
    Route::delete('asset-statuses/destroy', 'AssetStatusController@massDestroy')->name('asset-statuses.massDestroy');
    Route::resource('asset-statuses', 'AssetStatusController');

    // Asset
    Route::delete('assets/destroy', 'AssetController@massDestroy')->name('assets.massDestroy');
    Route::post('assets/media', 'AssetController@storeMedia')->name('assets.storeMedia');
    Route::post('assets/ckmedia', 'AssetController@storeCKEditorImages')->name('assets.storeCKEditorImages');
    Route::resource('assets', 'AssetController');

    // Assets History
    Route::resource('assets-histories', 'AssetsHistoryController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Chatbot Replies
    Route::delete('chatbot-replies/destroy', 'ChatbotRepliesController@massDestroy')->name('chatbot-replies.massDestroy');
    Route::post('chatbot-replies/media', 'ChatbotRepliesController@storeMedia')->name('chatbot-replies.storeMedia');
    Route::post('chatbot-replies/ckmedia', 'ChatbotRepliesController@storeCKEditorImages')->name('chatbot-replies.storeCKEditorImages');
    Route::post('chatbot-replies/parse-csv-import', 'ChatbotRepliesController@parseCsvImport')->name('chatbot-replies.parseCsvImport');
    Route::post('chatbot-replies/process-csv-import', 'ChatbotRepliesController@processCsvImport')->name('chatbot-replies.processCsvImport');
    Route::resource('chatbot-replies', 'ChatbotRepliesController');

    // Chatbot Traning Data
    Route::delete('chatbot-traning-datas/destroy', 'ChatbotTraningDataController@massDestroy')->name('chatbot-traning-datas.massDestroy');
    Route::post('chatbot-traning-datas/media', 'ChatbotTraningDataController@storeMedia')->name('chatbot-traning-datas.storeMedia');
    Route::post('chatbot-traning-datas/ckmedia', 'ChatbotTraningDataController@storeCKEditorImages')->name('chatbot-traning-datas.storeCKEditorImages');
    Route::post('chatbot-traning-datas/parse-csv-import', 'ChatbotTraningDataController@parseCsvImport')->name('chatbot-traning-datas.parseCsvImport');
    Route::post('chatbot-traning-datas/process-csv-import', 'ChatbotTraningDataController@processCsvImport')->name('chatbot-traning-datas.processCsvImport');
    Route::resource('chatbot-traning-datas', 'ChatbotTraningDataController');

    // Qr Codes
    Route::delete('qr-codes/destroy', 'QrCodesController@massDestroy')->name('qr-codes.massDestroy');
    Route::post('qr-codes/parse-csv-import', 'QrCodesController@parseCsvImport')->name('qr-codes.parseCsvImport');
    Route::post('qr-codes/process-csv-import', 'QrCodesController@processCsvImport')->name('qr-codes.processCsvImport');
    Route::resource('qr-codes', 'QrCodesController');

    // Emails
    Route::delete('emails/destroy', 'EmailsController@massDestroy')->name('emails.massDestroy');
    Route::post('emails/parse-csv-import', 'EmailsController@parseCsvImport')->name('emails.parseCsvImport');
    Route::post('emails/process-csv-import', 'EmailsController@processCsvImport')->name('emails.processCsvImport');
    Route::resource('emails', 'EmailsController');

    // Bootcamp Confirmation
    Route::delete('bootcamp-confirmations/destroy', 'BootcampConfirmationController@massDestroy')->name('bootcamp-confirmations.massDestroy');
    Route::post('bootcamp-confirmations/parse-csv-import', 'BootcampConfirmationController@parseCsvImport')->name('bootcamp-confirmations.parseCsvImport');
    Route::post('bootcamp-confirmations/process-csv-import', 'BootcampConfirmationController@processCsvImport')->name('bootcamp-confirmations.processCsvImport');
    Route::resource('bootcamp-confirmations', 'BootcampConfirmationController');

    // Challenges
    Route::delete('challenges/destroy', 'ChallengesController@massDestroy')->name('challenges.massDestroy');
    Route::post('challenges/media', 'ChallengesController@storeMedia')->name('challenges.storeMedia');
    Route::post('challenges/ckmedia', 'ChallengesController@storeCKEditorImages')->name('challenges.storeCKEditorImages');
    Route::post('challenges/parse-csv-import', 'ChallengesController@parseCsvImport')->name('challenges.parseCsvImport');
    Route::post('challenges/process-csv-import', 'ChallengesController@processCsvImport')->name('challenges.processCsvImport');
    Route::resource('challenges', 'ChallengesController');

    // Actual Solution
    Route::delete('actual-solutions/destroy', 'ActualSolutionController@massDestroy')->name('actual-solutions.massDestroy');
    Route::post('actual-solutions/parse-csv-import', 'ActualSolutionController@parseCsvImport')->name('actual-solutions.parseCsvImport');
    Route::post('actual-solutions/process-csv-import', 'ActualSolutionController@processCsvImport')->name('actual-solutions.processCsvImport');
    Route::resource('actual-solutions', 'ActualSolutionController');

    // Mentorship Needed
    Route::delete('mentorship-neededs/destroy', 'MentorshipNeededController@massDestroy')->name('mentorship-neededs.massDestroy');
    Route::post('mentorship-neededs/media', 'MentorshipNeededController@storeMedia')->name('mentorship-neededs.storeMedia');
    Route::post('mentorship-neededs/ckmedia', 'MentorshipNeededController@storeCKEditorImages')->name('mentorship-neededs.storeCKEditorImages');
    Route::post('mentorship-neededs/parse-csv-import', 'MentorshipNeededController@parseCsvImport')->name('mentorship-neededs.parseCsvImport');
    Route::post('mentorship-neededs/process-csv-import', 'MentorshipNeededController@processCsvImport')->name('mentorship-neededs.processCsvImport');
    Route::resource('mentorship-neededs', 'MentorshipNeededController');

    // Participation Method
    Route::delete('participation-methods/destroy', 'ParticipationMethodController@massDestroy')->name('participation-methods.massDestroy');
    Route::post('participation-methods/media', 'ParticipationMethodController@storeMedia')->name('participation-methods.storeMedia');
    Route::post('participation-methods/ckmedia', 'ParticipationMethodController@storeCKEditorImages')->name('participation-methods.storeCKEditorImages');
    Route::post('participation-methods/parse-csv-import', 'ParticipationMethodController@parseCsvImport')->name('participation-methods.parseCsvImport');
    Route::post('participation-methods/process-csv-import', 'ParticipationMethodController@processCsvImport')->name('participation-methods.processCsvImport');
    Route::resource('participation-methods', 'ParticipationMethodController');

    // Member Role
    Route::delete('member-roles/destroy', 'MemberRoleController@massDestroy')->name('member-roles.massDestroy');
    Route::post('member-roles/media', 'MemberRoleController@storeMedia')->name('member-roles.storeMedia');
    Route::post('member-roles/ckmedia', 'MemberRoleController@storeCKEditorImages')->name('member-roles.storeCKEditorImages');
    Route::post('member-roles/parse-csv-import', 'MemberRoleController@parseCsvImport')->name('member-roles.parseCsvImport');
    Route::post('member-roles/process-csv-import', 'MemberRoleController@processCsvImport')->name('member-roles.processCsvImport');
    Route::resource('member-roles', 'MemberRoleController');

    // Study Levelss
    Route::delete('study-levelsses/destroy', 'StudyLevelssController@massDestroy')->name('study-levelsses.massDestroy');
    Route::post('study-levelsses/media', 'StudyLevelssController@storeMedia')->name('study-levelsses.storeMedia');
    Route::post('study-levelsses/ckmedia', 'StudyLevelssController@storeCKEditorImages')->name('study-levelsses.storeCKEditorImages');
    Route::post('study-levelsses/parse-csv-import', 'StudyLevelssController@parseCsvImport')->name('study-levelsses.parseCsvImport');
    Route::post('study-levelsses/process-csv-import', 'StudyLevelssController@processCsvImport')->name('study-levelsses.processCsvImport');
    Route::resource('study-levelsses', 'StudyLevelssController');

    // Major
    Route::delete('majors/destroy', 'MajorController@massDestroy')->name('majors.massDestroy');
    Route::post('majors/media', 'MajorController@storeMedia')->name('majors.storeMedia');
    Route::post('majors/ckmedia', 'MajorController@storeCKEditorImages')->name('majors.storeCKEditorImages');
    Route::post('majors/parse-csv-import', 'MajorController@parseCsvImport')->name('majors.parseCsvImport');
    Route::post('majors/process-csv-import', 'MajorController@processCsvImport')->name('majors.processCsvImport');
    Route::resource('majors', 'MajorController');

    // Tshirt Size
    Route::delete('tshirt-sizes/destroy', 'TshirtSizeController@massDestroy')->name('tshirt-sizes.massDestroy');
    Route::post('tshirt-sizes/parse-csv-import', 'TshirtSizeController@parseCsvImport')->name('tshirt-sizes.parseCsvImport');
    Route::post('tshirt-sizes/process-csv-import', 'TshirtSizeController@processCsvImport')->name('tshirt-sizes.processCsvImport');
    Route::resource('tshirt-sizes', 'TshirtSizeController');

    // Team
    Route::delete('teams/destroy', 'TeamController@massDestroy')->name('teams.massDestroy');
    Route::post('teams/media', 'TeamController@storeMedia')->name('teams.storeMedia');
    Route::post('teams/ckmedia', 'TeamController@storeCKEditorImages')->name('teams.storeCKEditorImages');
    Route::post('teams/parse-csv-import', 'TeamController@parseCsvImport')->name('teams.parseCsvImport');
    Route::post('teams/process-csv-import', 'TeamController@processCsvImport')->name('teams.processCsvImport');
    Route::post('teams/update-score/{id}','TeamController@updateTeamScore')->name('teams.updateTeamScore');
    Route::post('teams/update-status','TeamController@updateTeamStatus')->name('teams.updateTeamStatus');
    Route::get('teams/onsite','TeamController@showOnsiteTeams')->name('teams.showOnsite');
    Route::get('teams/all','TeamController@AllTeams')->name('teams.all');
    Route::get('teams/virtual','TeamController@showVirtualTeams')->name('teams.showVirtual');
    Route::get('teams/rejected','TeamController@showRejectedTeams')->name('teams.showRejected');
    Route::post('teams/generateAndEmail','TeamController@generateAndEmail')->name('teams.generateAndEmail');
    Route::get('teams/showAllData','TeamController@showAll')->name('teams.showAll');
    Route::resource('teams', 'TeamController');

    // Team Skills
    Route::delete('team-skills/destroy', 'TeamSkillsController@massDestroy')->name('team-skills.massDestroy');
    Route::post('team-skills/parse-csv-import', 'TeamSkillsController@parseCsvImport')->name('team-skills.parseCsvImport');
    Route::post('team-skills/process-csv-import', 'TeamSkillsController@processCsvImport')->name('team-skills.processCsvImport');
    Route::resource('team-skills', 'TeamSkillsController');

    // Team Achievements
    Route::delete('team-achievements/destroy', 'TeamAchievementsController@massDestroy')->name('team-achievements.massDestroy');
    Route::post('team-achievements/parse-csv-import', 'TeamAchievementsController@parseCsvImport')->name('team-achievements.parseCsvImport');
    Route::post('team-achievements/process-csv-import', 'TeamAchievementsController@processCsvImport')->name('team-achievements.processCsvImport');
    Route::resource('team-achievements', 'TeamAchievementsController');

    // Members
    Route::delete('members/destroy', 'MembersController@massDestroy')->name('members.massDestroy');
    Route::post('members/media', 'MembersController@storeMedia')->name('members.storeMedia');
    Route::post('members/ckmedia', 'MembersController@storeCKEditorImages')->name('members.storeCKEditorImages');
    Route::post('members/parse-csv-import', 'MembersController@parseCsvImport')->name('members.parseCsvImport');
    Route::post('members/process-csv-import', 'MembersController@processCsvImport')->name('members.processCsvImport');
    Route::get('members/media', 'MembersController@getMedia')->name('members.media');
    Route::get('members/showOnsiteMembers', 'MembersController@showOnsiteMembers')->name('members.showOnsiteMembers');
    Route::resource('members', 'MembersController');

    // Member Checkpoints
    Route::delete('member-checkpoints/destroy', 'MemberCheckpointsController@massDestroy')->name('member-checkpoints.massDestroy');
    Route::post('member-checkpoints/parse-csv-import', 'MemberCheckpointsController@parseCsvImport')->name('member-checkpoints.parseCsvImport');
    Route::post('member-checkpoints/process-csv-import', 'MemberCheckpointsController@processCsvImport')->name('member-checkpoints.processCsvImport');
    Route::resource('member-checkpoints', 'MemberCheckpointsController');

    // Hackathon Qr Codes
    Route::delete('hackathon-qr-codes/destroy', 'HackathonQrCodesController@massDestroy')->name('hackathon-qr-codes.massDestroy');
    Route::post('hackathon-qr-codes/parse-csv-import', 'HackathonQrCodesController@parseCsvImport')->name('hackathon-qr-codes.parseCsvImport');
    Route::post('hackathon-qr-codes/process-csv-import', 'HackathonQrCodesController@processCsvImport')->name('hackathon-qr-codes.processCsvImport');
    Route::resource('hackathon-qr-codes', 'HackathonQrCodesController');

    // Challenge Categories
    Route::delete('challenge-categories/destroy', 'ChallengeCategoriesController@massDestroy')->name('challenge-categories.massDestroy');
    Route::resource('challenge-categories', 'ChallengeCategoriesController');

    // H Event Management
    Route::delete('h-event-managements/destroy', 'HEventManagementController@massDestroy')->name('h-event-managements.massDestroy');
    Route::post('h-event-managements/parse-csv-import', 'HEventManagementController@parseCsvImport')->name('h-event-managements.parseCsvImport');
    Route::post('h-event-managements/process-csv-import', 'HEventManagementController@processCsvImport')->name('h-event-managements.processCsvImport');
    Route::resource('h-event-managements', 'HEventManagementController');

    // Events
    Route::delete('events/destroy', 'EventsController@massDestroy')->name('events.massDestroy');
    Route::post('events/parse-csv-import', 'EventsController@parseCsvImport')->name('events.parseCsvImport');
    Route::post('events/process-csv-import', 'EventsController@processCsvImport')->name('events.processCsvImport');
    Route::resource('events', 'EventsController');

    // Checkpoints
    Route::delete('checkpoints/destroy', 'CheckpointsController@massDestroy')->name('checkpoints.massDestroy');
    Route::post('checkpoints/media', 'CheckpointsController@storeMedia')->name('checkpoints.storeMedia');
    Route::post('checkpoints/ckmedia', 'CheckpointsController@storeCKEditorImages')->name('checkpoints.storeCKEditorImages');
    Route::post('checkpoints/parse-csv-import', 'CheckpointsController@parseCsvImport')->name('checkpoints.parseCsvImport');
    Route::post('checkpoints/process-csv-import', 'CheckpointsController@processCsvImport')->name('checkpoints.processCsvImport');
    Route::get('checkpoints/scan/{uuid}/{checkpoint_id}/{checkpoint_name}', 'CheckpointsController@handlingScan')->name('checkpoints.handlingScan');
    Route::post('checkpoints/scan', 'CheckpointsController@manualScan')->name('checkpoints.manualScan');
    Route::resource('checkpoints', 'CheckpointsController');

    // Checkpoint Types
    Route::delete('checkpoint-types/destroy', 'CheckpointTypesController@massDestroy')->name('checkpoint-types.massDestroy');
    Route::post('checkpoint-types/parse-csv-import', 'CheckpointTypesController@parseCsvImport')->name('checkpoint-types.parseCsvImport');
    Route::post('checkpoint-types/process-csv-import', 'CheckpointTypesController@processCsvImport')->name('checkpoint-types.processCsvImport');
    Route::resource('checkpoint-types', 'CheckpointTypesController');

    // Evaluations
    Route::delete('evaluations/destroy', 'EvaluationsController@massDestroy')->name('evaluations.massDestroy');
    Route::post('evaluations/parse-csv-import', 'EvaluationsController@parseCsvImport')->name('evaluations.parseCsvImport');
    Route::post('evaluations/process-csv-import', 'EvaluationsController@processCsvImport')->name('evaluations.processCsvImport');
    Route::resource('evaluations', 'EvaluationsController');

    // Evaluation Criteria
    Route::delete('evaluation-criteria/destroy', 'EvaluationCriteriaController@massDestroy')->name('evaluation-criteria.massDestroy');
    Route::post('evaluation-criteria/parse-csv-import', 'EvaluationCriteriaController@parseCsvImport')->name('evaluation-criteria.parseCsvImport');
    Route::post('evaluation-criteria/process-csv-import', 'EvaluationCriteriaController@processCsvImport')->name('evaluation-criteria.processCsvImport');
    Route::resource('evaluation-criteria', 'EvaluationCriteriaController');

    // Judges
    Route::delete('judges/destroy', 'JudgesController@massDestroy')->name('judges.massDestroy');
    Route::post('judges/parse-csv-import', 'JudgesController@parseCsvImport')->name('judges.parseCsvImport');
    Route::post('judges/process-csv-import', 'JudgesController@processCsvImport')->name('judges.processCsvImport');
    Route::resource('judges', 'JudgesController');

    // Skills
    Route::delete('skills/destroy', 'SkillsController@massDestroy')->name('skills.massDestroy');
    Route::post('skills/parse-csv-import', 'SkillsController@parseCsvImport')->name('skills.parseCsvImport');
    Route::post('skills/process-csv-import', 'SkillsController@processCsvImport')->name('skills.processCsvImport');
    Route::resource('skills', 'SkillsController');

    // Achievements
    Route::delete('achievements/destroy', 'AchievementsController@massDestroy')->name('achievements.massDestroy');
    Route::post('achievements/parse-csv-import', 'AchievementsController@parseCsvImport')->name('achievements.parseCsvImport');
    Route::post('achievements/process-csv-import', 'AchievementsController@processCsvImport')->name('achievements.processCsvImport');
    Route::resource('achievements', 'AchievementsController');

    // User Challenges
    Route::delete('user-challenges/destroy', 'UserChallengesController@massDestroy')->name('user-challenges.massDestroy');
    Route::resource('user-challenges', 'UserChallengesController');

    // Transportation
    Route::delete('transportations/destroy', 'TransportationController@massDestroy')->name('transportations.massDestroy');
    Route::post('transportations/media', 'TransportationController@storeMedia')->name('transportations.storeMedia');
    Route::post('transportations/ckmedia', 'TransportationController@storeCKEditorImages')->name('transportations.storeCKEditorImages');
    Route::post('transportations/parse-csv-import', 'TransportationController@parseCsvImport')->name('transportations.parseCsvImport');
    Route::post('transportations/process-csv-import', 'TransportationController@processCsvImport')->name('transportations.processCsvImport');
    Route::resource('transportations', 'TransportationController');

    // Difficulty Level
    Route::delete('difficulty-levels/destroy', 'DifficultyLevelController@massDestroy')->name('difficulty-levels.massDestroy');
    Route::resource('difficulty-levels', 'DifficultyLevelController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
        Route::post('profile/two-factor', 'ChangePasswordController@toggleTwoFactor')->name('password.toggleTwoFactor');
    }
});
Route::group(['namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Two Factor Authentication
    if (file_exists(app_path('Http/Controllers/Auth/TwoFactorController.php'))) {
        Route::get('two-factor', 'TwoFactorController@show')->name('twoFactor.show');
        Route::post('two-factor', 'TwoFactorController@check')->name('twoFactor.check');
        Route::get('two-factor/resend', 'TwoFactorController@resend')->name('twoFactor.resend');
    }
});
