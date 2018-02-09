<?php


namespace Artisterie\Domain;

/**
 * Description of Quote
 *
 * @author David
 */
class Quote {
	/**
	 * Quote id.
	 *
	 * @var integer
	 */
	private $id;

	/**
	 * Quote quote.
	 *
	 * @var string
	 */
	private $quote;
	
	/**
	 * Quote author.
	 *
	 * @var string
	 */
	private $author;
	
	
	function getId() {
		return $this->id;
	}

	function getQuote() {
		return $this->quote;
	}

	function getAuthor() {
		return $this->author;
	}

	function setId($id) {
		$this->id = $id;
		return $this;
	}

	function setQuote($quote) {
		$this->quote = $quote;
		return $this;
	}

	function setAuthor($author) {
		$this->author = $author;
		return $this;
	}


}
