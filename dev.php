<?php

define('UC_DB_DSN', 'mysql://root:@127.0.0.1:3306/v'); // 数据库连接，使用Model方式调用API必须配置此项
return array(
		'DB_TYPE'=>'mysql',
		'DB_HOST'=>'localhost',
		'DB_PORT' => '3306',
		'DB_NAME'=>'v',
		'DB_USER'=>'root',
		'DB_PWD'=>'',
		'DB_PREFIX'=>'',
		

		//缓存类型
		//'DATA_CACHE_TYPE' => 'Memcache',
		'SHOW_PAGE_TRACE'=>true,
		'FIRE_SHOW_PAGE_TRACE' => true,

);