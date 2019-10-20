<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/clear', ['as'=>'clear','uses'=>'IndexController@clear']);

// index routes
// index routes
Route::get('/', ['as'=>'index.index','uses'=>'IndexController@index']);
Route::get('/home', ['as'=>'index.homeadhoc','uses'=>'IndexController@homeAdhoc']); // reset password redirect adhoc solve
Route::get('/about', ['as'=>'index.about','uses'=>'IndexController@getAbout']);
Route::get('/people/directors', ['as'=>'index.directors','uses'=>'IndexController@getDirectors']);
Route::get('/people/advisors', ['as'=>'index.advisors','uses'=>'IndexController@getAdvisors']);
Route::get('/people/employees', ['as'=>'index.employees','uses'=>'IndexController@getEmployees']);
Route::get('/people/members', ['as'=>'index.members','uses'=>'IndexController@getMembers']);
Route::get('/profile/{unique_key}', ['as'=>'index.profile','uses'=>'IndexController@getProfile']);

Route::get('/research/expertise/{slug}', ['as'=>'index.expertise','uses'=>'IndexController@getExpertise']);

Route::get('/projects', ['as'=>'index.projects','uses'=>'IndexController@getProjects']);
Route::get('/project/{slug}', ['as'=>'index.project','uses'=>'IndexController@getProject']);

Route::get('/publications', ['as'=>'index.publications','uses'=>'IndexController@getPublications']);
Route::get('/publication/{code}', ['as'=>'index.publication','uses'=>'IndexController@getPublication']);


Route::get('/disaster/data', ['as'=>'index.disasterdata','uses'=>'IndexController@getDisasterdata']);
Route::get('/disaster/data/{category_id}/api', ['as'=>'index.disasterdata.api','uses'=>'IndexController@getDisasterdataAPI']);

Route::get('/constitution', ['as'=>'index.constitution','uses'=>'IndexController@getConstitution']);
Route::get('/faq', ['as'=>'index.faq','uses'=>'IndexController@getFaq']);
Route::get('/executive', ['as'=>'index.executive','uses'=>'IndexController@getExecutive']);
Route::get('/news', ['as'=>'index.news','uses'=>'IndexController@getNews']);
Route::get('/events', ['as'=>'index.events','uses'=>'IndexController@getEvents']);
Route::get('/gallery', ['as'=>'index.gallery','uses'=>'IndexController@getGallery']);
Route::get('/contact', ['as'=>'index.contact','uses'=>'IndexController@getContact']);
Route::post('/contact/form/message/store', ['as'=>'index.storeformmessage','uses'=>'IndexController@storeFormMessage']);
Route::get('/application', ['as'=>'index.application','uses'=>'IndexController@getApplication']);
Route::get('/member/login', ['as'=>'index.login','uses'=>'IndexController@getLogin']);
Route::post('/member/application/store', ['as'=>'index.storeapplication','uses'=>'IndexController@storeApplication']);

// index routes
// index routes

// blog routes
// blog routes
Route::resource('blogs','BlogController');
Route::get('blog/{slug}',['as' => 'blog.single', 'uses' => 'BlogController@getBlogPost']);
Route::get('blogger/profile/{unique_key}',['as' => 'blogger.profile', 'uses' => 'BlogController@getBloggerProfile']);
Route::get('/like/{user_id}/{blog_id}',['as' => 'blog.like', 'uses' => 'BlogController@likeBlogAPI']);
Route::get('/check/like/{user_id}/{blog_id}',['as' => 'blog.checklike', 'uses' => 'BlogController@checkLikeAPI']);
Route::get('/category/{name}',['as' => 'blog.categorywise', 'uses' => 'BlogController@getCategoryWise']);
Route::get('/archive/{date}',['as' => 'blog.monthwise', 'uses' => 'BlogController@getMonthWise']);
// blog routes
// blog routes

Route::auth();

// dashboard routes
// dashboard routes
Route::resource('users','UserController');
Route::get('/dashboard', ['as'=>'dashboard.index','uses'=>'DashboardController@index']);
Route::get('/dashboard/committee', ['as'=>'dashboard.committee','uses'=>'DashboardController@getCommittee']);
Route::post('/dashboard/committee', ['as'=>'dashboard.storecommittee','uses'=>'DashboardController@storeCommittee']);
Route::put('/dashboard/committee/{id}', ['as'=>'dashboard.updatecommittee','uses'=>'DashboardController@updateCommittee']);
Route::delete('/dashboard/committee/{id}', ['as'=>'dashboard.deletecommittee','uses'=>'DashboardController@deleteCommittee']);

Route::get('/dashboard/news', ['as'=>'dashboard.news','uses'=>'DashboardController@getNews']);
Route::get('/dashboard/events', ['as'=>'dashboard.events','uses'=>'DashboardController@getEvents']);
Route::get('/dashboard/gallery', ['as'=>'dashboard.gallery','uses'=>'DashboardController@getGallery']);
Route::get('/dashboard/blogs', ['as'=>'dashboard.blogs','uses'=>'DashboardController@getBlogs']);
Route::get('/dashboard/members', ['as'=>'dashboard.members','uses'=>'DashboardController@getMembers']);
Route::get('/dashboard/member/create', ['as'=>'dashboard.member.create','uses'=>'DashboardController@createMember']);
Route::post('/dashboard/member/store', ['as'=>'dashboard.member.store','uses'=>'DashboardController@storeMember']);
Route::get('/dashboard/member/{id}/edit', ['as'=>'dashboard.member.edit','uses'=>'DashboardController@editMember']);
Route::put('/dashboard/member/{id}/update', ['as'=>'dashboard.member.update','uses'=>'DashboardController@updateMember']);
Route::delete('/dashboard/deletemember/{id}', ['as'=>'dashboard.deletemember','uses'=>'DashboardController@deleteMember']);

