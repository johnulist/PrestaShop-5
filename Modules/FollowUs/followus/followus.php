<?php
/*
 * Title: FollowUs
 * Description: A PrestaShop module that displays social media icons. Over 20 social media platforms are currently supported.
 * Author: Carl Sparks (TWiST3DSOFT)
 * Mail: mail@carldsparks.com
 * Skype: nagantarov
 * Source: https://github.com/twist3dsoft/
 * License: GPLv3
 * Last Updated: 6/30/2014
 * Tested on PrestaShop 1.6.0.7
*/

if(!defined('_PS_VERSION_')){
    exit;
}

class followus extends Module{
    
    public function __construct(){
        $this->name = "followus";
        $this->tab = "front_office_features";
        $this->version = "1.0";
        $this->author = "Carl Sparks";
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array("min" => "1.5", "max" => "1.7");
        
        // Create an array to contain the smarty variable name and Configuration value
        $socialPlatforms = array( 
                array('var' => 'followus_name', 'val' => 'FOLLOWUS_NAME'),
                array('var' => 'followus_twitter_link', 'val' => 'FOLLOWUS_TWITTER_LINK'),
                array('var' => 'followus_fb_link', 'val' => 'FOLLOWUS_FB_LINK'),
                array('var' => 'followus_appstore_link', 'val' => 'FOLLOWUS_APPSTORE_LINK'),
                array('var' => 'followus_cloud_link', 'val' => 'FOLLOWUS_CLOUD_LINK'),
                array('var' => 'followus_gplus_link', 'val' => 'FOLLOWUS_GPLUS_LINK'),
                array('var' => 'followus_instagram_link', 'val' => 'FOLLOWUS_INSTAGRAM_LINK'),
                array('var' => 'followus_itunes_link', 'val' => 'FOLLOWUS_ITUNES_LINK'),
                array('var' => 'followus_lin_link', 'val' => 'FOLLOWUS_LIN_LINK'),
                array('var' => 'followus_location_link', 'val' => 'FOLLOWUS_LOCATION_LINK'),
                array('var' => 'followus_mail_link', 'val' => 'FOLLOWUS_MAIL_LINK'),
                array('var' => 'followus_path_link', 'val' => 'FOLLOWUS_PATH_LINK'),
                array('var' => 'followus_pinterest_link', 'val' => 'FOLLOWUS_PINTEREST_LINK'),
                array('var' => 'followus_pstation_link', 'val' => 'FOLLOWUS_PSTATION_LINK'),
                array('var' => 'followus_pstore_link', 'val' => 'FOLLOWUS_PSTORE_LINK'),
                array('var' => 'followus_skype_link', 'val' => 'FOLLOWUS_SKYPE_LINK'),
                array('var' => 'followus_spotify_link', 'val' => 'FOLLOWUS_SPOTIFY_LINK'),
                array('var' => 'followus_steam_link', 'val' => 'FOLLOWUS_STEAM_LINK'),
                array('var' => 'followus_whatsapp_link', 'val' => 'FOLLOWUS_WHATSAPP_LINK'),
                array('var' => 'followus_wstore_link', 'val' => 'FOLLOWUS_WSTORE_LINK'),
                array('var' => 'followus_wpress_link', 'val' => 'FOLLOWUS_WPRESS_LINK'),
                array('var' => 'followus_youtube_link', 'val' => 'FOLLOWUS_YOUTUBE_LINK')
            );
        
        parent::__construct();
        
        $this->displayName = $this->l("Follow Us");
        $this->description = $this->l("A customizable social media block.");
        
        $this->confirmUninstall = $this->l("Have you thought this through? Are you sure you want to uninstall?");
        
        if(!Configuration::get("FOLLOWUS_NAME")){
            $this->warning = $this->l("No name provided");
        }
    }
    
    public function install(){
        if(Shop::isFeatureActive()){
            Shop::setContext(Shop::CONTEXT_ALL);
        }
        
        foreach($socialPlatforms as $value){
            Configuration::updateValue($value[1], '');
        }
        
        return parent::install() &&
            $this->registerHook('leftColumn') &&
            $this->registerHook('header');
    }
    
