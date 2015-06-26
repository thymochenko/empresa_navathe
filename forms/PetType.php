<?php

/**
 * Description of PetType
 *
 * @author thymo
 */

namespace DomainLayer\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class PetType extends AbstractType {

    //put your code here
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('nome', 'text', ['constraints' => [new Assert\NotBlank(), new Assert\Length(['min' => 5])]])
        ->add('owner', 'text', ['constraints' => [new Assert\NotBlank(), new Assert\Length(['min' => 5])]])
        ->add('species', 'text', ['constraints' => [new Assert\NotBlank(), new Assert\Length(['min' => 5])]])
        ->add('sex', 'choice', ['choices' =>
        [1 => 'masc', 2 => 'fem'], 'expanded' => true, 'constraints' => [new Assert\Choice([1, 2])]])
        ->add('birth', 'datetime');
    }
    
    public function getName() {
        return 'pet';
    }

}
