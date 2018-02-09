<?php

namespace Artisterie\DAO;

use Artisterie\Domain\Event;

/**
 * Description of EventDAO
 *
 * @author Etudiant
 */
class EventDAO extends DAO {
	
	private $userDAO;
	
	public function setUserDAO(UserDAO $userDAO){
		$this->userDAO = $userDAO;
	}

	private $currentUser;
	
	public function setCurrentUser($user){
		$this->currentUser = $user;
	}
	
	protected function buildDomainObject(array $row) {
		$event = new Event();
		$event->setId($row['id']);
		$event->setTitle($row['title']);
		$event->setStart($row['start']);
		$event->setEnd($row['end']);

		// Récupère le user associé à l'évènement
		$idUser = $row['idUser'];
		$user = $this->userDAO->find($idUser);
		$event->setUser($user);
		
		// Est-ce que le user courant est dans le même groupe que celui de l'event ?
		// Si oui, l'évènement est modifiable.
		// Si non, l'évènement n'est pas modifiable.
		if ($this->currentUser->getGroup()->getId() == $user->getGroup()->getId()){
			$event->setEditable(true);
		} else {
			$event->setEditable(false);
		}
		
		return $event;
	}
	
	
	/**
	 * Returns a list of all events, sorted by id.
	 *
	 * @return array A list of all events.
	 */
	public function findAll() {
		$sql = "select * from t_event order by id";
		$result = $this->getDb()->fetchAll($sql);

		// Convert query result to an array of domain objects
		$entities = array();
		foreach ($result as $row) {
			$id = $row['id'];
			$entities[$id] = $this->buildDomainObject($row);
		}
		return $entities;
	}
	
	/**
	 * Returns a list of all events between 2 dates, sorted by id.
	 *
	 * @param date $start start date
	 * @param date $end end date
	 * @return array A list of all events.
	 */
	public function findAllBetweenDates($start, $end) {
		
		$sql = "select * from t_event where start BETWEEN ? and ? order by id";
		$result = $this->getDb()->fetchAll($sql, array($start, $end));

		// Convert query result to an array of domain objects
		$entities = array();
		foreach ($result as $row) {
			$id = $row['id'];
			$entities[$id] = $this->buildDomainObject($row);
		}
		return $entities;
	}
	
	/**
	 * Returns the event of id $id.
	 *
	 * @return the event.
	 */
	public function find($id) {
		$sql = "select * from t_event where id=?";
		$row = $this->getDb()->fetchAssoc($sql, array($id));

		if ($row){
			return $this->buildDomainObject($row);
		} else {
			throw new \Exception("Pas d'évènement correspondant à l'id '" . $id . "'");
		}		
	}

	/**
	 * Saves an event into the database.
	 *
	 * @param \Artisterie\Domain\Event $event The event to save
	 */
	public function save(Event $event) {
		$userId = $event->getUser()->getId();

		$eventData = array(
			'title' => $event->getTitle(),
			'start' => $event->getStart(),
			'end' => $event->getEnd(),
			'idUser' => $userId
		);
		
		if ($event->getId()) {
			// The event has already been saved : update it
			$this->getDb()->update('t_event', $eventData, array('id' => $event->getId()));
		} else {
			// The event has never been saved : insert it
			$this->getDb()->insert('t_event', $eventData);
			// Get the id of the newly created article and set it on the entity.
			$id = $this->getDb()->lastInsertId();
			$event->setId($id);
		}
	}

	/**
	 * Removes an event from the database.
	 *
	 * @param integer $id The event id.
	 */
	public function delete($id) {
		// Delete the event
		$this->getDb()->delete('t_event', array('id' => $id));
	}

	/**
	 * Delete events created bu User id.
	 *
	 * @param integer $id The user id to delete
	 */
	public function deleteAllEventsUser($userId) {
		$count = $this->getDb()->executeUpdate('DELETE FROM t_event WHERE idUser = ?', array($userId));
	}
}
