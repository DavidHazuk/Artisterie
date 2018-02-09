<?php

namespace Artisterie\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\FileType;


/**
 * Description of NewsType
 *
 * @author étudiant
 */
class NewsType extends AbstractType {

	// Pour indiquer que le tableau d'options passé à l'appel de buildForm
	// contient aussi une option nommée "groups"
	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults([
				'imgRequired' => "",
			]);
	}		
	
	public function buildForm(FormBuilderInterface $builder, array $options) {
		
		$builder
				->add('title', TextType::class, array(
                    'label'       => "Titre",
                    'required'    => true,
                    'constraints' => array(new Assert\NotBlank(), new Assert\Length(array(
					'min'        => 5,
					'max'        => 70,
					'minMessage' => 'Le titre doit être supérieur à {{ limit }} caractères',
					'maxMessage' => 'Le titre ne doit pas dépasser {{ limit }} caractères',
					)))
                ))
				->add('content', TextareaType::class, array(
					'attr'        => array('rows' => '8'),
                    'label'       => "Contenu",
                    'required'    => true,
                    'constraints' => new Assert\NotBlank(),
                ))
				->add('imgPath', FileType::class, array(
                    'label' => "Image d'illustration", // Label du champ sur le formulaire
                    'required' => $options["imgRequired"], // L'upload de fichier est obligatoire vu qu'on récupère l'image de la news pour le slider
                    'data_class'  => null
                ));
	}	
	
}
