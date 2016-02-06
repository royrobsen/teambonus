<?php
namespace IndexBundle\Twig;

class SlugifyTwigExtension extends \Twig_Extension
{
    protected $env;
    
    public function getName()
    {
        return 'Slugify Twig Extension';
    }
    
    public function getFilters()
    {
        return array('slugify' => new \Twig_Filter_Method($this, 'slugify'));
    }
    
    public function getFunctions()
    {
        return array('slugify' => new \Twig_Function_Method($this, 'slugify'));
    }
    
    public function initRuntime(\Twig_Environment $env)
    {
        $this->env = $env;
    }
    
    public function slugify($slug)
    {
        // Remove HTML tags
        $slug = preg_replace('/<(.*?)>/u', '', $slug);
        
        // Remove inner-word punctuation.
        $slug = preg_replace('/[\'"‘’“”]/u', '', $slug);
        
        // Make it lowercase
        $slug = mb_strtolower($slug, 'UTF-8');
        
        // Get the "words".  Split on anything that is not a unicode letter or number.
        // Periods are OK too.
        preg_match_all('/[\p{L}\p{N}\.]+/u', $slug, $words);
        $words = ArrayHelper::filterEmptyStringsFromArray($words[0]);
        $slug = implode('-', $words);
        
        return $slug;
    }
}
