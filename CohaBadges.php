<?php 

namespace CohaBadges;

use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\Common\Collections\ArrayCollection;
use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\InstallContext;
use Shopware\Components\Plugin\Context\UpdateContext;
use Shopware\Components\Plugin\Context\UninstallContext;
use Shopware\Components\Theme\LessDefinition;
use Shopware\Components\Plugin\Context\ActivateContext;

class CohaBadges extends Plugin
{

    public function getAttributes()
    {
        $sTmpHelpText = 'For Example (without quotation Marks) "primary" "secondary" "grey" "blue" "green" "red" "yellow" "purple" "orange" "gold" or Color like "#421188"';
        // Return the Attributes as Array
        return [
            [ 'name' => 'coha_badges_1_text',                      'type' => 'string',             'label' => 'Badged 1: Text', ],
            [ 'name' => 'coha_badges_1_color',                     'type' => 'string',             'label' => 'Badged 1: Color', 'helpText' => 'For Example (without quotation Marks) "primary" "secondary" "grey" "blue" "green" "red" "yellow" "purple" "orange" "gold" or Color like "#421188"' ],
            
            [ 'name' => 'coha_badges_2_text',                      'type' => 'string',             'label' => 'Badged 2: Text', ],
            [ 'name' => 'coha_badges_2_color',                     'type' => 'string',             'label' => 'Badged 2: Color', 'helpText' => $sTmpHelpText ],

            [ 'name' => 'coha_badges_3_text',                      'type' => 'string',             'label' => 'Badged 3: Text', ],
            [ 'name' => 'coha_badges_3_color',                     'type' => 'string',             'label' => 'Badged 3: Color', 'helpText' => $sTmpHelpText ],
            
            [ 'name' => 'coha_badges_4_text',                      'type' => 'string',             'label' => 'Badged 4: Text', ],
            [ 'name' => 'coha_badges_4_color',                     'type' => 'string',             'label' => 'Badged 4: Color', 'helpText' => $sTmpHelpText ],
            
            [ 'name' => 'coha_badges_5_text',                      'type' => 'string',             'label' => 'Badged 5: Text', ],
            [ 'name' => 'coha_badges_5_color',                     'type' => 'string',             'label' => 'Badged 5: Color', 'helpText' => $sTmpHelpText ],
            
            [ 'name' => 'coha_badges_6_text',                      'type' => 'string',             'label' => 'Badged 6: Text', ],
            [ 'name' => 'coha_badges_6_color',                     'type' => 'string',             'label' => 'Badged 6: Color', 'helpText' => $sTmpHelpText ],
        ];
    }



    public function install(InstallContext $context)
    {
        // Get variables
        $service        = $this->container->get('shopware_attribute.crud_service');
        $aAttributes    = $this->getAttributes();

        for ($i=0; $i < count($aAttributes); $i++)
        { 
            // Set Attribute
            $aAttribute = $aAttributes[$i];

            // Collect Advanced Array
            $aAdvanced = [];
            $aAdvanced['label']                     = $aAttribute['label'] ?? '';
            $aAdvanced['translatable']              = $aAttribute['translatable'] ?? true;
            $aAdvanced['displayInBackend']          = $aAttribute['displayInBackend'] ?? true;
            $aAdvanced['helpText']                  = $aAttribute['helpText'] ?? true;
            $aAdvanced['custom']                    = $aAttribute['custom'] ?? true;
            $aAdvanced['position']                  = ($i + 75);

            $service->update(
                's_articles_attributes',
                $aAttribute['name'],
                $aAttribute['type'],
                $aAdvanced
            );
        }
    }


    public function update(UpdateContext $context) {
        $service = $this->container->get('shopware_attribute.crud_service');

        // $context->scheduleClearCache(ActivateContext::CACHE_LIST_ALL);

    }

    // On Activation
    public function activate(ActivateContext $context)
    {
        $context->scheduleClearCache(ActivateContext::CACHE_LIST_ALL);
    }

    public function uninstall(UninstallContext $context)
    {
        // Get variables
        $service = $this->container->get('shopware_attribute.crud_service');
        $aAttributes    = $this->getAttributes();

        // Delete The Fields Fields
        for ($i=0; $i < count($aAttributes); $i++)
        { 
            // Set Attribute
            $aAttribute = $aAttributes[$i];

            // Delete Attribute
            $service->delete(
                's_articles_attributes',
                $aAttribute['name']
            );
        }
        
    }

    public function addLessFiles(){
        return new LessDefinition(
            [],
            [
                // __DIR__ . '/Resources/views/frontend/_public/src/less/quoteslider.less',
            ]
        );
    }

    public function onCollectJavascriptFiles()
    {
        $jsFiles = [
            // $this->getPath() . '/Resources/views/frontend/_public/ [...] .js',
        ];
        return new ArrayCollection($jsFiles);
    }

    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Action_PreDispatch_Frontend' => ['onFrontend',-100],
            'Enlight_Controller_Action_PreDispatch_Widgets' => ['onFrontend',-100],
            'Theme_Compiler_Collect_Plugin_Less' => 'addLessFiles',
            'Theme_Compiler_Collect_Plugin_Javascript' => 'onCollectJavascriptFiles',
        ];
    }

    /**
     * @param \Enlight_Event_EventArgs $args
     * @throws \Exception
     */
    public function onFrontend(\Enlight_Event_EventArgs $args)
    {
        $this->container->get('Template')->addTemplateDir(
            $this->getPath() . '/Resources/views/'
        );
    }

}
