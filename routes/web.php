<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
});
 */
Auth::routes();
Route::get('/home', 'DashboardController@index')->name('home');
Route::get('/logo-design/{id}', ['as' => 'logo_design', 'uses' => 'FormController@logoDesign']);
Route::post('/logo-design/{id}', ['uses' => 'FormController@updateLogoDesign']);
Route::get('/logo-first-feedback/{id}', ['as' => 'logo_version_1', 'uses' => 'FormController@logoFirstFeedback']);
Route::post('/logo-first-feedback/{id}', ['uses' => 'FormController@updateLogoFirstFeedback']);
Route::get('/logo-feedback/{id}', ['as' => 'logo_feedback', 'uses' => 'FormController@logoFeedback']);
Route::post('/logo-feedback/{id}', ['uses' => 'FormController@updateLogoFeedback']);
Route::get('/thank-you', ['as' => 'thankyou', 'uses' => 'FormController@thankyou']);
Route::get('/saved-answers', ['as' => 'saved_answers', 'uses' => 'FormController@saveAnswers']);
Route::get('/logo-final-feedback/{id}', ['as' => 'logo_version_2', 'uses' => 'FormController@logoFinalFeedback']);
Route::post('/logo-final-feedback/{id}', ['uses' => 'FormController@updateLogoFinal']);
Route::get('/webdesign/{id}', ['as' => 'web_design', 'uses' => 'FormController@webdesign']);
Route::post('/webdesign/{id}', ['uses' => 'FormController@updateWebdesign']);
Route::get('/webdesign-onboarding/{id}', ['as' => 'webdesign_onboarding', 'uses' => 'FormController@webdesignOnboarding']);
Route::post('/webdesign-onboarding/{id}', ['uses' => 'FormController@updateWebdesignOnboarding']);
Route::get('/webdesign-version-1/{id}', ['as' => 'webdesign_version_1', 'uses' => 'FormController@webdesignFirstVersion']);
Route::post('/webdesign-version-1/{id}', ['uses' => 'FormController@updateWebdesignFirstVersion']);
Route::get('/webdesign-version-2/{id}', ['as' => 'webdesign_version_2', 'uses' => 'FormController@webdesignFinalVersion']);
Route::post('/webdesign-version-2/{id}', ['uses' => 'FormController@updateWebdesignFinalVersion']);
Route::get('/text-writing/{id}', ['as' => 'text_writing', 'uses' => 'FormController@TextWriting']);
Route::post('/text-writing/{id}', ['uses' => 'FormController@updateTextWriting']);
Route::get('/text-first-feedback/{id}', ['as' => 'text_version_1', 'uses' => 'FormController@TextFirstFeedback']);
Route::post('/text-first-feedback/{id}', ['uses' => 'FormController@updateTextFirstFeedback']);
Route::get('/text-final-feedback/{id}', ['as' => 'text_version_2', 'uses' => 'FormController@TextFinalFeedback']);
Route::post('/text-final-feedback/{id}', ['uses' => 'FormController@updateTextFinalFeedback']);

