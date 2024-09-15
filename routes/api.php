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
});
