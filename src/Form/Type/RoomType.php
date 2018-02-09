<?php

namespace Artisterie\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RoomType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
				->add('name', TextType::class, array(
					'label' => "Nom du local"
				))
				->add('color', TextType::class, array(
					'label' => "Couleur associée dans le planning"
				));
	}

	public function getName() {
		return 'room';
	}

}
