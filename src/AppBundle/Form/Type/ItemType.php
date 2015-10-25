<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('name', 'text', array('label' => 'form.name'))
			->add('save', 'submit', array('label' => 'form.save', 'attr' => array('class'=>'btn-large')));
    }

    public function getName()
    {
        return 'Item';
    }
}
?>