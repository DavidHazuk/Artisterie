<?php

namespace Artisterie\Domain;

class Room {

	/**
	 * Room id.
	 *
	 * @var integer
	 */
	private $id;

	/**
	 * Room name.
	 *
	 * @var string
	 */
	private $name;

	/**
	 * Room color.
	 *
	 * @var string
	 */
	private $color;
	
	/**
	 * Room studio.
	 *
	 * @var boolean
	 */
	private $isStudio;	
	
	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
		return $this;
	}

	function getName() {
		return $this->name;
	}

	function setName($name) {
		$this->name = $name;
		return $this;
	}
	
	function getColor() {
		return $this->color;
	}

	function setColor($color) {
		$this->color = $color;
		return $this;
	}
	
	function getIsStudio() {
		return $this->isStudio;
	}

	function setIsStudio($isStudio) {
		$this->isStudio = $isStudio;
		return $this;
	}


}