Route::get('/onboarding/{id}', ['as' => 'onboarding', 'uses' => 'FormController@onboarding']);
Route::post('/onboarding/{id}', ['uses' => 'FormController@updateOnboarding']);
Route::get('/webdesign-development/{id}', ['as' => 'webdesign_dev', 'uses' => 'FormController@webdesignDev']);
Route::post('/webdesign-development/{id}', ['uses' => 'FormController@updateWebdesignDev']);
Route::get('/first-home/{id}', ['as' => 'first_home', 'uses' => 'FormController@firstHome']);
Route::post('/first-home/{id}', ['uses' => 'FormController@updateFirstHome']);
Route::get('/text-adding/{id}', ['as' => 'text_adding', 'uses' => 'FormController@textAdding']);
Route::post('/text-adding/{id}', ['uses' => 'FormController@updateTextAdding']);
Route::get('/first-feedback/{id}', ['as'=> 'first_feedback', 'uses'=> 'FormController@FirstFeedback']);
Route::post('/first-feedback/{id}', ['uses'=> 'FormController@updateFirstFeedback']);
Route::get('/final-feedback/{id}', ['as'=> 'final_feedback', 'uses'=> 'FormController@FinalFeedback']);
Route::post('/final-feedback/{id}', ['uses'=> 'FormController@updateFinalFeedback']);
Route::get('/hosting/{id}', ['as'=> 'hosting', 'uses'=> 'FormController@Hosting']);
Route::post('/hosting/{id}', ['uses'=> 'FormController@updateHosting']);
Route::get('/extra-function/{id}', ['as'=> 'extra_function', 'uses'=> 'FormController@ExtraFunction']);
Route::post('/extra-function/{id}', ['uses'=> 'FormController@updateExtraFunction']);
Route::get('/extra-work/{id}', ['as'=> 'extra_work', 'uses'=> 'FormController@ExtraWork']);
Route::post('/extra-work/{id}', ['uses'=> 'FormController@updateExtraWork']);
Route::get('/mail-instellen/{id}', ['as'=> 'business_email', 'uses'=> 'FormController@BusinessEmail']);
Route::post('/mail-instellen/{id}', ['uses'=> 'FormController@updateBusinessEmail']);
Route::get('/mail-error/{id}', ['as'=> 'mail_error', 'uses'=> 'FormController@MailError']);
Route::post('/mail-error/{id}', ['uses'=> 'FormController@updateMailError']);
Route::get('/webshop-onboarding/{id}', ['as'=> 'webshop_onboarding', 'uses'=> 'FormController@WebshopOnboarding']);
Route::post('/webshop-onboarding/{id}', ['uses'=> 'FormController@updateWebshopOnboarding']);
Route::get('/content-adding/{id}', ['as'=> 'content_adding', 'uses'=> 'FormController@ContentAdding']);
Route::post('/content-adding/{id}', ['uses'=> 'FormController@updateContentAdding']);
Route::get('/text-feedback/{id}', ['as' => 'text_feedback', 'uses' => 'FormController@TextFeedback']);
Route::post('/text-feedback/{id}', ['uses' => 'FormController@updateTextFeedback']);
Route::get('/website-feedback/{id}', ['as' => 'website_feedback', 'uses' => 'FormController@WebsiteFeedback']);
Route::post('/website-feedback/{id}', ['uses' => 'FormController@updateWebsiteFeedback']);

Route::group(['prefix' => 'service-desk/ticket'], function() {
	Route::get('/create', ['as' => 'add_ticket', 'uses' => 'ServiceDesk\ServiceDeskController@frontCreate']);
	Route::post('/create', ['uses' => 'ServiceDesk\ServiceDeskController@frontStore']);
	Route::get('/{id}', ['as' => 'ticket', 'uses' => 'ServiceDesk\ServiceDeskController@frontShow']);
	Route::post('/{id}/message', ['as' => 'new_message', 'uses' => 'ServiceDesk\ServiceDeskController@addMessage']);
	Route::post('{id}/status', ['as' => 'close_ticket', 'uses' => 'ServiceDesk\ServiceDeskController@closeTicket']);

});

Route::post('media/delete', ['as' => 'delete_media', 'uses' => 'FormController@deleteMedia']);

Route::get('/', 'DashboardController@index')->name('home')->middleware('auth');

