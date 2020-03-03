<?php
/**
 * @name Bootstrap
 * @author laruence
 * @desc 所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * @see http://www.php.net/manual/en/class.yaf-bootstrap-abstract.php
 * 这些方法, 都接受一个参数:Yaf\Dispatcher $dispatcher
 * 调用的次序, 和申明的次序相同
 */

use Yaf\Loader;
use Yaf\Application;
use Yaf\Registry;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

class Bootstrap extends Yaf\Bootstrap_Abstract{

    protected $config;

    public function _initCommonFunctions(){
        //加载全局公共函数
        Loader::import(APP_PATH . '/common/functions.php');
    }

    public function _initConfig() {
        //把配置保存起来
        $this->config = Yaf\Application::app()->getConfig()->toArray();
        //获取其他配置文件
        $list = file_list(CONFIG_PATH);
        foreach($list as $file){
            if(substr($file,-3) == 'php'){
                $name = substr(basename($file),0,-4);
                $this->config[$name] = require $file;
            }
        }
        Registry::set('config',$this->config);
    }

    public function _initPlugin(Yaf\Dispatcher $dispatcher) {
        //注册一个插件
        $objSamplePlugin = new SamplePlugin();
        $dispatcher->registerPlugin($objSamplePlugin);
    }

    public function _initRoute(Yaf\Dispatcher $dispatcher) {
        //在这里注册自己的路由协议,默认使用简单路由
    }

    public function _initView(Yaf\Dispatcher $dispatcher) {
        //在这里注册自己的view控制器，例如smarty,firekylin
    }

    public function _initLoader(Yaf\Dispatcher $dispatcher) {
        //加载composer
        $autoload = APP_ROOT . '/vendor/autoload.php';
        if(file_exists($autoload)){
            Loader::import(APP_ROOT . '/vendor/autoload.php');
        }
    }

    public function _initDbAdpter() {
        $capsule = new Capsule;
        // 多数据库支持
        foreach($this->config['database'] as $name=>$val){
            // 创建连接
            $capsule->addConnection($val,$name);
        }
        $capsule->setEventDispatcher(new Dispatcher(new Container));
        // 设置全局静态可访问
        // Make this Capsule instance available globally via static methods... (optional)
        $capsule->setAsGlobal();
        // 启动Eloquent
        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $capsule->bootEloquent();
        class_alias(\Illuminate\Database\Capsule\Manager::class,'DB');
    }

}
