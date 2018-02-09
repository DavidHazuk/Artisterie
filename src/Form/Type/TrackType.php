<?php

namespace Artisterie\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Track Admin Form Template
 */
class TrackType extends AbstractType{
	
	public function buildForm(FormBuilderInterface $builder, array $options) {
		
		$builder
				->add('name', TextType::class, array(
                    'label'       => "Titre",
                    'required'    => true,
                    'constraints' => new Assert\NotBlank(),
                ))
				->add('url', TextType::class, array(
                    'label'       => "Lien Soundcloud",
                    'required'    => true,
                    'constraints' => new Assert\NotBlank(),
                ))	
				->add('record', TextType::class, array(
                    'label'       => "Album",
                    'required'    => true,
                    'constraints' => new Assert\NotBlank(),
                ))
				->add('date', TextType::class, array(
                    'label'       => "Année",
                    'required'    => true,
                    'constraints' => array(
						new Assert\NotBlank(), 
						new Assert\Length(array(
							'min'        => 4,
							'max'        => 4,
							'exactMessage' => 'L\'année doit être un nombre de 4 chiffres',
							'minMessage' => 'L\'année doit être un nombre de 4 chiffres',
							'maxMessage' => 'L\'année doit être un nombre de 4 chiffres',
						)),
						new Assert\GreaterThan(array(
							'value' => 2000,
							'message' => 'L\'année doit être supérieure à 2000',
						)),	
						new Assert\LessThan(array(
							'value' => 2050,
							'message' => 'L\'année doit être inférieure à 2050',
						)),
					),	
				))
				->add('style', TextType::class, array(
                    'label'       => "Style musical",
                    'required'    => true,
                    'constraints' => new Assert\NotBlank(),
                ))
				->add('artist', TextType::class, array(
                    'label'       => "Artiste",
                    'required'    => true,
                    'constraints' => new Assert\NotBlank(),
                ));
		
	}	
	
}