Route::get('/dashboard/applications', ['as'=>'dashboard.applications','uses'=>'DashboardController@getApplications']);
Route::patch('/dashboard/applications/{id}/approve', ['as'=>'dashboard.approveapplication','uses'=>'DashboardController@approveApplication']);
Route::delete('/dashboard/application/{id}', ['as'=>'dashboard.deleteapplication','uses'=>'DashboardController@deleteApplication']);

Route::get('/dashboard/sliders', ['as'=>'dashboard.sliders','uses'=>'DashboardController@getSliders']);
Route::post('/dashboard/slider/store', ['as'=>'dashboard.slider.store','uses'=>'DashboardController@storeSlider']);
Route::put('/dashboard/slider/{id}/update', ['as'=>'dashboard.slider.update','uses'=>'DashboardController@updateSlider']);
Route::delete('/dashboard/slider/{id}/delete', ['as'=>'dashboard.slider.delete','uses'=>'DashboardController@deleteSlider']);

Route::get('/dashboard/strategies', ['as'=>'dashboard.strategies','uses'=>'DashboardController@getStrategies']);
Route::post('/dashboard/strategy/store', ['as'=>'dashboard.strategy.store','uses'=>'DashboardController@storeStrategy']);
Route::put('/dashboard/strategy/{id}/update', ['as'=>'dashboard.strategy.update','uses'=>'DashboardController@updateStrategy']);
Route::delete('/dashboard/strategy/{id}/delete', ['as'=>'dashboard.strategy.delete','uses'=>'DashboardController@deleteStrategy']);

Route::get('/dashboard/expertises', ['as'=>'dashboard.expertises','uses'=>'DashboardController@getExpertises']);
Route::get('/dashboard/expertise/create', ['as'=>'dashboard.expertise.create','uses'=>'DashboardController@createExpertise']);
Route::post('/dashboard/expertise/store', ['as'=>'dashboard.expertise.store','uses'=>'DashboardController@storeExpertise']);

Route::get('/dashboard/projects', ['as'=>'dashboard.projects','uses'=>'DashboardController@getProjects']);
Route::get('/dashboard/project/create', ['as'=>'dashboard.project.create','uses'=>'DashboardController@createProject']);
Route::post('/dashboard/project/store', ['as'=>'dashboard.project.store','uses'=>'DashboardController@storeProject']);

Route::get('/dashboard/publications', ['as'=>'dashboard.publications','uses'=>'DashboardController@getPublications']);
Route::get('/dashboard/publication/create', ['as'=>'dashboard.publication.create','uses'=>'DashboardController@createPublication']);
Route::post('/dashboard/publication/store', ['as'=>'dashboard.publication.store','uses'=>'DashboardController@storePublication']);

Route::get('/dashboard/disasterdatas', ['as'=>'dashboard.disasterdatas','uses'=>'DashboardController@getDisasterdatas']);
Route::post('/dashboard/disasterdata/category/store', ['as'=>'dashboard.discategory.store','uses'=>'DashboardController@storeDisasterCategory']);
Route::put('/dashboard/disasterdata/category/{id}/update', ['as'=>'dashboard.discategory.update','uses'=>'DashboardController@updateDisasterCategory']);
Route::get('/dashboard/disasterdata/create', ['as'=>'dashboard.disasterdata.create','uses'=>'DashboardController@createDisasterdata']);
Route::post('/dashboard/disasterdata/store', ['as'=>'dashboard.disasterdata.store','uses'=>'DashboardController@storeDisasterdata']);
Route::get('/dashboard/disasterdata/{id}/edit', ['as'=>'dashboard.disasterdata.edit','uses'=>'DashboardController@editDisasterdata']);
Route::put('/dashboard/disasterdata/{id}/update', ['as'=>'dashboard.disasterdata.update','uses'=>'DashboardController@updateDisasterdata']);

Route::get('/dashboard/personal/publications', ['as'=>'dashboard.personal.pubs','uses'=>'DashboardController@getPersonalPubs']);
Route::get('/dashboard/personal/profile', ['as'=>'dashboard.personal.profile','uses'=>'DashboardController@getPersonalProfile']);


Route::get('/onesignal', ['as'=>'dashboard.onesignal','uses'=>'OneSignalController@index']);
Route::post('/onesignal/store/qa', ['as'=>'dashboard.onesignal.storeqa','uses'=>'OneSignalController@storeQA']);
Route::delete('/onesignal/qa/{id}/delete', ['as'=>'dashboard.onesignal.delqa','uses'=>'OneSignalController@delQA']);
Route::put('/onesignal/qa/{id}/update', ['as'=>'dashboard.onesignal.updateqa','uses'=>'OneSignalController@updateQA']);

Route::get('/onesignal/send/push', ['as'=>'dashboard.onesignal.sendpush','uses'=>'OneSignalController@sendPush']);
// dashboard routes
// dashboard routes
