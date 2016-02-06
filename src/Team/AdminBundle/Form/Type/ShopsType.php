<?php

namespace Team\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ShopsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder->add('shopName', 'text', 
                    array('label' => false))
                ->add('picRef', 'text', 
                    array('label' => false))
                ->add('provisionTb', 'integer', 
                    array('label' => false))
                ->add('provisionTeams', 'integer', 
                    array('label' => false))
                ->add('linkRef', 'text', 
                    array('label' => false))
                ->add('save', 'submit', 
                    array('label' => 'Speichern'));
  
        
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Team\IndexBundle\Entity\ArxfShops',
        ));
    }

    public function getName()
    {
        return 'shops';
    }
}
