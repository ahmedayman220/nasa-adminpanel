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
