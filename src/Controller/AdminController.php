<?php

namespace Artisterie\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Artisterie\Domain\User;
use Artisterie\Domain\Event;
use Artisterie\Domain\Group;
use Artisterie\Domain\Room;
use Artisterie\Domain\News;
use Artisterie\Domain\Track;
use Artisterie\Domain\Quote;
use Artisterie\Domain\Picture;
use Artisterie\Form\Type\EventType;
use Artisterie\Form\Type\UserType;
use Artisterie\Form\Type\GroupType;
use Artisterie\Form\Type\RoomType;
use Artisterie\Form\Type\NewsType;
use Artisterie\Form\Type\PictureType;
use Artisterie\Form\Type\TrackType;

class AdminController {

	/**
	 * Generate unique file name
	 *
	 * @param Symfony\Component\HttpFoundation\File\UploadedFile $file
	 */
	public function generateUniqueFileName($file){
		// md5() reduces the similarity of the file names generated by
		// uniqid(), which is based on timestamps
		$md5 = md5(uniqid());

		// Récupération du nom de fichier original sans extension
		$originalName = $file->getClientOriginalName();
		$posPoint = strrpos($originalName, ".");
		$originalName = substr($originalName, 0, $posPoint);
		// Génération d'un nom de fichier unique
		return $originalName . "_" . substr($md5,0,10) . '.' . $file->guessExtension();
	}
	
	/**
	 * Admin home page controller.
	 *
	 * @param Application $app Silex application
	 */
	public function indexAction($accordion, Application $app) {
		$users = $app['dao.user']->findAll();
		$groups = $app['dao.group']->findAll();
		$rooms = $app['dao.room']->findAll();
		$news = $app['dao.news']->findAll();
		$tracks = $app['dao.tracks']->findAll();
		$pictures = $app['dao.picture']->findAll();
		$quote = $app['dao.quote']->findAll();
		$currentUser = $app['user'];
		return $app['twig']->render('member.html.twig', array(
					'users' => $users,
					'groups' => $groups,
					'rooms' => $rooms,
					'news' => $news,
					'tracks' => $tracks,
					'pictures' => $pictures,
					'quote' => $quote,
					'currentUser' => $currentUser,
					'accordion' => $accordion
		));
	}

	/**
	 * Send mail controller.
	 *
	 * @param Application $app Silex application
	 */
	public function sendMailAction(Application $app) {
		$smtp_host_ip = gethostbyname('ssl0.ovh.net');
		$transport = (new \Swift_SmtpTransport($smtp_host_ip, 587, 'tls'))
				->setUsername('test@gite-montclar.fr')
				->setPassword('webforce3Lyon');
		
		$mailer = new \Swift_Mailer($transport);
		
		$message = new \Swift_Message();
		$message->setSubject("Test sujet");
		$message->setFrom(array('pmacaro@gmail.com' => 'PMP')); // replace with your own
		$message->setTo(array('pmacaro@gmail.com' => 'Test PM')); // replace with email recipient
		$message->setBody("TEST MESSAGE", 'text/html');
		
		$mailer->send($message);

		return $app->redirect($app['url_generator']->generate('home'));
	}


