<?php

/**
 * 内容控制器
 *
 * @package .Controller
 */
class PostController extends XFrontBase
{


    /**
     * 浏览详细内容
     */
    public function actionShow($id)
    {
        $bagecmsShow = Post::model()->findByPk(intval($id));
        if (false == $bagecmsShow)
            throw new CHttpException(404, '内容不存在');
        //更新浏览次数
        $bagecmsShow->updateCounters(array('view_count' => 1), 'id=:id', array('id' => $id));
        //seo信息
        $this->_seoTitle = empty($bagecmsShow->seo_title) ? $bagecmsShow->title . ' - ' . $this->_conf['site_name'] : $bagecmsShow->seo_title;
        $this->_seoKeywords = empty($bagecmsShow->seo_keywords) ? $this->_seoKeywords : $bagecmsShow->seo_keywords;
        $this->_seoDescription = empty($bagecmsShow->seo_description) ? $this->_seoDescription : $bagecmsShow->seo_description;
        $catalogArr = Catalog::item($bagecmsShow->catalog_id, $this->_catalog);

        if ($bagecmsShow->template) {
            $tpl = $bagecmsShow->template;
        } elseif ($catalogArr['template_show']) {
            $tpl = $catalogArr['template_show'];
        } else {
            $tpl = 'show_post';
        }
        //自定义数据
        $attrVal = AttrVal::model()->findAll(array('condition' => 'post_id=:postId', 'with' => 'attr', 'params' => array('postId' => $bagecmsShow->id)));


        $hot = $this->getList('t.view_count  DESC', [], 8);
        $curr = $this->getList('t.create_time  DESC', ['t.view_count' > 10], 12);

        if (isset($_GET['type']) && $_GET['host'] == 'hot') {
            $main = $this->getList('t.view_count  DESC', [], 1, 1);
        } else if (isset($_GET['type']) && $_GET['host'] == 'all') {
            $main = $this->getList('t.view_count  DESC', [], 1, 1);
        } else {
            $main = $this->getList('t.create_time  ASC', [], 1, 1);
        }
        $catalog = $this->getCatalogList();


        $tplVar = array(
            'bagecmsShow' => $bagecmsShow,
            'attrVal' => $attrVal,
            'catalogArr' => $catalogArr,
            'catalogChild' => Catalog::lite(intval($bagecmsShow->catalog_id)),
            'hot' => $hot, 'curr' => $curr, 'main' => $main, 'catalog' => $catalog
        );
        $this->render($tpl, $tplVar);
    }


    /**
     * 首页
     */
    public function actionIndex()
    {
        $catalog = trim($this->_gets->getParam('catalog'));
        $keyword = trim($this->_gets->getParam('keyword'));
        $catalogArr = Catalog::alias2idArr($catalog, $this->_catalog);
        if ($catalog && $catalogArr) {
            if ($catalogArr['display_type'] == 'list') {
                $tpl = $catalogArr['template_list'] ? $catalogArr['template_list'] : 'list_text';
                $resultArr = self::_catalogList(array('catalog' => $catalogArr['id'], 'pageSize' => $catalogArr['page_size']));
            } else {
                $resultArr = self::_catalogItem(array('catalog' => $catalogArr['id']));
                $tpl = empty($resultArr['bagecmsCatalogShow']->template_page) ? 'list_page' : $resultArr['bagecmsCatalogShow']->template_page;
            }
        } else {
            $resultArr = self::_catalogList(array('keyword' => $keyword));
            $tpl = 'list_text';
        }
        $tplVars = array(
            'catalogArr' => $catalogArr,
            'catalogChild' => Catalog::lite(intval($catalogArr['id'])),
        );
        $this->render($tpl, array_merge($resultArr, $tplVars));
    }

    /**
     * 获取栏目内容数据
     *
     * @param array $params
     * @return array  数组
     */
    protected function _catalogList($params = array())
    {

        $postModel = new Post();
        $postCriteria = new CDbCriteria();
        $condition = '1';
        if ($params['catalog']) {
            $condition .= ' AND t.catalog_id=:catalogId';
            $criteriaParams[':catalogId'] = intval($params['catalog']);
        }
        if ($params['keyword']) {
            $condition .= ' AND t.title=:title';
            $criteriaParams[':title'] = CHtml::encode(strip_tags($params['keyword']));
        }
        $condition .= " AND t.status_is='Y'";
        $postCriteria->condition = $condition;
        $postCriteria->params = $criteriaParams;
        $postCriteria->order = 't.id DESC';
        $postCriteria->with = 'catalog';
        $count = $postModel->count($postCriteria);
        $postPages = new CPagination($count);
        $postPages->pageSize = $params['pageSize'] > 0 ? $params['pageSize'] : 20;
        $pageParams = XUtils::buildCondition($_GET, array('catalog', 'keyword'));
        $postPages->params = is_array($pageParams) ? $pageParams : array();
        $postCriteria->limit = $postPages->pageSize;
        $postCriteria->offset = $postPages->currentPage * $postPages->pageSize;
        $bagecmsDataList = $postModel->findAll($postCriteria);
        $catalogArr = Catalog::item($params['catalog'], $this->_catalog);
        if ($catalogArr) {
            $this->_seoTitle = empty($catalogArr['catalog_name']) ? $this->_seoTitle : $catalogArr['catalog_name'];
            $bagecmsCatalogData = $catalogArr;
            $this->_seoKeywords = empty($catalogArr['seo_keywords']) ? $this->_seoKeywords : $catalogArr['seo_keywords'];
            $this->_seoDescription = empty($catalogArr['seo_description']) ? $this->_seoDescription : $catalogArr['seo_description'];
        }
        return array('bagecmsDataList' => $bagecmsDataList, 'bagecmsPagebar' => $postPages, 'bagecmsCatalogData' => $bagecmsCatalogData);
    }

