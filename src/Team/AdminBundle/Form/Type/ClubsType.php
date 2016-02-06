<?php

namespace Team\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClubsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder->add('clubName', 'text', 
                    array('label' => false))
                ->add('attachment', 'file', 
                    array('label' => false, 'required' => false))
                ->add('save', 'submit', 
                    array('label' => 'Speichern'));
  
        
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Team\IndexBundle\Entity\ArxfClubs',
        ));
    }

    public function getName()
    {
        return 'clubs';
    }
}
