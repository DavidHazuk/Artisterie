<?php

namespace Artisterie\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Description of StartTimeBeforeEndTimeValidator
 *
 * @author Etudiant
 */
class StartTimeBeforeEndTimeValidator extends ConstraintValidator{
    public function validate($protocol, Constraint $constraint)
    {
        if ($protocol->getStart() < $protocol->getEnd()) {
            // If you're using the new 2.5 validation API (you probably are!)
            $this->context->buildViolation($constraint->message)
                ->atPath('start')
                ->addViolation();
        }
    }
}