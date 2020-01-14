<?php

define('APP_PATH', realpath(__DIR__));
$_config = new \Yaf\Config\Ini( APP_PATH . "/conf/application.ini" ,\Yaf\ENVIRON);
(isset($_config->library) && !empty($_config->library)) && ini_set('yaf.library', $_config->library); // 注册全局类库
\Yaf\Loader::getInstance('library')->registerLocalNamespace($_config->local_namespace->toArray());    //注册本地类库
new \Yaf\Application($_config->toArray(),\Yaf\ENVIRON);
$_config = null;unset($_config);