    public function uninstall(){
        return parent::uninstall() && Configuration::deleteByName('FOLLOWUS_NAME');
    }
    
    public function hookDisplayLeftColumn($params){
        $this->context->smarty->assign(
            array(
                 'followus_name' => Configuration::get('FOLLOWUS_NAME'),
                'followus_twitter_link' => Configuration::get('FOLLOWUS_TWITTER_LINK'),
                'followus_fb_link' => Configuration::get('FOLLOWUS_FB_LINK'),
                'followus_appstore_link' => Configuration::get('FOLLOWUS_APPSTORE_LINK'),
                'followus_cloud_link' => Configuration::get('FOLLOWUS_CLOUD_LINK'),
                'followus_gplus_link' => Configuration::get('FOLLOWUS_GPLUS_LINK'),
                'followus_instagram_link' => Configuration::get('FOLLOWUS_INSTAGRAM_LINK'),
                'followus_itunes_link' => Configuration::get('FOLLOWUS_ITUNES_LINK'),
                'followus_lin_link' => Configuration::get('FOLLOWUS_LIN_LINK'),
                'followus_location_link' => Configuration::get('FOLLOWUS_LOCATION_LINK'),
                'followus_mail_link' => Configuration::get('FOLLOWUS_MAIL_LINK'),
                'followus_path_link' => Configuration::get('FOLLOWUS_PATH_LINK'),
                'followus_pinterest_link' => Configuration::get('FOLLOWUS_PINTEREST_LINK'),
                'followus_pstation_link' => Configuration::get('FOLLOWUS_PSTATION_LINK'),
                'followus_pstore_link' => Configuration::get('FOLLOWUS_PSTORE_LINK'),
                'followus_skype_link' => Configuration::get('FOLLOWUS_SKYPE_LINK'),
                'followus_spotify_link' => Configuration::get('FOLLOWUS_SPOTIFY_LINK'),
                'followus_steam_link' => Configuration::get('FOLLOWUS_STEAM_LINK'),
                'followus_whatsapp_link' => Configuration::get('FOLLOWUS_WHATSAPP_LINK'),
                'followus_wstore_link' => Configuration::get('FOLLOWUS_WSTORE_LINK'),
                'followus_wpress_link' => Configuration::get('FOLLOWUS_WPRESS_LINK'),
                'followus_youtube_link' => Configuration::get('FOLLOWUS_YOUTUBE_LINK'),
                'followus_link' => $this->context->link->getModuleLink('followus', 'display')
            )
        );
        return $this->display(__FILE__, 'followus.tpl');
    }
    
    public function hookDisplayRightColumn($params){
        return $this->hookDisplayLeftColumn($params);
    }
    
    public function hookFooter($params){
        $this->context->smarty->assign(
            array(
                'followus_name' => Configuration::get('FOLLOWUS_NAME'),
                'followus_twitter_link' => Configuration::get('FOLLOWUS_TWITTER_LINK'),
                'followus_fb_link' => Configuration::get('FOLLOWUS_FB_LINK'),
                'followus_appstore_link' => Configuration::get('FOLLOWUS_APPSTORE_LINK'),
                'followus_cloud_link' => Configuration::get('FOLLOWUS_CLOUD_LINK'),
                'followus_gplus_link' => Configuration::get('FOLLOWUS_GPLUS_LINK'),
                'followus_instagram_link' => Configuration::get('FOLLOWUS_INSTAGRAM_LINK'),
                'followus_itunes_link' => Configuration::get('FOLLOWUS_ITUNES_LINK'),
                'followus_lin_link' => Configuration::get('FOLLOWUS_LIN_LINK'),
                'followus_location_link' => Configuration::get('FOLLOWUS_LOCATION_LINK'),
                'followus_mail_link' => Configuration::get('FOLLOWUS_MAIL_LINK'),
                'followus_path_link' => Configuration::get('FOLLOWUS_PATH_LINK'),
                'followus_pinterest_link' => Configuration::get('FOLLOWUS_PINTEREST_LINK'),
                'followus_pstation_link' => Configuration::get('FOLLOWUS_PSTATION_LINK'),
                'followus_pstore_link' => Configuration::get('FOLLOWUS_PSTORE_LINK'),
                'followus_skype_link' => Configuration::get('FOLLOWUS_SKYPE_LINK'),
                'followus_spotify_link' => Configuration::get('FOLLOWUS_SPOTIFY_LINK'),
                'followus_steam_link' => Configuration::get('FOLLOWUS_STEAM_LINK'),
                'followus_whatsapp_link' => Configuration::get('FOLLOWUS_WHATSAPP_LINK'),
                'followus_wstore_link' => Configuration::get('FOLLOWUS_WSTORE_LINK'),
                'followus_wpress_link' => Configuration::get('FOLLOWUS_WPRESS_LINK'),
                'followus_youtube_link' => Configuration::get('FOLLOWUS_YOUTUBE_LINK'),
                'followus_link' => $this->context->link->getModuleLink('followus', 'display')
            )
        );
        return $this->display(__FILE__, 'followus.tpl');
    }
    
