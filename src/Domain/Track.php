<?php

namespace Artisterie\Domain;

class Track {
	
	/**
	 * Track id.
	 *
	 * @var integer
	 */
	private $id;

	/**
	 * Track name.
	 *
	 * @var string(50)
	 */
	private $name;
	
	/**
	 * Soundcloud URL of the Track.
	 *
	 * @var string(255)
	 */
	private $url;
	
	/**
	 * Path to the local audio file of the Track.
	 *
	 * @var string(255)
	 */
	private $path;
	
	/**
	 * Record whose Track is taken from.
	 *
	 * @var string(50)
	 */
	private $record;
	
	/**
	 * Record release date.
	 *
	 * @var date(4)
	 */
	private $date;
	
	/**
	 * Record music style.
	 *
	 * @var string(50)
	 */
	private $style;
	
	/**
	 * Path to the artwork image file of the Record.
	 *
	 * @var string(255)
	 */
	private $artwork;
	
	/**
	 * Artist name.
	 *
	 * @var string(50)
	 */
	private $artist;
	
	/** 
	 * All Getters & Setters 
	 */
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
	
	public function getUrl() {
		return $this->url;
	}

	public function setUrl($url) {
		$this->url = $url;
		return $this;
	}
	
	public function getPath() {
		return $this->path;
	}

	public function setPath($path) {
		$this->path = $path;
		return $this;
	}
	
	public function getRecord() {
		return $this->record;
	}

	public function setRecord($record) {
		$this->record = $record;
		return $this;
	}
	
	public function getDate() {
		return $this->date;
	}

	public function setDate($date) {
		$this->date = $date;
		return $this;
	}
	
	public function getStyle() {
		return $this->style;
	}

	public function setStyle($style) {
		$this->style = $style;
		return $this;
	}
	
	public function getArtwork() {
		return $this->artwork;
	}

	public function setArtwork($artwork) {
		$this->artwork = $artwork;
		return $this;
	}
	
	public function getArtist() {
		return $this->artist;
	}

	public function setArtist($artist) {
		$this->artist = $artist;
		return $this;
	}
}
