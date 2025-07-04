<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Education Level
    Route::apiResource('education-levels', 'EducationLevelApiController');

    // Mention Your Field
    Route::apiResource('mention-your-fields', 'MentionYourFieldApiController');

    // Bootcamp Form Descriptions
    Route::post('bootcamp-form-descriptions/media', 'BootcampFormDescriptionsApiController@storeMedia')->name('bootcamp-form-descriptions.storeMedia');
    Route::apiResource('bootcamp-form-descriptions', 'BootcampFormDescriptionsApiController');

    // Study Level
    Route::apiResource('study-levels', 'StudyLevelApiController');

    // Workshops
    Route::post('workshops/media', 'WorkshopsApiController@storeMedia')->name('workshops.storeMedia');
    Route::apiResource('workshops', 'WorkshopsApiController');

    // Bootcamp Participants
    Route::post('bootcamp-participants/media', 'BootcampParticipantsApiController@storeMedia')->name('bootcamp-participants.storeMedia');
    Route::apiResource('bootcamp-participants', 'BootcampParticipantsApiController');

    // Assets History
    Route::apiResource('assets-histories', 'AssetsHistoryApiController', ['except' => ['store', 'show', 'update', 'destroy']]);

    // Chatbot Replies
    Route::post('chatbot-replies/media', 'ChatbotRepliesApiController@storeMedia')->name('chatbot-replies.storeMedia');
    Route::apiResource('chatbot-replies', 'ChatbotRepliesApiController');

    // Chatbot Traning Data
    Route::post('chatbot-traning-datas/media', 'ChatbotTraningDataApiController@storeMedia')->name('chatbot-traning-datas.storeMedia');
    Route::apiResource('chatbot-traning-datas', 'ChatbotTraningDataApiController');

    // Bootcamp Confirmation
    Route::apiResource('bootcamp-confirmations', 'BootcampConfirmationApiController');

    // Challenges
    Route::post('challenges/media', 'ChallengesApiController@storeMedia')->name('challenges.storeMedia');
    Route::apiResource('challenges', 'ChallengesApiController');

    // Actual Solution
    Route::apiResource('actual-solutions', 'ActualSolutionApiController');

    // Mentorship Needed
    Route::post('mentorship-neededs/media', 'MentorshipNeededApiController@storeMedia')->name('mentorship-neededs.storeMedia');
    Route::apiResource('mentorship-neededs', 'MentorshipNeededApiController');

    // Participation Method
    Route::post('participation-methods/media', 'ParticipationMethodApiController@storeMedia')->name('participation-methods.storeMedia');
    Route::apiResource('participation-methods', 'ParticipationMethodApiController');

    // Member Role
    Route::post('member-roles/media', 'MemberRoleApiController@storeMedia')->name('member-roles.storeMedia');
    Route::apiResource('member-roles', 'MemberRoleApiController');

    // Study Levelss
    Route::post('study-levelsses/media', 'StudyLevelssApiController@storeMedia')->name('study-levelsses.storeMedia');
    Route::apiResource('study-levelsses', 'StudyLevelssApiController');

    // Major
    Route::post('majors/media', 'MajorApiController@storeMedia')->name('majors.storeMedia');
    Route::apiResource('majors', 'MajorApiController');

    // Tshirt Size
    Route::apiResource('tshirt-sizes', 'TshirtSizeApiController');

    // Team
    Route::post('teams/media', 'TeamApiController@storeMedia')->name('teams.storeMedia');
    Route::apiResource('teams', 'TeamApiController');

    // Team Skills
    Route::apiResource('team-skills', 'TeamSkillsApiController');

    // Team Achievements
    Route::apiResource('team-achievements', 'TeamAchievementsApiController');

    // Members
    Route::post('members/media', 'MembersApiController@storeMedia')->name('members.storeMedia');
    Route::apiResource('members', 'MembersApiController');

    // Member Checkpoints
    Route::apiResource('member-checkpoints', 'MemberCheckpointsApiController');

    // Hackathon Qr Codes
    Route::apiResource('hackathon-qr-codes', 'HackathonQrCodesApiController');

    // Challenge Categories
    Route::apiResource('challenge-categories', 'ChallengeCategoriesApiController');

    // H Event Management
    Route::apiResource('h-event-managements', 'HEventManagementApiController');

    // Events
    Route::apiResource('events', 'EventsApiController');

    // Checkpoints
    Route::post('checkpoints/media', 'CheckpointsApiController@storeMedia')->name('checkpoints.storeMedia');
    Route::apiResource('checkpoints', 'CheckpointsApiController');

    // Checkpoint Types
    Route::apiResource('checkpoint-types', 'CheckpointTypesApiController');

    // Evaluations
    Route::apiResource('evaluations', 'EvaluationsApiController');

    // Evaluation Criteria
    Route::apiResource('evaluation-criteria', 'EvaluationCriteriaApiController');

    // Judges
    Route::apiResource('judges', 'JudgesApiController');

    // Skills
    Route::apiResource('skills', 'SkillsApiController');

    // Achievements
    Route::apiResource('achievements', 'AchievementsApiController');

    // Transportation
    Route::post('transportations/media', 'TransportationApiController@storeMedia')->name('transportations.storeMedia');
    Route::apiResource('transportations', 'TransportationApiController');
});
