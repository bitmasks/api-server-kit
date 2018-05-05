<?php
/**
 * 后台管理模块
 *
 * @package .Module
 */

class AdminiModule extends CWebModule
{
    /*public function init()
    {
        // import the module-level models and components
        //导 入类，必要时可恢复此属性
         $this->setImport(array(
            'admini.models.*',
            'admini.components.*',
        ));
    }*/

    public function beforeControllerAction($controller, $action)
    {
        if (parent::beforeControllerAction($controller, $action)) {
            return true;
        } else
            return false;
    }
}