    public function hookDisplayHeader(){
        $this->context->controller->addCSS($this->_path.'css/followus.css', 'all');
    }
    
    public function getContent(){
        $errorFlag = false;
        $output = null;
        
        if(Tools::isSubmit('submit'.$this->name)){
            $twitter_link = strval(Tools::getValue('FOLLOWUS_TWITTER_LINK'));
            $fb_link = strval(Tools::getValue('FOLLOWUS_FB_LINK'));
            $appstore_link = strval(Tools::getValue('FOLLOWUS_APPSTORE_LINK'));
            $cloud_link = strval(Tools::getValue('FOLLOWUS_CLOUD_LINK'));
            $gplus_link = strval(Tools::getValue('FOLLOWUS_GPLUS_LINK'));
            $instagram_link = strval(Tools::getValue('FOLLOWUS_INSTAGRAM_LINK'));
            $itunes_link = strval(Tools::getValue('FOLLOWUS_ITUNES_LINK'));
            $lin_link = strval(Tools::getValue('FOLLOWUS_LIN_LINK'));
            $location_link = strval(Tools::getValue('FOLLOWUS_LOCATION_LINK'));
            $mail_link = strval(Tools::getValue('FOLLOWUS_MAIL_LINK'));
            $path_link = strval(Tools::getValue('FOLLOWUS_PATH_LINK'));
            $pinterest_link = strval(Tools::getValue('FOLLOWUS_PINTEREST_LINK'));
            $pstation_link = strval(Tools::getValue('FOLLOWUS_PSTATION_LINK'));
            $pstore_link = strval(Tools::getValue('FOLLOWUS_PSTORE_LINK'));
            $skype_link = strval(Tools::getValue('FOLLOWUS_SKYPE_LINK'));
            $spotify_link = strval(Tools::getValue('FOLLOWUS_SPOTIFY_LINK'));
            $steam_link = strval(Tools::getValue('FOLLOWUS_STEAM_LINK'));
            $whatsapp_link = strval(Tools::getValue('FOLLOWUS_WHATSAPP_LINK'));
            $wstore_link = strval(Tools::getValue('FOLLOWUS_WSTORE_LINK'));
            $wpress_link = strval(Tools::getValue('FOLLOWUS_WPRESS_LINK'));
            $youtube_link = strval(Tools::getValue('FOLLOWUS_YOUTUBE_LINK'));
            
            /*
            THIS BLOCK IS BAD. PLEASE REFACTOR THIS
            */
            if(!Validate::isGenericName($twitter_link)){
                $errorFlag = true;
            } else {
                Configuration::updateValue('FOLLOWUS_TWITTER_LINK', $twitter_link);
                $errorFlag = false;
            }
            
            if(!Validate::isGenericName($fb_link)){
                $errorFlag = true;
            } else {
                Configuration::updateValue('FOLLOWUS_FB_LINK', $fb_link);
                $errorFlag = false;
            }
            
            if(!Validate::isGenericName($appstore_link)){
                $errorFlag = true;
            } else {
                Configuration::updateValue('FOLLOWUS_APPSTORE_LINK', $appstore_link);
                $errorFlag = false;
            }
            
            if(!Validate::isGenericName($cloud_link)){
                $errorFlag = true;
            } else {
                Configuration::updateValue('FOLLOWUS_CLOUD_LINK', $cloud_link);
                $errorFlag = false;
            }
            
            if(!Validate::isGenericName($gplus_link)){
                $errorFlag = true;
            } else {
                Configuration::updateValue('FOLLOWUS_GPLUS_LINK', $gplus_link);
                $errorFlag = false;
            }
            
            if(!Validate::isGenericName($instagram_link)){
                $errorFlag = true;
            } else {
                Configuration::updateValue('FOLLOWUS_INSTAGRAM_LINK', $instagram_link);
                $errorFlag = false;
            }
            
            if(!Validate::isGenericName($itunes_link)){
                $errorFlag = true;
            } else {
                Configuration::updateValue('FOLLOWUS_ITUNES_LINK', $itunes_link);
                $errorFlag = false;
            }
            
            if(!Validate::isGenericName($lin_link)){
                $errorFlag = true;
            } else {
                Configuration::updateValue('FOLLOWUS_LIN_LINK', $lin_link);
                $errorFlag = false;
            }
            
            if(!Validate::isGenericName($location_link)){
                $errorFlag = true;
            } else {
                Configuration::updateValue('FOLLOWUS_LOCATION_LINK', $location_link);
                $errorFlag = false;
            }
            
            if(!Validate::isGenericName($mail_link)){
                $errorFlag = true;
            } else {
                Configuration::updateValue('FOLLOWUS_MAIL_LINK', $mail_link);
                $errorFlag = false;
            }
            
            if(!Validate::isGenericName($path_link)){
                $errorFlag = true;
            } else {
                Configuration::updateValue('FOLLOWUS_PATH_LINK', $path_link);
                $errorFlag = false;
            }
            
            if(!Validate::isGenericName($pinterest_link)){
                $errorFlag = true;
            } else {
                Configuration::updateValue('FOLLOWUS_PINTEREST_LINK', $pinterest_link);
                $errorFlag = false;
            }
            
            if(!Validate::isGenericName($pstation_link)){
                $errorFlag = true;
            } else {
                Configuration::updateValue('FOLLOWUS_PSTATION_LINK', $pstation_link);
                $errorFlag = false;
            }
            
            if(!Validate::isGenericName($pstore_link)){
                $errorFlag = true;
            } else {
                Configuration::updateValue('FOLLOWUS_PSTORE_LINK', $pstore_link);
                $errorFlag = false;
            }
            
            if(!Validate::isGenericName($skype_link)){
                $errorFlag = true;
            } else {
                Configuration::updateValue('FOLLOWUS_SKYPE_LINK', $skype_link);
                $errorFlag = false;
            }
            
            if(!Validate::isGenericName($spotify_link)){
                $errorFlag = true;
            } else {
                Configuration::updateValue('FOLLOWUS_SPOTIFY_LINK', $spotify_link);
                $errorFlag = false;
            }
            
            if(!Validate::isGenericName($steam_link)){
                $errorFlag = true;
            } else {
                Configuration::updateValue('FOLLOWUS_STEAM_LINK', $steam_link);
                $errorFlag = false;
            }
            
            if(!Validate::isGenericName($whatsapp_link)){
                $errorFlag = true;
            } else {
                Configuration::updateValue('FOLLOWUS_WHATSAPP_LINK', $whatsapp_link);
                $errorFlag = false;
            }
            
            if(!Validate::isGenericName($wstore_link)){
                $errorFlag = true;
            } else {
                Configuration::updateValue('FOLLOWUS_WSTORE_LINK', $wstore_link);
                $errorFlag = false;
            }
            
            if(!Validate::isGenericName($wpress_link)){
                $errorFlag = true;
            } else {
                Configuration::updateValue('FOLLOWUS_WPRESS_LINK', $wpress_link);
                $errorFlag = false;
            }
            
            if(!Validate::isGenericName($youtube_link)){
                $errorFlag = true;
            } else {
                Configuration::updateValue('FOLLOWUS_YOUTUBE_LINK', $youtube_link);
                $errorFlag = false;
            }
            
            if($errorFlag){
                $output .= $this->displayError( $this->l('Invalid Configuration Value'));
            } else {
                $output .= $this->displayConfirmation($this->l('Settings updated'));
            }
            /*
            WHAT!? YOU'RE JUST GOING TO LEAVE ME LIKE THIS? DO YOU SEE WHAT I HAVE TO PUT UP WITH^ LOOK AT IT. CMON MAN. YOU'RE BAD
            */
        }
        return $output.$this->displayForm();
    }
    
