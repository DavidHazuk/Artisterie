<?php

namespace Artisterie\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints as Assert;

class ContactType extends AbstractType {
	
	public function buildForm(FormBuilderInterface $builder, array $options) {

		$builder
				->add('type', ChoiceType::class, array(
					'label' => 'Type de demande',
					'required' => true,
					'constraints' => new Assert\NotBlank(),
					'choices' => array('Enregistrement studio' => 1, 'Cours et masterclass' => 2, 'Locaux de répétition' => 3, 'Autre' => 4),
					'mapped' => false
				))
				->add('firstname', TextType::class, array(
					'label' => 'Prénom',
					'required' => true,
					'constraints' => new Assert\NotBlank(),
					'mapped' => false
				))
				->add('lastname', TextType::class, array(
					'label' => 'Nom',
					'required' => true,
					'constraints' => new Assert\NotBlank(),
					'mapped' => false
				))
				->add('telephone', TextType::class, array(
					'label' => 'Téléphone',
					'required' => true,
					'constraints' => new Assert\NotBlank(),
					'mapped' => false
				))
				->add('email', EmailType::class, array(
					'label' => 'Email',
					'required' => true,
					'constraints' => new Assert\NotBlank(),
					'mapped' => false
				))
				->add('message', TextareaType::class, array(
					'label' => 'Message',
					'required' => true,
					'constraints' => new Assert\NotBlank(),
					'mapped' => false
				));
	}

	public function getName() {
		return 'contact';
	}

}
