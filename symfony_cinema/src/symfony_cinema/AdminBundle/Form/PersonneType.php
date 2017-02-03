<?php
// src/symfony_cinema/AdminBundle/Form/FilmType.php
namespace symfony_cinema\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class PersonneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('date_de_naissance', DateType::class, array('years' => range('1800','2017')))
            ->add('description')

            ->add('save', SubmitType::class, array('label' => 'Enregistrer'))
        ;
    }
}