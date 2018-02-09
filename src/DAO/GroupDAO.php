<?php

namespace Artisterie\DAO;

use Artisterie\Domain\Group;

/**
 * Description of GroupDAO
 *
 * @author Etudiant
 */
class GroupDAO extends DAO {
	
	private $roomDAO;
	
	public function setRoomDAO(RoomDAO $roomDAO){
		$this->roomDAO = $roomDAO;
	}
	
	protected function buildDomainObject(array $row) {
		$group = new Group();
		$group->setId($row['idGroup']);
		$group->setName($row['txtGroupName']);
		$group->setImgPath($row['txtGroupImgPath']);
		$group->setNbMembers($row['nbMembers']);
		 
		if (array_key_exists('idRoom', $row) && !empty($row['idRoom'])) {
			// Find and set the associated user
			$idRoom = $row['idRoom'];
			$room = $this->roomDAO->find($idRoom);
			$group->setRoom($room);
		}

		return $group;
	}
	
	
	/**
	 * Returns a list of all groups, sorted by name.
	 *
	 * @return array A list of all groups.
	 */
	public function findAll() {
		$sql = "select g.*, COUNT(u.idGroup) as nbMembers from t_group g LEFT JOIN t_user u ON u.idGroup = g.idGroup GROUP BY idGroup order by txtGroupName";
		$result = $this->getDb()->fetchAll($sql);

		// Convert query result to an array of domain objects
		$entities = array();
		foreach ($result as $row) {
			$id = $row['idGroup'];
			$entities[$id] = $this->buildDomainObject($row);
		}
		return $entities;
	}
	
	/**
	 * Returns the group of id $id.
	 *
	 * @return the group.
	 */
	public function find($id) {
		$sql = "select g.*, COUNT(u.idGroup) as nbMembers from t_group g LEFT JOIN t_user u ON u.idGroup = g.idGroup where g.idGroup=? GROUP BY idGroup";
		$row = $this->getDb()->fetchAssoc($sql, array($id));

		if ($row){
			return $this->buildDomainObject($row);
		} else {
			throw new \Exception("Pas de groupe correspondant à l'id '" . $id . "'");
		}		
	}

//	/**
//	 * Returns the group of name $name.
//	 *
//	 * @return the group.
//	 */
//	public function findByName($name) {
//		$sql = "select * from t_group where txtGroupName=?";
//		$row = $this->getDb()->fetchAssoc($sql, array($name));
//
//		if ($row){
//			return $this->buildDomainObject($row);
//		} else {
//			throw new \Exception("Pas de groupe correspondant au nom '" . $name . "'");
//		}		
//	}
	
	public function findAllSelect() {
		$sql = "select * from t_group order by txtGroupName";
		$result = $this->getDb()->fetchAll($sql);

		// Convert query result to an array of domain objects
		$entities = array();
		// Première valeur vide
		$entities["Sélectionnez un groupe"] = NULL;
		foreach ($result as $row) {
			$id = $row['txtGroupName'];
			$entities[$id] = $row['idGroup'];
		}
		return $entities;
	}
	
	/**
	 * Saves a group into the database.
	 *
	 * @param \Artisterie\Domain\Group $group The group to save
	 */
	public function save(Group $group) {
		if (!empty($group->getRoom())){
			$roomId = $group->getRoom()->getId();
		} else {
			$roomId = NULL;
		}		
		
		$groupData = array(
			'txtGroupName' => $group->getName(),
			'idRoom' => $roomId
		);

		// Si un avatar est fourni
		if (!empty($group->getImgPath())){
			$groupData['txtGroupImgPath'] = $group->getImgPath();
		}
		
		if ($group->getId()) {
			// The group has already been saved : update it
			$this->getDb()->update('t_group', $groupData, array('idGroup' => $group->getId()));
		} else {
			// The group has never been saved : insert it
			$this->getDb()->insert('t_group', $groupData);
			// Get the id of the newly created group and set it on the entity.
			$id = $this->getDb()->lastInsertId();
			$group->setId($id);
		}
	}

	/**
	 * Removes a group from the database.
	 *
	 * @param integer $id The group id.
	 */
	public function delete($id) {
		// Delete the group
		$this->getDb()->delete('t_group', array('idGroup' => $id));
	}
	
}
