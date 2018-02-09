<?php


// Home page
$app->get('/', "Artisterie\Controller\HomeController::indexAction")
	->bind('home');

// Pages
$app->get('/page/{pagename}/{pagenumber}', "Artisterie\Controller\HomeController::pageAction")
	->bind('page')
	->value('pagenumber', 1);

// Page Contact
$app->match('/contact', "Artisterie\Controller\HomeController::contactAction")
	->bind('contact');

// Page Member
$app->match('/member/{accordion}', "Artisterie\Controller\AdminController::indexAction")
	->bind('member')
	->value('accordion', 'planning');

// Page Login
$app->get('/login', "Artisterie\Controller\HomeController::loginAction")
		->bind('login');

/////////////////
//// GROUP
/////////////////
// Add a group
$app->match('/admin/group/add', "Artisterie\Controller\AdminController::addGroupAction")
		->bind('admin_group_add');

// Edit an existing group
$app->match('/admin/group/{id}/edit', "Artisterie\Controller\AdminController::editGroupAction")
		->bind('admin_group_edit');

// Remove a group
$app->get('/admin/group/{id}/delete', "Artisterie\Controller\AdminController::deleteGroupAction")
		->bind('admin_group_delete');


/////////////////
//// USER
/////////////////
// Add a user
$app->match('/admin/user/add', "Artisterie\Controller\AdminController::addUserAction")
		->bind('admin_user_add');

// Edit an existing user
$app->match('/admin/user/{id}/edit', "Artisterie\Controller\AdminController::editUserAction")
		->bind('admin_user_edit');

// Remove a user
$app->get('/admin/user/{id}/delete', "Artisterie\Controller\AdminController::deleteUserAction")
		->bind('admin_user_delete');



/////////////////
//// ROOM
/////////////////
// Add a room
$app->match('/admin/room/add', "Artisterie\Controller\AdminController::addRoomAction")
		->bind('admin_room_add');

// Edit an existing user
$app->match('/admin/room/{id}/edit', "Artisterie\Controller\AdminController::editRoomAction")
		->bind('admin_room_edit');

//// Remove a user
//$app->get('/admin/room/{id}/delete', "Artisterie\Controller\AdminController::deleteUserAction")
//		->bind('admin_room_delete');


/////////////////
//// EVENT
/////////////////
// Add an event
$app->match('/admin/event/add', "Artisterie\Controller\AdminController::addEventAction")
		->bind('admin_event_add');

// Edit an existing event
$app->match('/admin/event/{id}/edit', "Artisterie\Controller\AdminController::editEventAction")
		->bind('admin_event_edit');

// Remove a event
$app->match('/admin/event/{id}/delete', "Artisterie\Controller\AdminController::deleteEventAction")
		->bind('admin_event_delete');

// List all events
$app->get('/api/events', "Artisterie\Controller\ApiController::getEventsAction")
		->bind('api_get_events');

/////////////////
//// NEWS
/////////////////
// Add a news
$app->match('/admin/news/add', "Artisterie\Controller\AdminController::addNewsAction")
		->bind('admin_news_add');

// Edit an existing news
$app->match('/admin/news/{id}/edit', "Artisterie\Controller\AdminController::editNewsAction")
		->bind('admin_news_edit');

//// Remove a news
$app->get('/admin/news/{id}/delete', "Artisterie\Controller\AdminController::deleteNewsAction")
		->bind('admin_news_delete');

/////////////////
//// TRACKS
/////////////////
// Add a track
$app->match('/admin/track/add', "Artisterie\Controller\AdminController::addTrackAction")
		->bind('admin_track_add');

// Edit an existing track
$app->match('/admin/track/{id}/edit', "Artisterie\Controller\AdminController::editTrackAction")
		->bind('admin_track_edit');

//// Remove a track
$app->get('/admin/track/{id}/delete', "Artisterie\Controller\AdminController::deleteTrackAction")
		->bind('admin_track_delete');

/////////////////
//// Picture
/////////////////
// Add a picture
$app->match('/admin/picture/add', "Artisterie\Controller\AdminController::addPictureAction")
		->bind('admin_picture_add');

// Edit an existing picture
$app->match('/admin/picture/{id}/edit', "Artisterie\Controller\AdminController::editPictureAction")
		->bind('admin_picture_edit');

// Remove a picture
$app->get('/admin/picture/{id}/delete', "Artisterie\Controller\AdminController::deletePictureAction")
		->bind('admin_picture_delete');

// Sendmail
$app->get('/sendmail/', "Artisterie\Controller\AdminController::sendMailAction")
		->bind('sendmail');