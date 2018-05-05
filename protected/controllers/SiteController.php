<?php
/**
 * 首页控制器
 *
 * @package .Controller
 */

class SiteController extends XFrontBase
{


    public function actionIndex()
    {

        $hot = $this->getList('t.view_count  DESC', [], 8);
        $curr = $this->getList('t.create_time  DESC', ['t.view_count' > 10], 12);

        if (isset($_GET['type']) && $_GET['host'] == 'hot') {
            $main = $this->getList('t.view_count  DESC', [], 8, 1);
        } else if (isset($_GET['type']) && $_GET['host'] == 'all') {
            $main = $this->getList('t.view_count  DESC', [], 8, 1);
        } else {
            $main = $this->getList('t.create_time  ASC', [], 20, 1);
        }
        $catalog = $this->getCatalogList();
        $this->render('index', ['hot' => $hot, 'curr' => $curr, 'main' => $main, 'catalog' => $catalog]);
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