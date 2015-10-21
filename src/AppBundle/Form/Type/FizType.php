<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FizType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('firstName', 'text', array('label' => 'form.firstName'))
			->add('lastName', 'text', array('label' => 'form.lastName'))
			->add('middleName', 'text', array('label' => 'form.middleName'))
			->add('birthDate', 'date', array(
					'widget' => 'single_text',
					'label' => 'form.birthDate',
					'format' => 'yyyy-MM-dd',
				))
			->add('summary', 'text', array('label' => 'form.summary'))
			->add('save', 'submit', array('label' => 'form.save', 'attr' => array('class'=>'btn-large')));
    }

    public function getName()
    {
        return 'dEntry';
    }
}
?>