<?php

namespace Artisterie\DAO;

use Artisterie\Domain\Room;
/**
 * Description of RoomDAO
 *
 * @author Etudiant
 */
class RoomDAO extends DAO {
	
	protected function buildDomainObject(array $row) {
		$room = new Room();
		$room->setId($row['idRoom']);
		$room->setName($row['txtRoomName']);
		$room->setColor($row['txtRoomColor']);
		$room->setIsStudio($row['bRoomStudio']);

		return $room;
	}
	
	
	/**
	 * Returns a list of all rooms, sorted by name.
	 *
	 * @return array A list of all rooms.
	 */
	public function findAll() {
		$sql = "select * from t_room order by idRoom";
		$result = $this->getDb()->fetchAll($sql);

		// Convert query result to an array of domain objects
		$entities = array();
		foreach ($result as $row) {
			$id = $row['idRoom'];
			$entities[$id] = $this->buildDomainObject($row);
		}
		return $entities;
	}
	
	/**
	 * Returns a list of all rooms, sorted by name.
	 *
	 * @param $bStudio si on souhaite récupérer le studio ou les locaux de répet
	 * @return array A list of all rooms.
	 */
	public function findAllByStudio($bStudio) {
		$sql = "select * from t_room where bRoomStudio = ? order by idRoom";
		$result = $this->getDb()->fetchAll($sql, array($bStudio));

		// Convert query result to an array of domain objects
		$entities = array();
		foreach ($result as $row) {
			$id = $row['idRoom'];
			$entities[$id] = $this->buildDomainObject($row);
		}
		return $entities;
	}
		
	
	/**
	 * Returns the room of id.
	 *
	 * @return the room.
	 */
	public function find($id) {
		$sql = "select * from t_room where idRoom=?";
		$row = $this->getDb()->fetchAssoc($sql, array($id));

		if ($row){
			return $this->buildDomainObject($row);
		} else {
			throw new \Exception("Pas de local correspondant à l'id '" . $id . "'");
		}		
	}
	
	public function findAllSelect() {
		$sql = "select * from t_room order by idRoom";
		$result = $this->getDb()->fetchAll($sql);

		// Convert query result to an array of domain objects
		$entities = array();
		// Première valeur vide
		$entities["Sélectionnez un local"] = NULL;
		foreach ($result as $row) {
			$id = $row['txtRoomName'];
			$entities[$id] = $row['idRoom'];
		}
		return $entities;
	}	
	
	
	/**
	 * Saves a room into the database.
	 *
	 * @param \Artisterie\Domain\Room $room The room to save
	 */
	public function save(Room $room) {
		$roomData = array(
			'txtRoomName' => $room->getName(),
			'txtRoomColor' => $room->getColor(),
			'bRoomStudio' => $room->getIsStudio()
		);

		if ($room->getId()) {
			// The room has already been saved : update it
			$this->getDb()->update('t_room', $roomData, array('idRoom' => $room->getId()));
		} else {
			// The room has never been saved : insert it
			$this->getDb()->insert('t_room', $roomData);
			// Get the id of the newly created room and set it on the entity.
			$id = $this->getDb()->lastInsertId();
			$room->setId($id);
		}
	}
	
	/**
	 * Is the room $id available between $start and $end ?
	 *
	 * @param \Artisterie\Domain\Room $room The room
	 * @param \Artisterie\Domain\Event $event the event
	 */
	public function isRoomAvailable($room, $event){
		$bAvailable = true;
		$roomId = $room->getId();
		$start = $event->getStart();
		$end = $event->getEnd();
		$eventId = $event->getId();

		if (empty($eventId)) {
			$eventId = "";
		}
		
		$sql = "SELECT *
				FROM t_group g
					INNER JOIN t_user u ON g.idGroup = u.idGroup
					INNER JOIN t_event e ON u.idUser = e.idUser
				WHERE g.idRoom = ?
				AND e.id != ?
				AND ((? >= e.start AND ? < e.end)
				OR (? > e.start AND ? <= e.end)
				OR (? <= e.start AND ? >= e.end)) LIMIT 1";
		$row = $this->getDb()->fetchAssoc($sql, array($roomId, $eventId, $start, $start, $end, $end, $start, $end));

		if ($row){
			// Il y a un résultat, le local n'est pas disponible
			$bAvailable = false;
		}
		
		return $bAvailable;
	}
}
