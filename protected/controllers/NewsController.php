<?php

/**
 * 内容控制器
 *
 * @package .Controller
 *
 *
 *
 *  文章列表  /index.php?r=news/list&page=3&per=10
 *  文章详情  /index.php?r=news/show&id=90
 *  分类列表  /index.php?r=news/category
 *
 *  注册  /index.php?r=news/register&username=13792812605&password=11111
 *  登录  /index.php?r=news/login&username=13792812605&password=11111
 *
 *
 * UPDATE    b_post  SET   catalog_id =1
 *
 * CREATE TABLE `b_user` (`id` int(10) unsigned NOT NULL AUTO_INCREMENT,`username` char(50) NOT NULL DEFAULT '' COMMENT '用户',`password` char(32) NOT NULL COMMENT '密码',`mobile` varchar(20) DEFAULT '' COMMENT '电话',`realname` varchar(100) DEFAULT '' COMMENT '真实姓名',`status_is` enum('Y','N') DEFAULT 'Y' COMMENT '用户状态',`create_time` int(10) DEFAULT '0' COMMENT '创建时间',PRIMARY KEY (`id`) ) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='注册会员';
 */
class NewsController extends XFrontBase
{


    public function json($data, $code = 1, $msg = 'SUCCESS')
    {
        die(json_encode(['code' => $code, 'data' => $data, 'msg' => $msg]));
    }

    /**
     * 首页
     */
    public function actionList()
    {

        $model = new Post();
        $criteria = new CDbCriteria();
        $criteria->order = 't.id DESC';
        //$criteria->with = 'userGroup';
        $count = $model->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = (isset($_REQUEST['per']) && $_REQUEST['per']) ? $_REQUEST['per'] : 10;
        $criteria->limit = $pages->pageSize;
        $criteria->offset = $pages->currentPage * $pages->pageSize;


        $condition = '1';
        if (isset($_REQUEST['catalog']) && $_REQUEST['catalog']) {
            $condition .= ' AND catalog_id=:catalogId';
            $criteriaParams[':catalogId'] = intval($_REQUEST['catalog']);
        }

        if (isset($_REQUEST['keyword']) && $_REQUEST['keyword']) {
            $condition .= " AND title LIKE   :title  ";
            $criteriaParams[':title'] = '%' . $_REQUEST['keyword'] . '%';
        }


        $criteria->condition = $condition;
        $criteria->params = $criteriaParams;
        $result = $model->findAll($criteria);
        $count = $model->count($criteria);

        foreach ($result as $index => &$item) {
            $item = json_decode(CJSON::encode($item), true);
            preg_match_all('/<img(.*?)src="(.*?)(?=")/i', str_ireplace('\\', '', $item['content']), $arr);

            if (isset($arr[2])) {
                $item['images'] = array_slice($arr[2], 0, 3);
            }

            $item['create_time_formate'] = date('Y-m-d', $item['create_time']);
        }

        return $this->json(
            [
                'list' => $result,
                'paging' => ['page' => $_REQUEST['page'], 'per' => $_REQUEST['per'], 'total' => $count]
            ]
        );


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

        //$postCriteria->select = 'title,author,intro,content,copy_from,tags,catalog_name' ;
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

        $data = json_decode(CJSON::encode($bagecmsShow), TRUE);
        return $this->json($data);

    }


    /**
     * 文章分类列表
     */
    public function actionCategory()
    {
        $postCriteria = new CDbCriteria();
        $condition = '1';
        $condition .= " AND parent_id='0'";
        $postCriteria->condition = $condition;
        $postCriteria->order = 'sort_order DESC,id DESC';
        $postCriteria->condition = 'parent_id = 0 ';
        $catalogList = Catalog::model()->findAll($postCriteria);
        $datalist = Catalog::get(0, $catalogList);
        return $this->json($datalist);
    }


    /**
     *  登录
     */
    public function actionLogin()
    {
        $data = $this->find($_REQUEST);
        if (!empty($data) && is_array($data)) {
            return $this->json($data);
        }

        return $this->json($_REQUEST, 0, '登录失败');
    }


    /**
     * 用户注册
     */
    public function actionRegister()
    {

        $data = $this->find($_REQUEST);
        if (!empty($data) && is_array($data)) {
            return $this->json($_REQUEST, 0, '已注册');
        }

        $post = new User();
        $post->username = $_REQUEST['username'];
        $post->password = md5($_REQUEST['password']);
        if (isset($_REQUEST['mobile']) && $_REQUEST['mobile']) {
            $post->mobile = $_REQUEST['mobile'];
        }
        $post->create_time = time();
        $data = $post->save();
        return $this->json($data);
    }


    /**
     * 获取用户信息
     */
    private function find($param)
    {
        if (!isset($param['username']) || !isset($param['password'])) {
            return $this->json('', 0, '参数错误');
        }

        $criteria = new CDbCriteria;
        $criteria->select = 'username , mobile ';  // 只选择 'title' 列
        $criteria->condition = 'username=:username  AND  password=:password';
        $criteria->params = array(':username' => $param['username'], ':password' => md5($param['password']));
        $data = User::model()->find($criteria); // $params 不需要了
        return json_decode(CJSON::encode($data), true);
    }


}
