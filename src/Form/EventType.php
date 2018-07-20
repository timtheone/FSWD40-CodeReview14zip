<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('start_date', null, [
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker', 'autocomplete' => 'off', 'placeholder' => '2018-06-01'],
                'format' => 'yyyy-mm-dd',
                'html5' => false
            ])
            ->add('end_date', null, [
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker', 'autocomplete' => 'off', 'placeholder' => '2018-06-01'],
                'format' => 'yyyy-mm-dd',
                'html5' => false
            ])
            ->add('description')
            ->add('image')
            ->add('capacity')
            ->add('email')
            ->add('phone_number')
            ->add('address')
            ->add('url')
            ->add('type', ChoiceType::class , array('choices'=>array('Music'=>'Music', 'Sport'=>'Sport', 'Movie'=>'Movie', 'Theater'=>'Theater'),'attr' => array('class'=> 'form-control')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
            'attr' => array('class' => 'form-group'),
        ]);
    }
}
