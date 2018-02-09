<?php

namespace Artisterie\Domain;

class Picture {

	/**
	 * Picture id.
	 *
	 * @var integer
	 */
	private $id;

	/**
	 * Picture name.
	 *
	 * @var string
	 */
	private $name;

	/**
	 * Picture thumbnail path.
	 *
	 * @var string
	 */
	private $thumbnailPath;
	
	/**
	 * Picture path.
	 *
	 * @var string
	 */
	private $imgPath;	
	
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
	
	function getThumbnailPath() {
		return $this->thumbnailPath;
	}

	function setThumbnailPath($thumbnailPath) {
		$this->thumbnailPath = $thumbnailPath;
		return $this;
	}

	function getImgPath() {
		return $this->imgPath;
	}


	function setImgPath($imgPath) {
		$this->imgPath = $imgPath;
		return $this;
	}
}
