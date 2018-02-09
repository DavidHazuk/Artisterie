<?php

namespace Artisterie\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Artisterie\Form\Type\ContactType;

class HomeController {

	/**
	 * Home page controller.
	 *
	 * @param Application $app Silex application
	 */
	public function indexAction(Application $app) {
		$quote = $app['dao.quote']->findAll();
		$news = $app['dao.news']->findLastNews();
		return $app['twig']->render('home.html.twig', array(
			'quote' => $quote,
			'news' => $news
		));
	}
	
	/**
	 * Pages controller.
	 *
	 * @param string page name
	 * @param Application $app Silex application
	 */
	public function pageAction($pagename, $pagenumber, Application $app) {
		$quote = $app['dao.quote']->findAll();
		$options = array('quote' => $quote);

		switch($pagename){
			case "home":
				$pageFileName = 'home.html.twig';
				break;
			case "studio":
				$pageFileName = 'studio.html.twig';
				break;
			case "rehearsal":
				$pageFileName = 'rehearsal.html.twig';
				break;
			case "artists":
				$pageFileName = 'artists.html.twig';
				$pictures = $app['dao.picture']->findAll();
				$options['pictures'] = $pictures;
				$tracks = $app['dao.tracks']->findAll();
				$options['tracks'] = $tracks;
				break;
			case "news":
				$pageFileName = 'news.html.twig';
				$news = $app['dao.news']->findCurrentPage($pagenumber);
				$options['news'] = $news;

				$numberPages = $app['dao.news']->countAllPages();
				$options['numberPages'] = $numberPages;
				$options['pagenumber'] = $pagenumber;

				break;
			default:
				$pageFileName = "";
		}
		
		return $app['twig']->render($pageFileName, $options);
	}

	/**
	 * Contact page controller.
	 *
	 * @param Application $app Silex application
	 */
	public function contactAction(Request $request, Application $app) {
		$contactForm = $app['form.factory']->create(ContactType::class, null);
		$contactForm->handleRequest($request);
		if ($contactForm->isSubmitted() && $contactForm->isValid()) {
			// Gestion du contact
			$dataForm = $contactForm->getData();

			//////////////////////////////////////
			/////////////////////////////////////
			/// CODE ENVOI DE MAIL !!!!!!!!!!!!!
			//////////////////////////////////////
			/////////////////////////////////////

			//$app['session']->getFlashBag()->add('success', 'Demande de contact envoyée.');
		}
		$quote = $app['dao.quote']->findAll();
		return $app['twig']->render('contact.html.twig', array(
					'quote' => $quote,
					'contactForm' => $contactForm->createView()));
	}

	/**
	 * User login controller.
	 *
	 * @param Request $request Incoming request
	 * @param Application $app Silex application
	 */
	public function loginAction(Request $request, Application $app) {
		$quote = $app['dao.quote']->findAll();
		return $app['twig']->render('login.html.twig', array(
					'quote' => $quote,
					'error' => $app['security.last_error']($request),
					'last_username' => $app['session']->get('_security.last_username'),
		));
	}	
}
