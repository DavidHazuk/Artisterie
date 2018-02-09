<?php

namespace Artisterie\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class GroupType extends AbstractType {
	// Pour indiquer que le tableau d'options passé à l'appel de buildForm
	// contient aussi une option nommée "rooms"
    public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults([
				'rooms' => []
			]);
    }

	public function buildForm(FormBuilderInterface $builder, array $options) {
		// Pour récupérer l'id du local sur le groupe
		if ($builder->getData()->getRoom() != null){
			$roomId = $builder->getData()->getRoom()->getId();
		} else {
			$roomId = null;
		}

		$builder
				->add('name', TextType::class, array(
					'label' => "Nom du groupe",
				))
				->add('room', ChoiceType::class, array(
					'label' => "Local",
					'choices' => $options['rooms'],
					'choices_as_values' => true, // Future valeur par défaut dans Symfony 3.x
					'choice_value' => function ($choice) {
						return $choice;
					},
					'expanded' => false, 
					'multiple' => false,
					'data' => $roomId, // Pour mettre la valeur contenue dans l'objet en édition
					'mapped' => false  // ce champ n'est pas mis en correspondance avec la propriété de l'objet
				))
				->add('imgPath', FileType::class, array(
					'label' => "Avatar du groupe", // Label du champ sur le formulaire
					'required' => false, // L'upload de fichier n'est pas obligatoire
					'data_class'  => null
				));
	}

	public function getName() {
		return 'group';
	}

}
