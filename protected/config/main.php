<?php
/**
 * 系统配置
 *
 */

$mysql = [
    'connectionString' => 'mysql:host=127.0.0.1;dbname=guo0730',
    'emulatePrepare' => true,
    'enableParamLogging' => true,
    'enableProfiling' => true,
    'username' => 'root',
    'password' => 'taorong2012',
    'charset' => 'utf8',
    'tablePrefix' => 'b_',
];

if (preg_match('/localhost/i', $_SERVER['SERVER_NAME'])) {
    $mysql = [
        'connectionString' => 'mysql:host=127.0.0.1;dbname=gcms',
        'emulatePrepare' => true,
        'enableParamLogging' => true,
        'enableProfiling' => true,
        'username' => 'root',
        'password' => '123456',
        'charset' => 'utf8',
        'tablePrefix' => 'b_',
    ];
}


return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => '',
    'language' => 'zh_cn',
    'theme' => 'zmj',
    'timeZone' => 'Asia/Shanghai',
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.extensions.*',
    ),
    'modules' => array(
        'admini' => array(
            'class' => 'application.modules.admini.AdminiModule',
        ),
        'account' => array(
            'class' => 'application.modules.account.AccountModule',
        )
    ),
    'components' => array(
        'cache' => array(
            'class' => 'CFileCache',
        ),

        'db' => $mysql,

        'errorHandler' => array(
            'errorAction' => 'error/index',
        ),
        'urlManager' => array(
            //'urlFormat'=>'path',
            //'urlSuffix'=>'.html',
            'showScriptName' => true,
            'rules' => array(
                'post/<id:\d+>/*' => 'post/show',
                'post/<id:\d+>_<title:\w+>/*' => 'post/show',
                'post/catalog/<catalog:[\w-_]+>/*' => 'post/index',
                'page/show/<name:\w+>/*' => 'page/show',
                'special/show/<name:[\w-_]+>/*' => 'special/show',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
    ),
    'params' => require(dirname(__FILE__) . DS . 'params.php'),
);