    /**
     * 栏目数据读取
     *
     * @param array
     * @return [type]
     */
    protected function _catalogItem($params = array())
    {
        $catalogModel = Catalog::model()->findByPk(intval($params['catalog']));
        if ($catalogModel) {
            $this->_seoTitle = empty($catalogModel->seo_title) ? $catalogModel->catalog_name : $catalogModel->seo_title;
            $this->_seoKeywords = $catalogModel->seo_keywords;
            $this->_seoDescription = $catalogModel->seo_description;
            return array('bagecmsCatalogShow' => $catalogModel);
        } else {
            throw new CHttpException(404, '内容不存在');
        }
    }


    /**
     * 提交评论
     *
     * @return [type] [description]
     */
    public function actionPostComment()
    {

        $nickname = trim($this->_gets->getParam('nickname'));
        $email = trim($this->_gets->getParam('email'));
        $postId = trim($this->_gets->getParam('postId'));
        $comment = trim($this->_gets->getParam('comment'));
        try {
            if (empty($postId))
                throw new Exception('编号丢失');
            elseif (empty($nickname) || empty($email) || empty($comment))
                throw new Exception('昵称、邮箱、内容必须填写');
            $bagecmsPostCommentModel = new PostComment();

            $bagecmsPostCommentModel->attributes = array(
                'post_id' => $postId,
                'nickname' => $nickname,
                'email' => $email,
                'content' => $comment,
            );

            if ($bagecmsPostCommentModel->save()) {
                $var['state'] = 'success';
                $var['message'] = '提交成功';
            } else {
                throw new Exception(CHtml::errorSummary($bagecmsPostCommentModel, null, null, array('firstError' => '')));
            }

        } catch (Exception $e) {
            $var['state'] = 'error';
            $var['message'] = '出现错误：' . $e->getMessage();
        }
        exit(CJSON::encode($var));
    }


    public function getList($order = 't.view_count  DESC', $condition = [], $limit = 5, $isPage = 0)
    {
        $model = new Post();
        $criteria = new CDbCriteria();
        $criteria->order = $order;

        if ($isPage) {
            $count = $model->count($criteria);
            $pages = new CPagination($count);
            $pages->pageSize = (isset($_REQUEST['per']) && $_REQUEST['per']) ? $_REQUEST['per'] : 10;
            $criteria->limit = $limit ? $limit : $pages->pageSize;
            $criteria->offset = $pages->currentPage * $pages->pageSize;
        } else {
            /* $count = $model->count($criteria);
             $pages = new CPagination($count);
             $pages->pageSize = (isset($_REQUEST['per']) && $_REQUEST['per']) ? $_REQUEST['per'] : 10;*/
            $criteria->limit = $limit;
            $criteria->offset = 0;
        }


        $condition = '1';
        if (isset($_REQUEST['catalog']) && $_REQUEST['catalog']) {
            $condition .= ' AND catalog_id=:catalogId';
            $criteriaParams[':catalogId'] = intval($_REQUEST['catalog']);
        }

        if (isset($_REQUEST['s']) && $_REQUEST['s']) {
            $condition .= " AND title LIKE   :title  ";
            $criteriaParams[':title'] = '%' . $_REQUEST['s'] . '%';
        }


        $criteria->condition = $condition;
        $criteria->params = $criteriaParams;
        $result = $model->findAll($criteria);
        /*$count = $model->count($criteria);*/
        foreach ($result as $index => &$item) {
            $item = json_decode(CJSON::encode($item), true);
            /* preg_match_all('/<img(.*?)src="(.*?)(?=")/i',  str_ireplace('\\' , '' , $item['content'] ), $arr);
             if(isset($arr[2])    ){
                 $item['images']  =  array_slice( $arr[2],0,3 );
             }
             $item['create_time_formate']   =  date('Y-m-d'  ,$item['create_time']);*/

            if (!$item['attach_thumb']) {
                $item['attach_thumb'] = '/themes/zmj/style/logo.jpg';
            }
        }

        return $result;
    }


    public function getCatalogList($params = [])
    {
        $postCriteria = new CDbCriteria();
        $condition = '1';
        $condition .= " AND parent_id='0'";
        $postCriteria->condition = $condition;
        $postCriteria->order = 'sort_order DESC,id DESC';
        $postCriteria->condition = 'parent_id = 0 ';
        $catalogList = Catalog::model()->findAll($postCriteria);
        $dataList = Catalog::get(0, $catalogList);
        return $dataList;
    }

}