	/**
	 * Add group controller.
	 *
	 * @param Request $request Incoming request
	 * @param Application $app Silex application
	 */
	public function addGroupAction(Request $request, Application $app) {
		$group = new Group();
		$rooms = $app['dao.room']->findAllSelect();
		$groupForm = $app['form.factory']->create(GroupType::class, $group, array(
			'rooms' => $rooms
		));
		$groupForm->handleRequest($request);
		if ($groupForm->isSubmitted() && $groupForm->isValid()) {
			// Gestion du local
			// Ajoute manuellement le local au nouveau groupe, s'il est présent
			$roomId = $groupForm->get('room')->getData();
			if (!empty($roomId)) {
				$room = $app['dao.room']->find($roomId);
				$group->setRoom($room);
			}

			// Gestion de l'avatar
			// $file stores the uploaded file
			/** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
			$file = $group->getImgPath();
			if (!empty($file)) {
				// Génération d'un nom de fichier unique
				$fileName = $this->generateUniqueFileName($file);
				// Chemin vers le répertoire de stockage
				$path = __DIR__ . '/../../web/upload/avatars/';
				$pathRelative = '/upload/avatars/';
				// Move the file to the directory where avatars are stored
				$file->move($path, $fileName);
				// Update the 'imgPath' property to store the file name
				// instead of its contents
				$group->setImgPath($pathRelative . $fileName);
			}

			$app['dao.group']->save($group);
			$app['session']->getFlashBag()->add('successMember', 'Le groupe a été ajouté avec succès.');
			return $app->redirect($app['url_generator']->generate('member', array(
				'accordion' => 'group'
			)));
		}
		$quote = $app['dao.quote']->findAll();
		return $app['twig']->render('group_form.html.twig', array(
					'quote' => $quote,
					'title' => 'Nouveau groupe',
					'groupForm' => $groupForm->createView()));
	}

	/**
	 * Edit group controller.
	 *
	 * @param integer $id Group id
	 * @param Request $request Incoming request
	 * @param Application $app Silex application
	 */
	public function editGroupAction($id, Request $request, Application $app) {
		$group = $app['dao.group']->find($id);
		$rooms = $app['dao.room']->findAllSelect();
		$groupForm = $app['form.factory']->create(GroupType::class, $group, array(
			'rooms' => $rooms
		));
		$groupForm->handleRequest($request);
		if ($groupForm->isSubmitted() && $groupForm->isValid()) {
			// Gestion du local
			// Ajoute manuellement le local au nouveau groupe, s'il est présent
			$roomId = $groupForm->get('room')->getData();
			if (!empty($roomId)) {
				$room = $app['dao.room']->find($roomId);
				$group->setRoom($room);
			}

			// Gestion de l'avatar
			// $file stores the uploaded file
			/** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
			$file = $group->getImgPath();
			if (!empty($file)) {
				// Génération d'un nom de fichier unique
				$fileName = $this->generateUniqueFileName($file);
				// Chemin vers le répertoire de stockage
				$path = __DIR__ . '/../../web/upload/avatars/';
				$pathRelative = '/upload/avatars/';
				// Move the file to the directory where avatars are stored
				$file->move($path, $fileName);
				// Update the 'imgPath' property to store the file name
				// instead of its contents
				$group->setImgPath($pathRelative . $fileName);
			}

			$app['dao.group']->save($group);
			$app['session']->getFlashBag()->add('successMember', 'Le groupe a été modifié avec succès.');
			return $app->redirect($app['url_generator']->generate('member', array(
				'accordion' => 'group'
			)));
		}
		$quote = $app['dao.quote']->findAll();
		return $app['twig']->render('group_form.html.twig', array(
					'quote' => $quote,
					'title' => 'Modification de groupe',
					'avatarPath' => $group->getImgPath(),
					'groupForm' => $groupForm->createView()));
	}

	/**
	 * Delete group controller.
	 *
	 * @param integer $id Group id
	 * @param Application $app Silex application
	 */
	public function deleteGroupAction($id, Application $app) {
		// Delete all associated users
		$app['dao.user']->deleteAllUsersGroup($id);
		// Delete the group
		$app['dao.group']->delete($id);
		$app['session']->getFlashBag()->add('successMember', 'Le groupe a été supprimé avec succès.');
		// Redirect to admin home page
		return $app->redirect($app['url_generator']->generate('member', array(
				'accordion' => 'group'
			)));
	}

	/**
	 * Add user controller.
	 *
	 * @param Request $request Incoming request
	 * @param Application $app Silex application
	 */
	public function addUserAction(Request $request, Application $app) {
		$user = new User();
		$groups = $app['dao.group']->findAllSelect();
		$rooms = $app['dao.room']->findAllSelect();
		$userForm = $app['form.factory']->create(UserType::class, $user, array(
			'groups' => $groups,
			'rooms' => $rooms,
			'mode' => "ajout"
		));
		$userForm->handleRequest($request);
		if ($userForm->isSubmitted() && $userForm->isValid()) {
			// Gestion du groupe
			// Ajoute manuellement le groupe au nouveau user, s'il est présent
			$groupId = $userForm->get('group')->getData();
			if (!empty($groupId)) {
				$group = $app['dao.group']->find($groupId);
				$user->setGroup($group);
			} else {
				// Pas de groupe saisi, c'est un membre individuel, on crée un groupe fictif
				$group = new Group();
				$group->setName($user->getUsername());
				$roomId = $userForm->get('room')->getData();
				$room = $app['dao.room']->find($roomId);
				$group->setRoom($room);
				$app['dao.group']->save($group);
				$user->setGroup($group);
			}

			// Gestion du mot de passe
			// generate a random salt value
			$salt = substr(md5(time()), 0, 23);
			$user->setSalt($salt);
			$plainPassword = $user->getPassword();
			// find the default encoder
			$encoder = $app['security.encoder.bcrypt'];
			// compute the encoded password
			$password = $encoder->encodePassword($plainPassword, $user->getSalt());
			$user->setPassword($password);

			// Gestion de l'avatar
			// $file stores the uploaded file
			/** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
			$file = $user->getImgPath();
			if (!empty($file)) {
				// Génération d'un nom de fichier unique
				$fileName = $this->generateUniqueFileName($file);
				// Chemin vers le répertoire de stockage
				$path = __DIR__ . '/../../web/upload/avatars/';
				$pathRelative = '/upload/avatars/';
				// Move the file to the directory where avatars are stored
				$file->move($path, $fileName);
				// Update the 'imgPath' property to store the file name
				// instead of its contents
				$user->setImgPath($pathRelative . $fileName);
			}

			// Sauvegarde du user
			$app['dao.user']->save($user);

			$app['session']->getFlashBag()->add('successMember', 'Utilisateur créé avec succès.');
			return $app->redirect($app['url_generator']->generate('member', array(
				'accordion' => 'user'
			)));
		}
		$quote = $app['dao.quote']->findAll();
		return $app['twig']->render('user_form.html.twig', array(
					'quote' => $quote,
					'title' => 'Nouveau membre',
					'mode' => "ajout",
					'userForm' => $userForm->createView()));
	}

	/**
	 * Edit user controller.
	 *
	 * @param integer $id User id
	 * @param Request $request Incoming request
	 * @param Application $app Silex application
	 */
	public function editUserAction($id, Request $request, Application $app) {
		$user = $app['dao.user']->find($id);
		$groups = $app['dao.group']->findAllSelect();
		$userForm = $app['form.factory']->create(UserType::class, $user, array(
			'groups' => $groups,
			'mode' => "modification"
		));
		$userForm->handleRequest($request);
		if ($userForm->isSubmitted() && $userForm->isValid()) {
			// Gestion du groupe
			// Ajoute manuellement le groupe au nouveau user, s'il est présent
			$groupId = $userForm->get('group')->getData();
			if (!empty($groupId)) {
				$group = $app['dao.group']->find($groupId);
				$user->setGroup($group);
			}

			// Modification du mot de passe
			$passwordForm = $userForm->get('password')->getData();
			var_dump($passwordForm);
			if (!empty($passwordForm)) {
				// Gestion du mot de passe
				$plainPassword = $user->getPassword();
				// find the encoder for the user
				$encoder = $app['security.encoder_factory']->getEncoder($user);
				// compute the encoded password
				$password = $encoder->encodePassword($plainPassword, $user->getSalt());
				$user->setPassword($password);
			}

			// Gestion de l'avatar
			// $file stores the uploaded file
			/** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
			$file = $user->getImgPath();
			if (!empty($file)) {
				// Génération d'un nom de fichier unique
				$fileName = $this->generateUniqueFileName($file);
				// Chemin vers le répertoire de stockage
				$path = __DIR__ . '/../../web/upload/avatars/';
				$pathRelative = '/upload/avatars/';
				// Move the file to the directory where avatars are stored
				$file->move($path, $fileName);
				// Update the 'imgPath' property to store the file name
				// instead of its contents
				$user->setImgPath($pathRelative . $fileName);
			}

			// Sauvegarde du user
			$app['dao.user']->save($user);
			$app['session']->getFlashBag()->add('successMember', 'Utilisateur modifié avec succès.');
			return $app->redirect($app['url_generator']->generate('member', array(
				'accordion' => 'user'
			)));
		}
		$quote = $app['dao.quote']->findAll();
		return $app['twig']->render('user_form.html.twig', array(
					'quote' => $quote,
					'title' => "Modification de membre",
					'mode' => "modification",
					'avatarPath' => $user->getImgPath(),
					'userForm' => $userForm->createView()));
	}

	/**
	 * Delete user controller.
	 *
	 * @param integer $id User id
	 * @param Application $app Silex application
	 */
	public function deleteUserAction($id, Application $app) {
		// Delete all associated events
		$app['dao.event']->deleteAllEventsUser($id);
		// Delete the user
		$app['dao.user']->delete($id);
		$app['session']->getFlashBag()->add('successMember', 'Utilisateur supprimé avec succès.');
		// Redirect to admin home page
		return $app->redirect($app['url_generator']->generate('member', array(
				'accordion' => 'user'
			)));
	}

	/**
	 * Check event constraints
	 *
	 * @param Request $request Incoming request
	 * @param Application $app Silex application
	 */
	public function checkEventConstraints(Application $app, $event) {
		$res = true;

		// L'heure de fin est-elle APRES l'heure de début ?
		if (strtotime($event->getStart()) >= strtotime($event->getEnd())) {
			$message = "L'heure de fin doit être après l'heure de début. Impossible de réserver.";
			$app['session']->getFlashBag()->add('errorEvent', $message);
			// Blocage de la réservation
			$res = false;
		} else {
			// Le local est-il disponible ?
			// Récupération du local ou studio
			$room = $event->getUser()->getGroup()->getRoom();
			// Recherche de réservations du local ou studio sur le même créneau
			if (!$app["dao.room"]->isRoomAvailable($room, $event)) {
				$message = "";
				if ($room->getIsStudio()) {
					$message = 'Le studio est utilisé dans ce créneau. Impossible de réserver.';
				} else {
					$message = 'Le local est utilisé dans ce créneau. Impossible de réserver.';
				}
				$app['session']->getFlashBag()->add('errorEvent', $message);
				// Blocage de la réservation
				$res = false;
			} else {
				// Si on est sur le studio, on regarde si d'autres locaux sont réservés
				// pour informer les groupes qu'ils doivent annuler leur réservation
				if ($room->getIsStudio()) {
					// Récupération de tous les locaux hors studio
					$rooms = $app["dao.room"]->findAllByStudio(false);
					// Parcours des locaux
					foreach ($rooms as $room) {
						if (!$app["dao.room"]->isRoomAvailable($room, $event)) {
							// Si le local courant est pris, envoi de mail à l'ensemble des membres
							///////////////////////
							///////////////////////
							//// TODO ENVOI DE MAIL
							///////////////////////
							///////////////////////
							$message = "Local " . $room->getName() . " utilisé pendant ce créneau. Membres contactés.";
							$app['session']->getFlashBag()->add('successMember', $message);
						}
					}
					$app['session']->getFlashBag()->add('successMember', "Créneau bloqué pour le studio.");
				} else {
					// L'évènement n'est pas sur le studio, on regarde si le studio est réservé
					// Récupération des studios
					$studios = $app["dao.room"]->findAllByStudio(true);
					// Parcours des studios
					foreach ($studios as $studio) {
						if (!$app["dao.room"]->isRoomAvailable($studio, $event)) {
							// Si le studio est pris, message d'erreur
							$app['session']->getFlashBag()->add('errorEvent', 'Le studio est utilisé dans ce créneau. Impossible de réserver.');
							// Blocage de la réservation
							$res = false;
						}
					}
				}
			}
		}

		return $res;
	}

	/**
	 * Add event controller.
	 *
	 * @param Request $request Incoming request
	 * @param Application $app Silex application
	 */
	public function addEventAction(Request $request, Application $app) {
		$event = new Event();
		$day = $request->get("day"); // Récupération de la date du jour saisie sur l'interface
		$eventForm = $app['form.factory']->create(EventType::class, $event, array(
			'action' => 'http://localhost/artisterie/web/admin/event/add',
			'day' => $day,
		));
		$eventForm->handleRequest($request);
		if ($eventForm->isSubmitted() && $eventForm->isValid()) {
			// Récupération du jour et des heures saisies sur le formulaire
			$day = $eventForm->get('day')->getData();
			$startHour = $eventForm->get('startHour')->getData();
			$endHour = $eventForm->get('endHour')->getData();

			// Reconstitution des dates au format "YYYY-MM-DD HH:mm:ss"
			$event->setStart($day . " " . $startHour);
			$event->setEnd($day . " " . $endHour);

			// Récupération du user courant
			$event->setUser($app['user']);

			// Vérification des contraintes client
			if ($this->checkEventConstraints($app, $event)) {
				// Containtes vérifiées et OK, on peut enregistrer
				$app['dao.event']->save($event);
				return new Response('valid');
			}
		}
		$quote = $app['dao.quote']->findAll();
		return $app['twig']->render('event_form.html.twig', array(
					'quote' => $quote,
					'mode' => "ajout",
					'eventForm' => $eventForm->createView()));
	}

	/**
	 * Edit event controller.
	 *
	 * @param integer $id Event id
	 * @param Request $request Incoming request
	 * @param Application $app Silex application
	 */
	public function editEventAction($id, Request $request, Application $app) {
		$event = $app['dao.event']->find($id);
		// Récupération de l'heure de début si saisie sur l'interface
		$startHour = "";
		if ($request->get("startHour") !== null) {
			$startHour = $request->get("startHour");
		}
		// Récupération de l'heure de fin si saisie sur l'interface
		$endHour = "";
		if ($request->get("endHour") !== null) {
			$endHour = $request->get("endHour");
		}
		$eventForm = $app['form.factory']->create(EventType::class, $event, array(
			'action' => 'http://localhost/artisterie/web/admin/event/' . $event->getId() . '/edit',
			'day' => substr($event->getStart(),0,10),
			'startHour' => $startHour,
			'endHour' => $endHour,
		));
		$eventForm->handleRequest($request);
		if ($eventForm->isSubmitted() && $eventForm->isValid()) {
			// Récupération du jour et des heures saisies sur le formulaire
			$day = $eventForm->get('day')->getData();
			$startHour = $eventForm->get('startHour')->getData();
			$endHour = $eventForm->get('endHour')->getData();

			// Reconstitution des dates au format "YYYY-MM-DD HH:mm:ss"
			$event->setStart($day . " " . $startHour);
			$event->setEnd($day . " " . $endHour);

			// Récupération du user courant
			$event->setUser($app['user']);

			// Vérification des contraintes client
			if ($this->checkEventConstraints($app, $event)) {
				// Containtes vérifiées et OK, on peut enregistrer
				$app['dao.event']->save($event);
				return new Response('valid');
			}
		}
		$quote = $app['dao.quote']->findAll();
		return $app['twig']->render('event_form.html.twig', array(
					'quote' => $quote,
					'mode' => "modification",
					'eventId' => $id,
					'eventForm' => $eventForm->createView()));
	}

	/**
	 * Delete event controller.
	 *
	 * @param integer $id Event id
	 * @param Application $app Silex application
	 */
	public function deleteEventAction($id, Application $app) {
		// Delete the event
		$app['dao.event']->delete($id);
		$app['session']->getFlashBag()->add('successMember', 'Evènement supprimé avec succès.');
		// Redirect to admin home page
		return $app->redirect($app['url_generator']->generate('member'));
	}

	/**
	 * Add room controller.
	 *
	 * @param Request $request Incoming request
	 * @param Application $app Silex application
	 */
	public function addRoomAction(Request $request, Application $app) {
		$room = new Room();
		$roomForm = $app['form.factory']->create(RoomType::class, $room);
		$roomForm->handleRequest($request);
		if ($roomForm->isSubmitted() && $roomForm->isValid()) {
			$app['dao.room']->save($room);
			$app['session']->getFlashBag()->add('successMember', 'Evènement créé avec succès.');
			return $app->redirect($app['url_generator']->generate('member', array(
				'accordion' => 'room'
			)));
		}
		$quote = $app['dao.quote']->findAll();
		return $app['twig']->render('room_form.html.twig', array(
					'quote' => $quote,
					'title' => "Ajout d'un évènement",
					'roomForm' => $roomForm->createView()));
	}

	/**
	 * Edit room controller.
	 *
	 * @param integer $id Room id
	 * @param Request $request Incoming request
	 * @param Application $app Silex application
	 */
	public function editRoomAction($id, Request $request, Application $app) {
		$room = $app['dao.room']->find($id);
		$roomForm = $app['form.factory']->create(RoomType::class, $room);
		$roomForm->handleRequest($request);
		if ($roomForm->isSubmitted() && $roomForm->isValid()) {
			$app['dao.room']->save($room);
			$app['session']->getFlashBag()->add('successMember', 'Local modifié avec succès.');
			return $app->redirect($app['url_generator']->generate('member', array(
				'accordion' => 'room'
			)));
		}
		$quote = $app['dao.quote']->findAll();
		return $app['twig']->render('room_form.html.twig', array(
					'quote' => $quote,
					'title' => "Modification du local",
					'roomForm' => $roomForm->createView()));
	}

	/**
	 * Add news controller.
	 *
	 * @param Request $request Incoming request
	 * @param Application $app Silex application
	 */
	public function addNewsAction(Request $request, Application $app) {
		$news = new News();
		$newsForm = $app['form.factory']->create(NewsType::class, $news, array("imgRequired" => true));
		$newsForm->handleRequest($request);
		if ($newsForm->isSubmitted() && $newsForm->isValid()) {
			// Gestion de l'image de news
			// $file stores the uploaded file
			/** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
			$file = $news->getImgPath();
			if (!empty($file)) {
				// Génération d'un nom de fichier unique
				$fileName = $this->generateUniqueFileName($file);
				// Chemin vers le répertoire de stockage
				$path = __DIR__ . '/../../web/upload/news/';
				$pathRelative = '/upload/news/';
				// Move the file to the directory where news are stored
				$file->move($path, $fileName);
				// Update the 'imgPath' property to store the file name
				// instead of its contents
				$news->setImgPath($pathRelative . $fileName);
			}
			$app['dao.news']->save($news);

			$app['session']->getFlashBag()->add('successMember', 'Actu créée avec succès.');
			return $app->redirect($app['url_generator']->generate('member', array(
				'accordion' => 'news'
			)));
		}
		$quote = $app['dao.quote']->findAll();
		return $app['twig']->render('news_form.html.twig', array(
					'quote' => $quote,
					'title' => "Ajout d'une news",
					'newsForm' => $newsForm->createView()));
	}

	/**
	 * Edit news controller.
	 *
	 * @param integer $id News id
	 * @param Request $request Incoming request
	 * @param Application $app Silex application
	 */
	public function editNewsAction($id, Request $request, Application $app) {
		$news = $app['dao.news']->find($id);
		$newsForm = $app['form.factory']->create(NewsType::class, $news, array("imgRequired" => false));
		$newsForm->handleRequest($request);
		if ($newsForm->isSubmitted() && $newsForm->isValid()) {
			// Gestion de l'image de la news
			// $file stores the uploaded file
			/** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
			$file = $news->getImgPath();
			if (!empty($file)) {
				// Génération d'un nom de fichier unique
				$fileName = $this->generateUniqueFileName($file);
				// Chemin vers le répertoire de stockage
				$path = __DIR__ . '/../../web/upload/news/';
				$pathRelative = '/upload/news/';
				// Move the file to the directory where news are stored
				$file->move($path, $fileName);
				// Update the 'imgPath' property to store the file name
				// instead of its contents
				$news->setImgPath($pathRelative . $fileName);
			}
			$app['dao.news']->save($news);			
			$app['session']->getFlashBag()->add('successMember', 'Actu modifiée avec succès.');

			
			return $app->redirect($app['url_generator']->generate('member', array(
				'accordion' => 'news'
			)));
		}
		$quote = $app['dao.quote']->findAll();
		return $app['twig']->render('news_form.html.twig', array(
					'quote' => $quote,
					'title' => "Modification de la news",
					'imgPath' => $news->getImgPath(),
					'newsForm' => $newsForm->createView()));
	}

	/**
	 * Delete news controller.
	 *
	 * @param integer $id News id
	 * @param Application $app Silex application
	 */
	public function deleteNewsAction($id, Application $app) {
		// Delete the news
		$app['dao.news']->delete($id);
		$app['session']->getFlashBag()->add('successMember', 'Actu supprimée avec succès.');
		// Redirect to admin home page
		return $app->redirect($app['url_generator']->generate('member', array(
				'accordion' => 'news'
			)));
	}

	
	/**
	 * Add picture controller.
	 *
	 * @param Request $request Incoming request
	 * @param Application $app Silex application
	 */
	public function addPictureAction(Request $request, Application $app) {
		$picture = new Picture();
		$pictureForm = $app['form.factory']->create(PictureType::class, $picture);
		$pictureForm->handleRequest($request);
		if ($pictureForm->isSubmitted() && $pictureForm->isValid()) {
			// Gestion de la miniature
			// $file stores the uploaded file
			/** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
			$file = $picture->getThumbnailPath();
			if (!empty($file)) {
				// Génération d'un nom de fichier unique
				$fileName = $this->generateUniqueFileName($file);
				// Chemin vers le répertoire de stockage
				$path = __DIR__ . '/../../web/upload/gallery/thumbnails/';
				$pathRelative = '/upload/gallery/thumbnails/';
				// Move the file to the directory where thumbnails are stored
				$file->move($path, $fileName);
				// Update the 'thumbnailPath' property to store the file name
				// instead of its contents
				$picture->setThumbnailPath($pathRelative . $fileName);
			}

			// Gestion de l'image originale
			// $file stores the uploaded file
			/** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
			$file2 = $picture->getImgPath();
			if (!empty($file2)) {
				// Génération d'un nom de fichier unique
				$fileName2 = $this->generateUniqueFileName($file2);
				// Chemin vers le répertoire de stockage
				$path2 = __DIR__ . '/../../web/upload/gallery/';
				$pathRelative2 = '/upload/gallery/';
				// Move the file to the directory where avatars are stored
				$file2->move($path2, $fileName2);
				// Update the 'imgPath' property to store the file name
				// instead of its contents
				$picture->setImgPath($pathRelative2 . $fileName2);
			}
			$app['dao.picture']->save($picture);
			$app['session']->getFlashBag()->add('successMember', "Image ajoutée à la galerie");
			return $app->redirect($app['url_generator']->generate('member', array(
				'accordion' => 'picture'
			)));
		}
		$quote = $app['dao.quote']->findAll();
		return $app['twig']->render('picture_form.html.twig', array(
					'quote' => $quote,
					'title' => 'Nouvelle image',
					'pictureForm' => $pictureForm->createView()));
	}

	/**
	 * Edit picture controller.
	 *
	 * @param integer $id Picture id
	 * @param Request $request Incoming request
	 * @param Application $app Silex application
	 */
	public function editPictureAction($id, Request $request, Application $app) {
		$picture = $app['dao.picture']->find($id);
		$pictureForm = $app['form.factory']->create(PictureType::class, $picture);
		$pictureForm->handleRequest($request);
		if ($pictureForm->isSubmitted() && $pictureForm->isValid()) {
			// Gestion de la miniature
			// $file stores the uploaded file
			/** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
			$file = $picture->getThumbnailPath();
			if (!empty($file)) {
				// Génération d'un nom de fichier unique
				$fileName = $this->generateUniqueFileName($file);
				// Chemin vers le répertoire de stockage
				$path = __DIR__ . '/../../web/upload/gallery/thumbnails/';
				$pathRelative = '/upload/gallery/thumbnails/';
				// Move the file to the directory where thumbnails are stored
				$file->move($path, $fileName);
				// Update the 'thumbnailPath' property to store the file name
				// instead of its contents
				$picture->setThumbnailPath($pathRelative . $fileName);
			}

			// Gestion de l'image originale
			// $file stores the uploaded file
			/** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
			$file = $picture->getImgPath();
			if (!empty($file)) {
				// Génération d'un nom de fichier unique
				$fileName = $this->generateUniqueFileName($file);
				// Chemin vers le répertoire de stockage
				$path = __DIR__ . '/../../web/upload/gallery/';
				$pathRelative = '/upload/gallery/';
				// Move the file to the directory where avatars are stored
				$file->move($path, $fileName);
				// Update the 'imgPath' property to store the file name
				// instead of its contents
				$picture->setImgPath($pathRelative . $fileName);
			}

			$app['dao.picture']->save($picture);
			$app['session']->getFlashBag()->add('successMember', "Image modifiée avec succès");
			return $app->redirect($app['url_generator']->generate('member', array(
				'accordion' => 'picture'
			)));
		}
		$quote = $app['dao.quote']->findAll();
		return $app['twig']->render('picture_form.html.twig', array(
					'quote' => $quote,
					'title' => "Modification d'image",
					'imgPath' => $picture->getImgPath(),
					'thumbnailPath' => $picture->getThumbnailPath(),
					'pictureForm' => $pictureForm->createView()));
	}

	/**
	 * Delete picture controller.
	 *
	 * @param integer $id Picture id
	 * @param Application $app Silex application
	 */
	public function deletePictureAction($id, Application $app) {
		// Delete the picture
		$app['dao.picture']->delete($id);
		$app['session']->getFlashBag()->add('successMember', "Image supprimée");
		// Redirect to admin home page
		return $app->redirect($app['url_generator']->generate('member', array(
			'accordion' => 'picture'
		)));
	}
	
	/**
	 * Add Track controller.
	 *
	 * @param Request $request Incoming request
	 * @param Application $app Silex application
	 */
	public function addTrackAction(Request $request, Application $app) {
		$track = new Track();
		$trackForm = $app['form.factory']->create(TrackType::class, $track);
		$trackForm->handleRequest($request);
		if ($trackForm->isSubmitted() && $trackForm->isValid()) {
			
			$app['dao.tracks']->save($track);

			$app['session']->getFlashBag()->add('success', 'Extrait audio créé avec succès.');
			return $app->redirect($app['url_generator']->generate('member', array(
				'accordion' => 'tracks'
			)));
		}
		$quote = $app['dao.quote']->findAll();
		return $app['twig']->render('track_form.html.twig', array(
					'quote' => $quote,
					'title' => "Ajout d'un extrait audio",
					'trackForm' => $trackForm->createView()));
	}

	/**
	 * Edit Track controller.
	 *
	 * @param integer $id Track id
	 * @param Request $request Incoming request
	 * @param Application $app Silex application
	 */
	public function editTrackAction($id, Request $request, Application $app) {
		$track = $app['dao.tracks']->find($id);
		$trackForm = $app['form.factory']->create(TrackType::class, $track);
		$trackForm->handleRequest($request);
		if ($trackForm->isSubmitted() && $trackForm->isValid()) {
			
			$app['dao.tracks']->save($track);

			$app['session']->getFlashBag()->add('success', 'Extrait audio modifié avec succès.');
			return $app->redirect($app['url_generator']->generate('member', array(
				'accordion' => 'tracks'
			)));
		}
		$quote = $app['dao.quote']->findAll();
		return $app['twig']->render('track_form.html.twig', array(
					'quote' => $quote,
					'title' => "Modification de l'extrait audio",
					'trackForm' => $trackForm->createView()));
	}

	/**
	 * Delete Track controller.
	 *
	 * @param integer $id News id
	 * @param Application $app Silex application
	 */
	public function deleteTrackAction($id, Application $app) {
		// Delete the track
		$app['dao.tracks']->delete($id);
		$app['session']->getFlashBag()->add('success', 'Extrait audio supprimé avec succès.');
		// Redirect to admin home page
		return $app->redirect($app['url_generator']->generate('member', array(
			'accordion' => 'tracks'
		)));
	}
}
