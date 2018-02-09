<?php

namespace Artisterie\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class PictureType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
				->add('name', TextType::class, array(
					'label' => "Nom"
				))
				->add('thumbnailPath', FileType::class, array(
					'label' => "Miniature", // Label du champ sur le formulaire
					'required' => false,
					'data_class'  => null
				))
				->add('imgPath', FileType::class, array(
					'label' => "Image originale",
					'required' => false,
					'data_class'  => null
				))
				;
	}

	public function getName() {
		return 'picture';
	}

}
