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
        $sSubinfo = 'For Example (without quotation Marks) Colors like "#421188", or words like "primary" "secondary" "gray" "golden" "gold" "info" "notice" "success" "positive" "error" "warning" "blue" "green" "red" "yellow" "purple" "orange" "gold"';
        // Return the Attributes as Array
        return [
            [ 'name' => 'coha_badges_1_active',                    'type' => 'boolean',             'label' => 'Badge 1', ],
            [ 'name' => 'coha_badges_1_text',                      'type' => 'string',             'label' => 'Badge 1: Text', ],
            [ 'name' => 'coha_badges_1_color',                     'type' => 'string',             'label' => 'Badge 1: Color', 'supportText' => $sSubinfo ],
            
            [ 'name' => 'coha_badges_2_active',                    'type' => 'boolean',             'label' => 'Badge 2', ],
            [ 'name' => 'coha_badges_2_text',                      'type' => 'string',             'label' => 'Badge 2: Text', ],
            [ 'name' => 'coha_badges_2_color',                     'type' => 'string',             'label' => 'Badge 2: Color', 'supportText' => $sSubinfo ],

            [ 'name' => 'coha_badges_3_active',                    'type' => 'boolean',             'label' => 'Badge 3', ],
            [ 'name' => 'coha_badges_3_text',                      'type' => 'string',             'label' => 'Badge 3: Text', ],
            [ 'name' => 'coha_badges_3_color',                     'type' => 'string',             'label' => 'Badge 3: Color', 'supportText' => $sSubinfo ],
            
            [ 'name' => 'coha_badges_4_active',                    'type' => 'boolean',             'label' => 'Badge 4', ],
            [ 'name' => 'coha_badges_4_text',                      'type' => 'string',             'label' => 'Badge 4: Text', ],
            [ 'name' => 'coha_badges_4_color',                     'type' => 'string',             'label' => 'Badge 4: Color', 'supportText' => $sSubinfo ],
            
            [ 'name' => 'coha_badges_5_active',                    'type' => 'boolean',             'label' => 'Badge 5', ],
            [ 'name' => 'coha_badges_5_text',                      'type' => 'string',             'label' => 'Badge 5: Text', ],
            [ 'name' => 'coha_badges_5_color',                     'type' => 'string',             'label' => 'Badge 5: Color', 'supportText' => $sSubinfo ],
            
            [ 'name' => 'coha_badges_6_active',                    'type' => 'boolean',             'label' => 'Badge 6', ],
            [ 'name' => 'coha_badges_6_text',                      'type' => 'string',             'label' => 'Badge 6: Text', ],
            [ 'name' => 'coha_badges_6_color',                     'type' => 'string',             'label' => 'Badge 6: Color', 'supportText' => $sSubinfo ],

            [ 'name' => 'coha_badges_7_active',                    'type' => 'boolean',             'label' => 'Badge 7', ],
            [ 'name' => 'coha_badges_7_text',                      'type' => 'string',             'label' => 'Badge 7: Text', ],
            [ 'name' => 'coha_badges_7_color',                     'type' => 'string',             'label' => 'Badge 7: Color', 'supportText' => $sSubinfo ],

            [ 'name' => 'coha_badges_8_active',                    'type' => 'boolean',             'label' => 'Badge 8', ],
            [ 'name' => 'coha_badges_8_text',                      'type' => 'string',             'label' => 'Badge 8: Text', ],
            [ 'name' => 'coha_badges_8_color',                     'type' => 'string',             'label' => 'Badge 8: Color', 'supportText' => $sSubinfo ],

            [ 'name' => 'coha_badges_9_active',                    'type' => 'boolean',             'label' => 'Badge 9', ],
            [ 'name' => 'coha_badges_9_text',                      'type' => 'string',             'label' => 'Badge 9: Text', ],
            [ 'name' => 'coha_badges_9_color',                     'type' => 'string',             'label' => 'Badge 9: Color', 'supportText' => $sSubinfo ],

            [ 'name' => 'coha_badges_10_active',                   'type' => 'boolean',             'label' => 'Badge 10', ],
            [ 'name' => 'coha_badges_10_text',                     'type' => 'string',             'label' => 'Badge 10: Text', ],
            [ 'name' => 'coha_badges_10_color',                    'type' => 'string',             'label' => 'Badge 10: Color', 'supportText' => $sSubinfo ],
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
            $aAdvanced = $aAttribute;
            $aAdvanced['label']                     = $aAttribute['label'] ?? '';
            $aAdvanced['translatable']              = $aAttribute['translatable'] ?? true;
            $aAdvanced['displayInBackend']          = $aAttribute['displayInBackend'] ?? true;
            $aAdvanced['custom']                    = $aAttribute['custom'] ?? true;
            $aAdvanced['position']                  = ($i + 250);

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
                __DIR__ . '/Resources/views/frontend/_public/src/less/badges.less',
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