    public function displayForm(){
        // Get default Language
        $default_lang = (int)Configuration::get('PS_LANG_DEFAULT');
     
        // Init Fields form array
        $fields_form[0]['form'] = array(
            'legend' => array(
                'title' => $this->l('Settings'),
            ),
            'input' => array(
                array(
                    'type' => 'text',
                    'label' => $this->l('Facebook URL'),
                    'name' => 'FOLLOWUS_FB_LINK',
                    'size' => 30,
                    'required' => false
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('App Store URL'),
                    'name' => 'FOLLOWUS_APPSTORE_LINK',
                    'size' => 30,
                    'required' => false
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Cloud URL'),
                    'name' => 'FOLLOWUS_CLOUD_LINK',
                    'size' => 30,
                    'required' => false
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Google Plus URL'),
                    'name' => 'FOLLOWUS_GPLUS_LINK',
                    'size' => 30,
                    'required' => false
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Instagram URL'),
                    'name' => 'FOLLOWUS_INSTAGRAM_LINK',
                    'size' => 30,
                    'required' => false
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Itunes URL'),
                    'name' => 'FOLLOWUS_ITUNES_LINK',
                    'size' => 30,
                    'required' => false
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('LinkedIn URL'),
                    'name' => 'FOLLOWUS_LIN_LINK',
                    'size' => 30,
                    'required' => false
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Location URL'),
                    'name' => 'FOLLOWUS_LOCATION_LINK',
                    'size' => 30,
                    'required' => false
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Mail URL'),
                    'name' => 'FOLLOWUS_MAIL_LINK',
                    'size' => 30,
                    'required' => false
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Path URL'),
                    'name' => 'FOLLOWUS_PATH_LINK',
                    'size' => 30,
                    'required' => false
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Pinterest URL'),
                    'name' => 'FOLLOWUS_PINTEREST_LINK',
                    'size' => 30,
                    'required' => false
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Playstation URL'),
                    'name' => 'FOLLOWUS_PSTATION_LINK',
                    'size' => 30,
                    'required' => false
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Play Store URL'),
                    'name' => 'FOLLOWUS_PSTORE_LINK',
                    'size' => 30,
                    'required' => false
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Skype URL'),
                    'name' => 'FOLLOWUS_SKYPE_LINK',
                    'size' => 30,
                    'required' => false
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Spotify URL'),
                    'name' => 'FOLLOWUS_SPOTIFY_LINK',
                    'size' => 30,
                    'required' => false
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Steam URL'),
                    'name' => 'FOLLOWUS_STEAM_LINK',
                    'size' => 30,
                    'required' => false
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('WhatsApp URL'),
                    'name' => 'FOLLOWUS_WHATSAPP_LINK',
                    'size' => 30,
                    'required' => false
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Windows Store URL'),
                    'name' => 'FOLLOWUS_WSTORE_LINK',
                    'size' => 30,
                    'required' => false
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('WordPress URL'),
                    'name' => 'FOLLOWUS_WPRESS_LINK',
                    'size' => 30,
                    'required' => false
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Youtube URL'),
                    'name' => 'FOLLOWUS_YOUTUBE_LINK',
                    'size' => 30,
                    'required' => false
                ),
                 array(
                    'type' => 'text',
                    'label' => $this->l('Twitter URL'),
                    'name' => 'FOLLOWUS_TWITTER_LINK',
                    'size' => 30,
                    'required' => false
                )
            ),
            'submit' => array(
                'title' => $this->l('Save'),
                'class' => 'button'
            )
        );
     
        $helper = new HelperForm();
     
        // Module, t    oken and currentIndex
        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
     
        // Language
        $helper->default_form_language = $default_lang;
        $helper->allow_employee_form_lang = $default_lang;
     
        // Title and toolbar
        $helper->title = $this->displayName;
        $helper->show_toolbar = true;        // false -> remove toolbar
        $helper->toolbar_scroll = true;      // yes - > Toolbar is always visible on the top of the screen.
        $helper->submit_action = 'submit'.$this->name;
        $helper->toolbar_btn = array(
            'save' =>
            array(
                'desc' => $this->l('Save'),
                'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.
                '&token='.Tools::getAdminTokenLite('AdminModules'),
            ),
            'back' => array(
                'href' => AdminController::$currentIndex.'&token='.Tools::getAdminTokenLite('AdminModules'),
                'desc' => $this->l('Back to list')
            )
        );
     
        // Load current value
        $helper->fields_value['FOLLOWUS_TWITTER_LINK'] = Configuration::get('FOLLOWUS_TWITTER_LINK');
        $helper->fields_value['FOLLOWUS_FB_LINK'] = Configuration::get('FOLLOWUS_FB_LINK');
        $helper->fields_value['FOLLOWUS_APPSTORE_LINK'] = Configuration::get('FOLLOWUS_APPSTORE_LINK');
        $helper->fields_value['FOLLOWUS_CLOUD_LINK'] = Configuration::get('FOLLOWUS_CLOUD_LINK');
        $helper->fields_value['FOLLOWUS_GPLUS_LINK'] = Configuration::get('FOLLOWUS_GPLUS_LINK');
        $helper->fields_value['FOLLOWUS_INSTAGRAM_LINK'] = Configuration::get('FOLLOWUS_INSTAGRAM_LINK');
        $helper->fields_value['FOLLOWUS_ITUNES_LINK'] = Configuration::get('FOLLOWUS_ITUNES_LINK');
        $helper->fields_value['FOLLOWUS_LIN_LINK'] = Configuration::get('FOLLOWUS_LIN_LINK');
        $helper->fields_value['FOLLOWUS_LOCATION_LINK'] = Configuration::get('FOLLOWUS_LOCATION_LINK');
        $helper->fields_value['FOLLOWUS_MAIL_LINK'] = Configuration::get('FOLLOWUS_MAIL_LINK');
        $helper->fields_value['FOLLOWUS_PATH_LINK'] = Configuration::get('FOLLOWUS_PATH_LINK');
        $helper->fields_value['FOLLOWUS_PINTEREST_LINK'] = Configuration::get('FOLLOWUS_PINTEREST_LINK');
        $helper->fields_value['FOLLOWUS_PSTATION_LINK'] = Configuration::get('FOLLOWUS_PSTATION_LINK');
        $helper->fields_value['FOLLOWUS_PSTORE_LINK'] = Configuration::get('FOLLOWUS_PSTORE_LINK');
        $helper->fields_value['FOLLOWUS_SKYPE_LINK'] = Configuration::get('FOLLOWUS_SKYPE_LINK');
        $helper->fields_value['FOLLOWUS_SPOTIFY_LINK'] = Configuration::get('FOLLOWUS_SPOTIFY_LINK');
        $helper->fields_value['FOLLOWUS_STEAM_LINK'] = Configuration::get('FOLLOWUS_STEAM_LINK');
        $helper->fields_value['FOLLOWUS_WHATSAPP_LINK'] = Configuration::get('FOLLOWUS_WHATSAPP_LINK');
        $helper->fields_value['FOLLOWUS_WSTORE_LINK'] = Configuration::get('FOLLOWUS_WSTORE_LINK');
        $helper->fields_value['FOLLOWUS_WPRESS_LINK'] = Configuration::get('FOLLOWUS_WPRESS_LINK');
        $helper->fields_value['FOLLOWUS_YOUTUBE_LINK'] = Configuration::get('FOLLOWUS_YOUTUBE_LINK');
     
        return $helper->generateForm($fields_form);
    }
    
}

?>