Route::group(['prefix'=>'dashboard', 'middleware' => 'auth'], function(){
	Route::get('/', ['as'=>'dashboard', 'uses' => 'DashboardController@index']);
	
	Route::group(['prefix'=>'websites'], function(){
		Route::get('/', ['as'=>'websites', 'uses' => 'DashboardController@index']);
		Route::get('create', ['as'=>'create_project', 'uses' => 'ProjectController@create']);
		Route::post('create', ['uses' => 'ProjectController@store']);
		Route::get('/{id}', ['as'=>'website', 'uses'=> 'ProjectController@show']);
		Route::get('edit/{id}', ['as'=>'edit_project', 'uses'=>'ProjectController@edit']);
		Route::post('edit/{id}', ['uses'=>'ProjectController@update']);
	});
	
	Route::group(['prefix'=>'custom-websites'], function(){
		Route::get('/', ['as'=>'custom_websites', 'uses' => 'CustomWebsiteController@index']);
		Route::get('create', ['as'=>'create_custom_project', 'uses' => 'CustomWebsiteController@create']);
		Route::post('create', ['uses' => 'CustomWebsiteController@store']);
		Route::get('/{id}', ['as'=>'custom_website', 'uses'=> 'CustomWebsiteController@show']);
		Route::get('edit/{id}', ['as'=>'edit_custom_website', 'uses'=>'CustomWebsiteController@edit']);
		Route::post('edit/{id}', ['uses'=>'CustomWebsiteController@update']);
	});

	Route::group(['prefix'=>'webshop'], function(){
		Route::get('/', ['as'=>'webshop.index', 'uses' => 'WebShopController@index']);
		Route::get('create', ['as'=>'webshop.create', 'uses' => 'WebShopController@create']);
		Route::post('/', ['as'=>'webshop.store', 'uses' => 'WebShopController@store']);
		Route::get('/{id}', ['as'=>'webshop.show', 'uses'=> 'WebShopController@show']);
		Route::get('{id}/edit', ['as'=>'webshop.edit', 'uses'=>'WebShopController@edit']);
		Route::post('/{id}', ['as'=>'webshop.update', 'uses'=>'WebShopController@update']);
	});

	Route::group(['prefix'=>'custom-webshop'], function(){
		Route::get('/', ['as'=>'custom_webshop.index', 'uses' => 'CustomWebshopController@index']);
		Route::get('create', ['as'=>'custom_webshop.create', 'uses' => 'CustomWebshopController@create']);
		Route::post('/', ['as'=>'custom_webshop.store', 'uses' => 'CustomWebshopController@store']);
		Route::get('/{id}', ['as'=>'custom_webshop.show', 'uses'=> 'CustomWebshopController@show']);
		Route::get('{id}/edit', ['as'=>'custom_webshop.edit', 'uses'=>'CustomWebshopController@edit']);
		Route::post('/{id}', ['as'=>'custom_webshop.update', 'uses'=>'CustomWebshopController@update']);
	});
	
	Route::group(['prefix' => 'comments'], function () {
		Route::post('add-comment', ['as'=>'add_comment', 'uses'=>'CommentController@store']);
		Route::get('/{id}/all', ['as'=>'get_comments_all', 'uses'=>'CommentController@getAll']);
		Route::get('/{id}/user', ['as'=>'get_comments_user', 'uses'=>'CommentController@getUser']);
		Route::post('delete-comment', ['as'=>'delete_comment', 'uses'=>'CommentController@destroy']);
		Route::post('agenda-comment', ['as'=>'add_agenda_comment', 'uses'=>'CommentController@storeAgendaComment']);
		Route::post('delete-agenda-comment', ['as'=>'delete_agenda_comment', 'uses'=>'CommentController@destroyAgendaComment']);
	});
	
	Route::group(['prefix'=>'projects'], function(){
		Route::post('update/{id}', ['as'=>'update_project', 'uses'=> 'ProjectController@updateFields']);
		Route::post('/upate-project-url', ['as'=> 'update_project_url', 'uses'=>'ProjectController@updateURL']);
		Route::post('project-action/update', ['as' => 'project_action_update', 'uses'=>'ProjectController@updateProjectAction']);
		Route::post('/upfront-payment', ['as'=> 'upfront_payment', 'uses'=>'ProjectController@upfrontPayment']);
		Route::post('{id}/files', ['as'=>'manual_file', 'uses'=> 'ProjectController@fileUpload']);
		Route::post('delete-file', ['as'=>'delete_file', 'uses' => 'ProjectController@deleteFile']);
		Route::post('{id}/delete-url', ['as'=> 'delete_url', 'uses'=>'ProjectController@deleteURL']);
		Route::post('delete/{id}', ['as'=>'delete_project', 'uses'=> 'ProjectController@destroy']);
	});
	Route::post('deadline', ['as' => 'set_deadline', 'uses' => 'DeadlineController@store']);
	Route::post('update-deadline', ['as'=>'update_deadline', 'uses'=>'DeadlineController@update']);
	Route::post('welcome_email/{id}', ['as'=>'welcome_email', 'uses' => 'EmailController@welcome']);
	Route::post('resend-email', ['as'=> 'resend_email', 'uses' => 'EmailController@resend']);
	Route::post('send-email', ['as'=> 'send_email', 'uses' => 'EmailController@sendEmail']);
	Route::post('reset-status', ['as'=> 'reset_status', 'uses' => 'ProjectController@resetStatus']);
	Route::group(['prefix' => 'pdf'], function () {
		Route::get('{id}/logo-design', ['as' => 'logo_design_pdf', 'uses' => 'PdfController@logoDesignPDF']);
		Route::get('{id}/logo-first-feedback', ['as' => 'logo_first_feedback_pdf', 'uses' => 'PdfController@logoFirstFeedbackPDF']);
		Route::get('{id}/logo-final-feedback', ['as' => 'logo_final_feedback_pdf', 'uses' => 'PdfController@logoFinalFeedbackPDF']);
		Route::get('{id}/webdesign', ['as' => 'webdesign_pdf', 'uses' => 'PdfController@webdesignPDF']);
		Route::get('{id}/webdesign-onboarding', ['as' => 'webdesign_onboarding_pdf', 'uses' => 'PdfController@webdesignOnboardingPDF']);
		Route::get('{id}/webdesign-first-version', ['as' => 'webdesign_first_pdf', 'uses' => 'PdfController@webdesignFirstFeedbackPDF']);
		Route::get('{id}/webdesign-final-version', ['as' => 'webdesign_final_pdf', 'uses' => 'PdfController@webdesignFinalFeedbackPDF']);
		Route::get('{id}/webdesign-dev', ['as' => 'webdesign_dev_pdf', 'uses' => 'PdfController@webdesignDevPDF']);
		Route::get('{id}/home-first-version', ['as' => 'first_home_pdf', 'uses' => 'PdfController@firstHomePDF']);
		Route::get('{id}/text-writing', ['as' => 'text_writing_pdf', 'uses' => 'PdfController@TextWritingPDF']);
		Route::get('{id}/onboarding', ['as' => 'onboarding_pdf', 'uses' => 'PdfController@onboardingPDF']);
		Route::get('{id}/text', ['as' => 'textadding_pdf', 'uses' => 'PdfController@TextAddingPDF']);
		Route::get('{id}/feedback/{status}', ['as' => 'feedback_pdf', 'uses' => 'PdfController@FeedbackPDF']);
		Route::get('{id}/text-first-version', ['as' => 'text_first_feedback_pdf', 'uses' => 'PdfController@TextFirstFeedbackPDF']);
		Route::get('{id}/text-final-version', ['as' => 'text_final_feedback_pdf', 'uses' => 'PdfController@TextFinalFeedbackPDF']);
		Route::get('{id}/hosting', ['as' => 'hosting_pdf', 'uses' => 'PdfController@HostingPDF']);
		Route::get('{id}/extra', ['as' => 'extra_pdf', 'uses' => 'PdfController@ExtraPDF']);
		Route::get('{id}/webshop-onboarding', ['as' => 'webshop_onboarding_pdf', 'uses' => 'PdfController@WebshopOnboardingPDF']);
		Route::get('{id}/content-adding', ['as' => 'content_adding_pdf', 'uses' => 'PdfController@ContentAddingPDF']);
	});

	Route::group(['middleware' => 'only_admin_access'], function () {
		Route::group(['prefix'=>'users'], function(){
			Route::get('/', ['as'=>'show_users', 'uses' => 'UserController@index']);
			// Route::get('/{id}', ['as'=>'show_user', 'uses' => 'UserController@show']);
			Route::get('/create', ['as'=>'add_user', 'uses' => 'UserController@create']);
			Route::post('/create', ['uses' => 'UserController@store']);
			Route::get('/edit/{id}', ['as'=>'edit_user', 'uses' => 'UserController@edit']);
			Route::post('/edit/{id}', ['as'=>'update_user', 'uses' => 'UserController@update']);
			Route::post('edit/{id}/smtp-setting', ['as' => 'smtp_setting', 'uses'=>'UserController@smtpSetting']);
			Route::post('/{id}/password', ['as'=>'user_password', 'uses' =>  'UserController@updatePassword']);
			Route::post('delete', ['as'=>'user_delete', 'uses'=>'UserController@destroy']);
		});
		Route::get('settings', ['as' => 'theme_settings', 'uses' => 'DashboardController@settings']);
		Route::post('settings', ['as' => 'update_settings', 'uses' => 'DashboardController@updateSettings']);
		
		Route::resource('reseller', 'ResellerController');
			/* Route::get('/', ['as' => 'reseller.index', 'uses' => 'ResellerController@index']);
			Route::get('/create', ['as' => 'reseller.create', 'uses' => 'ResellerController@create']);
			Route::post('/', ['as' => 'reseller.store', 'uses' => 'ResellerController@store']); */
	});

	Route::get('notifications', ['as'=>'notifications', 'uses'=>'UserController@notifications']);
	Route::post('notification/quick-update', ['as'=>'notification_quick_update', 'uses'=>'UserController@NotificationQuickUpdate']);
	Route::post('notification/read', ['as'=>'notification_read', 'uses'=>'UserController@NotificationRead']);
	Route::post('notification/delete', ['as'=>'notification_delete', 'uses'=>'UserController@NotificationDelete']);
	Route::get('agenda', ['as' => 'agenda', 'uses' => 'AgendaController@agenda']);
	Route::post('calendar', ['as' => 'create_calendar', 'uses' => 'AgendaController@createCalendar']);
	Route::post('calendar/update', ['as' => 'update_calendar', 'uses' => 'AgendaController@updateCalendar']);
	Route::post('calendar/delete', ['as' => 'delete_calendar', 'uses' => 'AgendaController@destroyCalendar']);
	Route::post('calendar/edit', ['as' => 'edit_calendar', 'uses' => 'AgendaController@editCalendar']);
	Route::get('get-calendars', ['as' => 'get_calendars', 'uses' => 'AgendaController@getCalendar']);
	
	Route::post('todo', ['as' => 'create_todo', 'uses' => 'AgendaController@createTodo']);
	Route::get('todo/{id}', ['as' => 'show_todo', 'uses' => 'AgendaController@showTodo']);
	Route::get('todo/{id}/edit', ['as' => 'edit_todo', 'uses' => 'AgendaController@editTodo']);
	Route::post('todo/{id}', ['as' => 'update_todo', 'uses' => 'AgendaController@updateTodo']);
	Route::post('todo-done', ['as' => 'todo_done', 'uses' => 'AgendaController@todoDone']);
	Route::post('todo/{id}/delete', ['as' => 'delete_todo', 'uses' => 'AgendaController@destroyTodo']);

	Route::post('build-email', ['as' => 'build_email', 'uses' => 'EmailController@buildEmail']);
	
	Route::get('fullcalendar',['as' => 'fullcalendar', 'uses' => 'AgendaController@indexFullCalendar']);
	// Route::post('fullcalendar/update','AgendaController@updateFullCalendar');
	// Route::post('fullcalendar/delete','AgendaController@destroyFullCalendar');

	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
	Route::put('profile/smtp-setting', ['as' => 'profile.smtp_setting', 'uses' => 'ProfileController@smtpSetting']);
	
});

