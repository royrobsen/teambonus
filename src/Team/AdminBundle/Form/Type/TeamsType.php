<?php

namespace Team\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TeamsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder->add('teamName', 'text', 
                    array('label' => false))
                ->add('apFirst', 'text', 
                    array('label' => false))
                ->add('apLast', 'text', 
                    array('label' => false))
                ->add('apMail', 'text', 
                    array('label' => false))
                ->add('aboutTeam', 'textarea', 
                    array('label' => false, 'required' => false))
                ->add('iban', 'text', 
                    array('label' => false, 'required' => false))
                ->add('blz', 'text', 
                    array('label' => false, 'required' => false))
                ->add('accNo', 'text', 
                    array('label' => false, 'required' => false))
                ->add('bankName', 'text', 
                    array('label' => false, 'required' => false))
                ->add('website', 'text', 
                    array('label' => false, 'required' => false))
                ->add('apPhone', 'text', 
                    array('label' => false, 'required' => false))
                ->add('bic', 'text', 
                    array('label' => false, 'required' => false))
                ->add('accOwner', 'text', 
                    array('label' => false, 'required' => false))
                ->add('save', 'submit', 
                    array('label' => 'Speichern'));
  
        
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Team\IndexBundle\Entity\ArxfTeams',
        ));
    }

    public function getName()
    {
        return 'teams';
    }
}
