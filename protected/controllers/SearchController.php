<?php
/**
 * 搜索
 *
 * @package .Controller
 */

class SearchController extends XFrontBase
{
    /**
     * 首页
     */
    public function actionIndex()
    {
        $keyword = CHtml::encode(strip_tags(trim($this->_gets->getParam('keyword'))));
        $postModel = new Post();
        $postCriteria = new CDbCriteria();
        if ($keyword)
            $postCriteria->addSearchCondition('t.title', $keyword);
        $postCriteria->addCondition('t.status_is=:status');
        $postCriteria->params[':status'] = 'Y';
        $postCriteria->with = 'catalog';
        $postCriteria->order = 't.id DESC';
        $bagecmsQuestionCount = $postModel->count($postCriteria);
        $postPages = new CPagination($bagecmsQuestionCount);
        $postPages->pageSize = 15;
        $postPageParams = XUtils::buildCondition($_GET, array('keyword'));
        $postPageParams['#'] = 'list';
        $postPages->params = is_array($postPageParams) ? $postPageParams : array();
        $postCriteria->limit = $postPages->pageSize;
        $postCriteria->offset = $postPages->currentPage * $postPages->pageSize;
        $postList = $postModel->findAll($postCriteria);
        $this->render('index', array('bagecmsDataList' => $postList, 'bagecmsPagebar' => $postPages));
    }
}
