<?php

namespace Artisterie\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Description of StartTimeBeforeEndTime
 *
 * @author Etudiant
 */
class StartTimeBeforeEndTime extends Constraint {
    public $message = "L'heure de début doit être avant l'heure de fin.";
	
	// in the base Symfony\Component\Validator\Constraint class
	public function validatedBy()
	{
		return get_class($this).'Validator';
	}
	
	public function getTargets()
	{
		return self::CLASS_CONSTRAINT;
	}	
}
