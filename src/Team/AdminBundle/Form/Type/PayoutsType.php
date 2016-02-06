<?php

namespace Team\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PayoutsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder->add('state', 'text', 
                    array('label' => false))
                ->add('save', 'submit', 
                    array('label' => 'Speichern'));
  
        
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Team\IndexBundle\Entity\ArxfPayout',
        ));
    }

    public function getName()
    {
        return 'payouts';
    }
}
