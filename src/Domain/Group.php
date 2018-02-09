<?php

namespace Artisterie\Domain;

class Group {

	/**
	 * Group id.
	 *
	 * @var integer
	 */
	private $id;

	/**
	 * Group name.
	 *
	 * @var string
	 */
	private $name;

	/**
	 * Group image.
	 *
	 * @var string
	 */
	private $imgPath;
	
	/**
	 * Group room.
	 *
	 * @var Artisterie\Domain\Room
	 */
	private $room;
	
	/**
	 * Group Nb members.
	 *
	 * @var string
	 */
	private $nbMembers;

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
		return $this;
	}

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
		return $this;
	}

	public function getRoom() {
		return $this->room;
	}

	public function setRoom($room) {
		$this->room = $room;
		return $this;
	}

	public function getImgPath() {
		return $this->imgPath;
	}

	public function setImgPath($imgPath) {
		$this->imgPath = $imgPath;
		return $this;
	}

	public function getNbMembers() {
		return $this->nbMembers;
	}

	public function setNbMembers($nbMembers) {
		$this->nbMembers = $nbMembers;
		return $this;
	}

}
