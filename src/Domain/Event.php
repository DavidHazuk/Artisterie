<?php

namespace Artisterie\Domain;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class Event {

	/**
	 * Event id.
	 *
	 * @var integer
	 */
	private $id;

	/**
	 * Event title.
	 *
	 * @var string
	 */
	private $title;

	/**
	 * Event start.
	 *
	 * @var datetime
	 */
	private $start;
	
	/**
	 * Event end.
	 *
	 * @var datetime
	 */
	private $end;
	
	/**
	 * Event user.
	 *
	 * @var Artisterie\Domain\User
	 */
	private $user;
	
	/**
	 * Event editable.
	 *
	 * @var boolean
	 */
	private $editable;
	
	
	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	
	function getTitle() {
		return $this->title;
	}

	function setTitle($title) {
		$this->title = $title;
		return $this;
	}

	function getStart() {
		return $this->start;
	}

	function setStart($start) {
		$this->start = $start;
		return $this;
	}

	function getEnd() {
		return $this->end;
	}

	function setEnd($end) {
		$this->end = $end;
		return $this;
	}

	function getUser() {
		return $this->user;
	}

	function setUser($user) {
		$this->user = $user;
		return $this;
	}
	
	function getEditable() {
		return $this->editable;
	}

	function setEditable($editable) {
		$this->editable = $editable;
		return $this;
	}
		
//    public static function loadValidatorMetadata(ClassMetadata $metadata)
//    {
//        $metadata->addConstraint(new Assert\Callback('validate'));
//	}
//	
//    public function validate(ExecutionContextInterface $context){
////		var_dump("validate start " . $this->start . "<br>");
////		var_dump("validate end " . $this->end . "<br>");
//        if (strtotime($this->start) >= strtotime($this->end)) {
//			$context->buildViolation("L'heure de fin doit être après l'heure de début !")
//			->atPath('endHour')
//			->addViolation();
//        }
//    }
}
