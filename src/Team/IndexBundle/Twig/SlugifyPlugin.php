<?php
namespace IndexBundle\Twig;

class SlugifyPlugin extends BasePlugin
{
    public function getName()
    {
        return Craft::t('Slugify Twig Extension');
    }
    
    public function getVersion()
    {
        return '1.0';
    }
    
    public function getDeveloper()
    {
        return 'Bob Olde Hampsink';
    }
    
    public function getDeveloperUrl()
    {
        return 'http://www.itmundi.nl';
    }
    
    public function hookAddTwigExtension()
    {
        Craft::import('plugins.slugify.twigextensions.SlugifyTwigExtension');
        
        return new SlugifyTwigExtension();
    }
}
