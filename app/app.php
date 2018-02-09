<?php

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;
use Symfony\Component\HttpFoundation\Request;

// Register global error and exception handlers
ErrorHandler::register();
ExceptionHandler::register();

// Register service providers
$app->register(new Silex\Provider\DoctrineServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
	'twig.path' => __DIR__ . '/../views',
//	'twig.options' => array(
//		'cache' => __DIR__ . '/../var/cache/twig',
//	)
));
$app['twig'] = $app->extend('twig', function(Twig_Environment $twig, $app) {
	$twig->addExtension(new Twig_Extensions_Extension_Text());
//	$twig->addExtension(new Twig_Extension_Debug());
	return $twig;
});
$app->register(new Silex\Provider\AssetServiceProvider(), array(
	//'assets.version' => 'v1'
));
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
	'security.firewalls' => array(
		'secured' => array(
			'pattern' => '^/',
			'anonymous' => true,
			'logout' => true,
			'form' => array('login_path' => '/login', 'check_path' => '/login_check'),
			'users' => function () use ($app) {
				$userDAO = new Artisterie\DAO\UserDAO($app['db']);
				$userDAO->setGroupDAO($app['dao.group']);
				return $userDAO;
			},
		),
	),
	'security.role_hierarchy' => array(
		'ROLE_ADMIN' => array('ROLE_USER'),
	),
///////////////////////////////////////
///////////////////////////////////////
///////////////////////////////////////
///////////////////////////////////////
///////////////////////////////////////
///////////////////////////////////////
// A REACTIVER DES QUE LE LOGIN DE L'ADMIN SERA EN PLACE !!!!!!!!!!!!!!!!!!
///////////////////////////////////////
	'security.access_rules' => array(
		array('^/member', 'ROLE_USER'),
		array('^/admin', 'ROLE_USER'),
	),
));
$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\LocaleServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider());
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\MonologServiceProvider(), array(
	'monolog.logfile' => __DIR__ . '/../var/logs/artisterie.log',
	'monolog.name' => 'Artisterie',
	'monolog.level' => $app['monolog.level']
));

$app->register(new Silex\Provider\SwiftmailerServiceProvider());

//$app->register(new Silex\Provider\SwiftmailerServiceProvider(), array(
//     'swiftmailer.options' => array(
//            'host' => 'smtp.gmail.com',
//            'port' => 587,
//            'username' => 'pmacaro@gmail.com',
//            'password' => 'XXXXXXXXXXX',
//            'encryption' => 'tls',
//            'auth_mode' => 'login'),
//      'swiftmailer.class_path' => __DIR__.'/../vendor/swiftmailer/swiftmailer/lib/classes'
//));
//$app->register(new Silex\Provider\SwiftmailerServiceProvider());

//
////Set the directory you want the spool to be in.
//$app["swiftmailer.spool"] = new \Swift_FileSpool(__DIR__."/../spool");
////Take a copy of the original transport, we'll need that later.
//$app["swiftmailer.transport.original"] = $app->raw("swiftmailer.transport");
////Create a spool transport
//$app["swiftmailer.transport"] = new \Swift_Transport_SpoolTransport($app['swiftmailer.transport.eventdispatcher'], $app["swiftmailer.spool"]);


// Register services
$app['dao.room'] = function ($app) {
	return new Artisterie\DAO\RoomDAO($app['db']);
};
$app['dao.group'] = function ($app) {
	$groupDAO = new Artisterie\DAO\GroupDAO($app['db']);
	$groupDAO->setRoomDAO($app['dao.room']);
	return $groupDAO;
};
$app['dao.news'] = function ($app) {
	return new Artisterie\DAO\NewsDAO($app['db']);	
};
$app['dao.tracks'] = function ($app) {
	return new Artisterie\DAO\TrackDAO($app['db']);	
};
$app['dao.quote'] = function ($app) {
	return new Artisterie\DAO\QuoteDAO($app['db']);
};
$app['dao.user'] = function ($app) {
	$userDAO = new Artisterie\DAO\UserDAO($app['db']);
	$userDAO->setGroupDAO($app['dao.group']);
	return $userDAO;
};
$app['dao.event'] = function ($app) {
	$eventDAO = new Artisterie\DAO\EventDAO($app['db']);
	$eventDAO->setCurrentUser($app['user']);
	$eventDAO->setUserDAO($app['dao.user']);
	return $eventDAO;
};
$app['dao.picture'] = function ($app) {
	return new Artisterie\DAO\PictureDAO($app['db']);	
};

// Register error handler
$app->error(function (\Exception $e, Request $request, $code) use ($app) {
	switch ($code) {
//		case 403:
//			$message = 'Access denied.';
//			break;
		case 404:
			return $app['twig']->render('404.html.twig');
			break;
//		default:
//			$message = "Something went wrong.";
	}
//	return $app['twig']->render('error.html.twig', array('message' => $message));
});

// Register JSON data decoder for JSON requests
$app->before(function (Request $request) {
	if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
		$data = json_decode($request->getContent(), true);
		$request->request->replace(is_array($data) ? $data : array());
	}
});
