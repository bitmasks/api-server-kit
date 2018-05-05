<?php

/**
 * 小工具
 *
 * @package .admini.Controller
 */
class ToolsController extends XAdminiBase
{

    /**
     * 缓存管理
     */
    public function actionCache()
    {
        parent::_acl();
        $this->render('cache', $data);
    }

    /**
     * 缓存更新
     */
    public function actionCacheUpdate()
    {
        $scope = $this->_gets->getParam('scope');
        try {
            if (is_array($scope)) {
                foreach ($scope as $key => $row) {
                    XXcache::refresh($row, 3600);
                }
                $var['state'] = 'success';
                $var['message'] = '操作完成';
            } else
                throw new Exception('请选择要更新的内容');
        } catch (Exception $e) {
            $var['state'] = 'error';
            $var['message'] = '操作失败：' . $e->getMessage();
        }
        exit(CJSON::encode($var));
    }
}
