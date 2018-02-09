<?php

namespace Artisterie\Domain;

use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface {

	/**
	 * User id.
	 *
	 * @var integer
	 */
	private $id;

	/**
	 * User name.
	 *
	 * @var string
	 */
	private $username;

	/**
	 * User password.
	 *
	 * @var string
	 */
	private $password;
	
	/**
	 * User mail.
	 *
	 * @var string
	 */
	private $mail;
	
	/**
	 * User avatar.
	 *
	 * @var string
	 */
	private $imgPath;

	/**
	 * Salt that was originally used to encode the password.
	 *
	 * @var string
	 */
	private $salt;

	/**
	 * Role.
	 * Values : ROLE_USER or ROLE_ADMIN.
	 *
	 * @var string
	 */
	private $role;
	
	/**
	 * User group.
	 *
	 * @var Artisterie\Domain\Group
	 */
	private $group;	

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
		return $this;
	}

	/**
	 * @inheritDoc
	 */
	public function getUsername() {
		return $this->username;
	}

	public function setUsername($username) {
		$this->username = $username;
		return $this;
	}

	/**
	 * @inheritDoc
	 */
	public function getPassword() {
		return $this->password;
	}

	public function setPassword($password) {
		$this->password = $password;
		return $this;
	}

	/**
	 * @inheritDoc
	 */
	public function getSalt() {
		return $this->salt;
	}

	public function setSalt($salt) {
		$this->salt = $salt;
		return $this;
	}

	public function getRole() {
		return $this->role;
	}

	public function setRole($role) {
		$this->role = $role;
		return $this;
	}

	/**
	 * @inheritDoc
	 */
	public function getRoles() {
		return array($this->getRole());
	}

	/**
	 * @inheritDoc
	 */
	public function eraseCredentials() {
		// Nothing to do here
	}
	
	public function getMail() {
		return $this->mail;
	}

	public function setMail($mail) {
		$this->mail = $mail;
		return $this;
	}

	public function getImgPath() {
		return $this->imgPath;
	}

	public function setImgPath($imgPath) {
		$this->imgPath = $imgPath;
		return $this;
	}
	
	public function getGroup() {
		return $this->group;
	}

	public function setGroup($group) {
		$this->group = $group;
		return $this;
	}
}
