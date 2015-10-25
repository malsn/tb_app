<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use AppBundle\Entity\Section;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('name', 'text', array('label' => 'form.name',
                'attr' => array('class' => 's_name')))
            ->add('alias', 'text', array('label' => 'form.alias',
                'attr' => array('class' => 's_alias')))
            ->add('active', 'checkbox', array('label' => 'form.active', 'required' => true ))
            ->add('path', 'text', array('label' => 'form.path'))
            ->add('save', 'submit', array('label' => 'form.save', 'attr' => array('class'=>'btn-large')));
    }

    public function getName()
    {
        return 'Section';
    }
}
?>