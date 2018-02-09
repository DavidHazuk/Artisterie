<?php

namespace Artisterie\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Validator\Constraints as Assert;


class EventType extends AbstractType {
	// Pour indiquer que le tableau d'options passé à l'appel de buildForm
	// contient aussi une option nommée "rooms"
    public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults([
				'startHour' => '',
				'endHour' => '',
				'day' => ''
			]);
    }	
	
	public function buildForm(FormBuilderInterface $builder, array $options) {
		// Création des listes de choix d'heures
		// Récupération du jour de l'évènement
		//$day = substr($builder->getData()->getStart(),0,10);
		
		
		// Création de la liste des heures pour les listes de choix
		$hours = array();
		for($i=0;$i<=23;$i++){
			if($i < 10){
				$heure = "0" . $i;
			} else {
				$heure = $i;
			}
			$heure = $heure . ":00";
			//$hours[$heure] = $day . " " . $heure. ":00";
			$hours[$heure] = $heure. ":00";
		}

		$builder
				->add('title', TextType::class, array(
					'label' => 'Titre',
					'required' => true,
					'constraints' => new Assert\NotBlank()
				))
				->add('day', HiddenType::class, array(
					'data' => $options["day"],
					'mapped' => false
				))
				->add('startHour', ChoiceType::class, array(
					'label' => 'Heure de début',
					'required' => true,
					'constraints' => new Assert\NotBlank(),
					'choices' => $hours,
					'data' => $options["startHour"],
					'mapped' => false
				))
				->add('endHour', ChoiceType::class, array(
					'label' => 'Heure de fin',
					'required' => true,
					'constraints' => new Assert\NotBlank(),
					'choices' => $hours,
					'data' => $options["endHour"],
					'mapped' => false
				))
				->add('valid', SubmitType::class, array(
					'label' => 'Valider',
					'attr' => array('class' => 'btn btn-primary')
				))
				;
	}

	public function getName() {
		return 'event';
	}

}
