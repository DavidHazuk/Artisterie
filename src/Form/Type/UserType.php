<?php

namespace Artisterie\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class UserType extends AbstractType {
	// Pour indiquer que le tableau d'options passé à l'appel de buildForm
	// contient aussi une option nommée "groups"
    public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults([
				'groups' => [],
				'rooms' => [],
				'mode' => "",
			]);
    }

	public function buildForm(FormBuilderInterface $builder, array $options) {
		// Pour récupérer l'id du groupe sur le user
		if ($builder->getData()->getGroup() != null){
			$groupId = $builder->getData()->getGroup()->getId();
		} else {
			$groupId = null;
		}
		
		if ($options["mode"] == "modification") {
			// Si le formulaire est en modification
			$requiredPassword = false;
		} else {
			// Si le formulaire est en ajout
			$requiredPassword = true;
		}

		$builder
				->add('username', TextType::class, array(
					'label' => "Nom du membre"
				))
				->add('password', RepeatedType::class, array(
					'type' => PasswordType::class,
					'required' => $requiredPassword,
					'invalid_message' => 'Les mots de passe ne correspondent pas.',
					'first_options' => array('label' => 'Mot de passe'),
					'second_options' => array('label' => 'Répétez le mot de passe'),
				))
				->add('mail', EmailType::class, array(
					'label' => 'Email'
				))
				->add('role', ChoiceType::class, array(
					'choices' => array('Membre' => 'ROLE_USER', 'Admin' => 'ROLE_ADMIN')
				))
				->add('group', ChoiceType::class, array(
					'label' => "Groupe",
					'choices' => $options['groups'],
					'choices_as_values' => true, // Future valeur par défaut dans Symfony 3.x
					'choice_value' => function ($choice) {
						return $choice;
					},
					'expanded' => false, 
					'multiple' => false,
					'required' => false,
					'data' => $groupId, // Pour mettre la valeur contenue dans l'objet en édition
					'mapped' => false  // ce champ n'est pas mis en correspondance avec la propriété de l'objet
				))
				->add('imgPath', FileType::class, array(
					'label' => "Avatar", // Label du champ sur le formulaire
					'required' => false, // L'upload de fichier n'est pas obligatoire
					'data_class'  => null
				))
				;

		if ($options["mode"] == "ajout"){
				$builder->add('chkbox', CheckBoxType::class, array(
					'label'    => "Cochez cette case si le membre ne fait pas partie d'un groupe",
					'required' => false,
					'mapped' => false
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
					'required' => false,
					'mapped' => false  // ce champ n'est pas mis en correspondance avec la propriété de l'objet
				));
		}
	}

	public function getName() {
		return 'user';
	}

}
