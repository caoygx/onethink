<?php
$custom = include CONF_ENV . ".php";
define('URL_WWW', 'http://www.' . DOMAIN);
//define('URL_USER', 'http://www.' . DOMAIN);
define('URL_USER', '/');

define('URL_PUBLIC', '/Public');
define('URL_M', 'http://m.' . DOMAIN);
define('URL_IMG', 'http://img.' . DOMAIN);
define('__PH__', URL_PUBLIC . "/home");


$conf = array(
    
      'LOG_RECORD' => true, // 开启日志记录
    'LOG_LEVEL' => 'SQL', // 只记录EMERG ALERT CRIT ERR 错误

//缓存key
    'CACHE_KEY' => array(
        "child" => "child_",

    ),
    'crypt_key' => "1a2b3c4d5e",
    'DEFAULT_FILTER' => '', //过滤函数
    'TAGLIB_PRE_LOAD' => 'html,OT\\TagLib\\Think',
    'SAVE_PATH' => "uploads/",

        'TMPL_PARSE_STRING' => array(
        '__PH__' => URL_PUBLIC . "/home",
        '__PM__' => URL_PUBLIC . "/m",
        '__UPLOAD__' => '/Uploads',
        '__IMG__' => URL_IMG,
        '__U__' => URL_USER,
        '__W__' => URL_WWW,
        '__M__' => URL_M,
    ),


    /* 模块相关配置 */
    'AUTOLOAD_NAMESPACE' => array('Addons' => ONETHINK_ADDON_PATH), //扩展模块列表
    'DEFAULT_MODULE'     => 'Home',
    'MODULE_DENY_LIST'   => array('Common','User','Admin','Install'),
    'MODULE_ALLOW_LIST'  => array('Home'),
/*    'APP_SUB_DOMAIN_DEPLOY' => 1,
    'APP_SUB_DOMAIN_RULES' => array(
        'www' => 'Home',
    ),*/

    /* 系统数据加密设置 */
    'DATA_AUTH_KEY' => 'JGw5:"hvca.(u!+NT>3Ix7#QOV$],XHmjyMor=z|', //默认数据加密KEY
    'DATA_CACHE_KEY'=> 'JGw5:"hvca.(u!+NT>3Ix7#QOV$],XHmjyMor=z|',

    /* 用户相关设置 */
    'USER_MAX_CACHE'     => 1000, //最大缓存用户数
    'USER_ADMINISTRATOR' => 1, //管理员用户ID

    /* URL配置 */
    'URL_CASE_INSENSITIVE' => true, //默认false 表示URL区分大小写 true则表示不区分大小写
    'URL_MODEL'            => 2, //URL模式
    'VAR_URL_PARAMS'       => '', // PATHINFO URL参数变量
    'URL_PATHINFO_DEPR'    => '/', //PATHINFO URL分割符

    /* 全局过滤配置 */
    'DEFAULT_FILTER' => '', //全局过滤函数

    /* 数据库配置 */
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => '127.0.0.1', // 服务器地址
    'DB_NAME'   => 'v', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => '',  // 密码
    'DB_PORT'   => '3306', // 端口
    'DB_PREFIX' => '', // 数据库表前缀

    /* 文档模型配置 (文档模型核心配置，请勿更改) */
    'DOCUMENT_MODEL_TYPE' => array(2 => '主题', 1 => '目录', 3 => '段落'),

    'M_DOMAIN' =>'163.com', //域名
    'M_HOST' =>'smtp.163.com', //邮件服务器
    'M_USER' =>'aa',     //用户名
    'M_PASSWORD' =>'aa', //密码
    'M_PROT' => '',    //端口

);

return array_merge($conf, $custom);