<?php

namespace Artisterie\Domain;

/**
 * Description of News
 *
 * @author David
 */
class News {
	/**
	 * News id.
	 *
	 * @var integer
	 */
	private $id;

	/**
	 * News content.
	 *
	 * @var string
	 */
	private $content;
	
	/**
	 * News date.
	 *
	 * @var integer
	 */
	private $date;
	
	/**
	 * News imgPath.
	 *
	 * @var string
	 */
	private $imgPath;

	/**
	 * News title.
	 *
	 * @var string
	 */
	private $title;
	
	function getId() {
		return $this->id;
	}

	function getContent() {
		return $this->content;
	}

	function getImgPath() {
		return $this->imgPath;
	}

	function getTitle() {
		return $this->title;
	}
	
	function getDate() {
		return $this->date;
	}

	function setDate($date) {
		$this->date = $date;
		return $this;
	}
	
	function setId($id) {
		$this->id = $id;
		return $this;
	}

	function setContent($content) {
		$this->content = $content;
		return $this;
	}

	function setImgPath($imgPath) {
		$this->imgPath = $imgPath;
		return $this;
	}

	function setTitle($title) {
		$this->title = $title;
		return $this;
	}


}
