<?php

namespace Artisterie\DAO;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Artisterie\Domain\User;

class UserDAO extends DAO implements UserProviderInterface {

	private $groupDAO;
	
	public function setGroupDAO(GroupDAO $groupDAO){
		$this->groupDAO = $groupDAO;
	}

	/**
	 * Creates a User object based on a DB row.
	 *
	 * @param array $row The DB row containing User data.
	 * @return \Artisterie\Domain\User
	 */
	protected function buildDomainObject(array $row) {
		$user = new User();
		$user->setId($row['idUser']);
		$user->setUsername($row['txtUserName']);
		$user->setPassword($row['txtUserPassword']);
		$user->setRole($row['txtUserRole']);
		$user->setSalt($row['txtUserSalt']);
		$user->setMail($row['txtUserMail']);
		$user->setImgPath($row['txtUserImgPath']);

		if (array_key_exists('idGroup', $row) && !empty($row['idGroup'])) {
			// Find and set the associated group
			$idGroup = $row['idGroup'];
			$group = $this->groupDAO->find($idGroup);
			$user->setGroup($group);
		}

		return $user;
	}
	
	/**
	 * Returns a list of all users, sorted by role and name.
	 *
	 * @return array A list of all users.
	 */
	public function findAll() {
		$sql = "select u.* from t_user u order by txtUserRole, txtUserName";
		$result = $this->getDb()->fetchAll($sql);

		// Convert query result to an array of domain objects
		$entities = array();
		foreach ($result as $row) {
			$id = $row['idUser'];
			$entities[$id] = $this->buildDomainObject($row);
		}
		return $entities;
	}

	public function findAllSelect() {
		$sql = "select * from t_user order by txtUserName";
		$result = $this->getDb()->fetchAll($sql);

		// Convert query result to an array of domain objects
		$entities = array();
		// Première valeur vide
		$entities[""] = NULL;
		foreach ($result as $row) {
			$id = $row['txtUserName'];
			$entities[$id] = $row['idUser'];
		}
		return $entities;
	}
	
	/**
	 * Returns a user matching the supplied id.
	 *
	 * @param integer $id The user id.
	 *
	 * @return \Artisterie\Domain\User|throws an exception if no matching user is found
	 */
	public function find($id) {
		$sql = "select * from t_user where idUser=?";
		$row = $this->getDb()->fetchAssoc($sql, array($id));

		if ($row){
			return $this->buildDomainObject($row);
		} else {
			throw new \Exception("Pas d'utilisateur correspondant à l'id " . $id . "'");
		}
	}

	/**
	 * Returns the first user of group id $id.
	 *
	 * @return the user.
	 */
	public function findUserGroup($idGroup) {
		$sql = "select u.* from t_user u INNER JOIN t_group g ON g.idGroup = u.idGroup where g.idGroup=? LIMIT 1";
		$row = $this->getDb()->fetchAssoc($sql, array($idGroup));

		if ($row){
			return $this->buildDomainObject($row);
		} else {
			throw new \Exception("Pas de groupe correspondant à l'id '" . $id . "'");
		}		
	}	
	
	/**
	 * Saves a user into the database.
	 *
	 * @param \Artisterie\Domain\User $user The user to save
	 */
	public function save(User $user) {
		if (!empty($user->getGroup())){
			$groupId = $user->getGroup()->getId();
		} else {
			$groupId = NULL;
		}

		$userData = array(
			'txtUserName' => $user->getUsername(),
			'txtUserMail' => $user->getMail(),
			'txtUserRole' => $user->getRole(),
			'idGroup' => $groupId
		);

		// Si le password est fourni, il faut l'inclure dans la modification
		if (!empty($user->getPassword())){
			$userData['txtUserPassword'] = $user->getPassword();
			$userData['txtUserSalt'] = $user->getSalt();
		}

		// Si un avatar est fourni
		if (!empty($user->getPassword())){
			$userData['txtUserImgPath'] = $user->getImgPath();
		}
		
		if ($user->getId()) {
			// The user has already been saved : update it
			$this->getDb()->update('t_user', $userData, array('idUser' => $user->getId()));
		} else {
			// The user has never been saved : insert it
			$this->getDb()->insert('t_user', $userData);
			// Get the id of the newly created user and set it on the entity.
			$id = $this->getDb()->lastInsertId();
			$user->setId($id);
		}
	}

	/**
	 * Removes an user from the database.
	 *
	 * @param integer $id The user id.
	 */
	public function delete($id) {
		// Delete the user
		$this->getDb()->delete('t_user', array('idUser' => $id));
	}

	/**
	 * {@inheritDoc}
	 */
	public function loadUserByUsername($username) {
		$sql = "select * from t_user where txtUserName=?";
		$row = $this->getDb()->fetchAssoc($sql, array($username));

		if ($row) {
			return $this->buildDomainObject($row);
		} else {
			throw new UsernameNotFoundException(sprintf('Utilisateur "%s" inconnu.', $username));
		}
	}

	/**
	 * {@inheritDoc}
	 */
	public function refreshUser(UserInterface $user) {
		$class = get_class($user);
		if (!$this->supportsClass($class)) {
			throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $class));
		}
		return $this->loadUserByUsername($user->getUsername());
	}

	/**
	 * {@inheritDoc}
	 */
	public function supportsClass($class) {
		return 'Artisterie\Domain\User' === $class;
	}
	
	

	/**
	 * Delete users of group id.
	 *
	 * @param integer $groupId The group id to delete
	 */
	public function deleteAllUsersGroup($groupId) {
		
		$count = $this->getDb()->executeUpdate('DELETE FROM t_user WHERE idGroup = ?', array($groupId));

	}	

}
