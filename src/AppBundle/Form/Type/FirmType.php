<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FirmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('firmName', 'text', array('label' => 'form.firmName'))
			->add('summary', 'text', array('label' => 'form.summary'))
			->add('save', 'submit', array('label' => 'form.save', 'attr' => array('class'=>'btn-large')));
    }

    public function getName()
    {
        return 'dEntry';
    }
}
?>