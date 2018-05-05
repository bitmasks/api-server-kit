<?php

/**
 * 单页控制器
 *
 * @package .Controller
 */
class PageController extends XFrontBase
{
    /**
     * 浏览
     */
    public function actionShow($name)
    {


        $bagecmsPageModel = Page::model()->find('title_alias=:titleAlias', array('titleAlias' => CHtml::encode(strip_tags($name))));
        if (false == $bagecmsPageModel)
            throw new CHttpException(404, '内容不存在');
        $this->_seoTitle = empty($bagecmsPageModel->seo_title) ? $bagecmsPageModel->title . ' - ' . $this->_conf['site_name'] : $bagecmsPageModel->seo_title;
        $tpl = empty($bagecmsPageModel->template) ? 'show' : $bagecmsPageModel->template;

        $this->render(
            $tpl,
            array('bagecmsPage' => $bagecmsPageModel));
    }


}