Route::group(['prefix'=>'dashboard/service-desk', 'middleware' => 'auth'], function() {
	Route::get('/', ['as'=>'service_desk', 'uses' => 'ServiceDesk\ServiceDeskController@index']);
	Route::get('/active', ['as'=>'open_tickets', 'uses' => 'ServiceDesk\ServiceDeskController@index']);
	Route::get('/closed', ['as'=>'closed_tickets', 'uses' => 'ServiceDesk\ServiceDeskController@closedIndex']);
	Route::group(['prefix'=>'ticket'], function() {
		Route::get('/create', ['as' => 'create_ticket', 'uses' => 'ServiceDesk\ServiceDeskController@create']);
		Route::post('/create', ['uses' => 'ServiceDesk\ServiceDeskController@store']);
		Route::get('/{id}', ['as' => 'show_ticket', 'uses' => 'ServiceDesk\ServiceDeskController@show']);
		Route::post('/{id}/update', ['as' => 'update_ticket', 'uses' => 'ServiceDesk\ServiceDeskController@update']);
		Route::post('/action', ['as' => 'ticket_action_update', 'uses'=>'ServiceDesk\ServiceDeskController@updateTicketAction']);
		Route::post('/status', ['as' => 'ticket_done', 'uses' => 'ServiceDesk\ServiceDeskController@ticketStatus']);
		Route::post('/delete/{id}', ['as' => 'delete_ticket', 'uses' => 'ServiceDesk\ServiceDeskController@destroy']);
		Route::post('/{id}/comment', ['as' => 'add_ticket_comment', 'uses' => 'ServiceDesk\ServiceDeskController@commentUpdate']);
	});
	
});