<?php

namespace Artisterie\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Artisterie\Domain\Event;

class ApiController {

	/**
	 * API events controller.
	 *
	 * @param Application $app Silex application
	 *
	 * @return All events in JSON format
	 */
	public function getEventsAction(Request $request, Application $app) {
		$start = $request->get("start");
		$end = $request->get("end");
		$events = $app['dao.event']->findAllBetweenDates($start, $end);
		// Convert an array of objects into an array of associative arrays ($responseData)
		$responseData = array();
		foreach ($events as $event) {
			$responseData[] = $this->buildEventArray($event);
		}
		// Create and return a JSON response
		return $app->json($responseData);
	}

	/**
	 * Converts an Event object into an associative array for JSON encoding
	 *
	 * @param Event $event Event object
	 *
	 * @return array Associative array whose fields are the event properties.
	 */
	private function buildEventArray(Event $event) {
		$group = $event->getUser()->getGroup();
		
		$data = array(
			'id' => $event->getId(),
			'title' => $event->getTitle(),
			'start' => $event->getStart(),
			'end' => $event->getEnd(),
			'txtRoomName' => $group->getRoom()->getName(),
			'txtRoomColor' => $group->getRoom()->getColor(),
			'txtGroupName' => $group->getName(),
			'editable' => $event->getEditable()
		);
		return $data;
	}
}
