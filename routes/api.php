<?php
// Login
//Route::post('login','Api\V1\Admin\UserAuthController@login');
Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin',
//    'middleware' => ['auth:sanctum']
], function () {
//    Route::post('logout','UserAuthController@logout');
    // Education Level
    Route::get('education-levels', 'EducationLevelApiController@index');

    // Mention Your Field
    Route::get('mention-your-fields', 'MentionYourFieldApiController@index');

    // Bootcamp Form Descriptions
//    Route::post('bootcamp-form-descriptions/media', 'BootcampFormDescriptionsApiController@storeMedia')->name('bootcamp-form-descriptions.storeMedia');
//    Route::apiResource('bootcamp-form-descriptions', 'BootcampFormDescriptionsApiController');

    // Study Level
//    Route::get('study-levels', 'StudyLevelApiController@index');
    Route::get('slots', 'StudyLevelApiController@index');

    // Workshops
    Route::post('workshops/media', 'WorkshopsApiController@storeMedia')->name('workshops.storeMedia');
    Route::get('workshops', 'WorkshopsApiController@index');

    // Bootcamp Participants
    Route::post('bootcamp-participants/media', 'BootcampParticipantsApiController@storeMedia')->name('bootcamp-participants.storeMedia');
    Route::post('bootcamp-participants', 'BootcampParticipantsApiController@store');

    // Assets History
//    Route::apiResource('assets-histories', 'AssetsHistoryApiController', ['except' => ['store', 'show', 'update', 'destroy']]);

    // Chatbot Replies
    Route::post('chatbot-replies/media', 'ChatbotRepliesApiController@storeMedia')->name('chatbot-replies.storeMedia');
    Route::apiResource('chatbot-replies', 'ChatbotRepliesApiController');

    // Chatbot Traning Data
    Route::post('chatbot-traning-datas/media', 'ChatbotTraningDataApiController@storeMedia')->name('chatbot-traning-datas.storeMedia');
    Route::get('chatbot-traning-datas', 'ChatbotTraningDataApiController@index');

    // Bootcamp Confirmation
    Route::post('bootcamp-confirmations', 'BootcampConfirmationApiController@store');
});
