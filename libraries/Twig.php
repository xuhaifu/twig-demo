<?php
/**
 * Created by Twig.php
 * Author: XHF
 * Date: 2018/5/11
 * Time: 16:59
 */

require APP_PATH."/vendor/autoload.php";

class Twig
{
    public $twig;
    public $config;
    
    private $data = array();

    /**
     * 读取配置文件twig.php并初始化设置
     *
     */
    public function __construct($config)
    {
        $config_default = array(
            'cache_dir' => true, //开启缓存
            'debug' => false, //开启调试模式（dump函数可用）
            'auto_reload' => true,
            'extension' => '.tpl', //默认后缀名
        );
        $this->config = array_merge($config_default, $config);
        //Twig_Autoloader::register();
        $loader = new Twig_Loader_Filesystem ($this->config['template_dir']);
        $this->twig = new Twig_Environment ($loader, array (
            'cache' => $this->config['cache_dir'],
            'debug' => $this->config['debug'],
            'auto_reload' => $this->config['auto_reload'],
        ) );
    }
    /**
     * 给变量赋值
     *
     * @param string|array $var
     * @param string $value
     */
    public function assign($var, $value = NULL)
    {
        if(is_array($var)) {
            foreach($var as $key => $val) {
                $this->data[$key] = $val;
            }
        } else {
            $this->data[$var] = $value;
        }
    }
    /**
     * 模版渲染
     *
     * @param string $template 模板名
     * @param array $data 变量数组
     * @param string $return true返回 false直接输出页面
     * @return string
     */
    public function render($template, $data = array(), $return = FALSE)
    {
        $template = $this->twig->loadTemplate ( $this->getTemplateName($template) );
        $data = array_merge($this->data, $data);
        if ($return === TRUE) {
            return $template->render ( $data );
        } else {
            return $template->display ( $data );
        }
    }
    /**
     * 获取模版名
     *
     * @param string $template
     */
    public function getTemplateName($template)
    {
    	$default_ext_len = strlen($this->config['extension']);
    	if(substr($template, -$default_ext_len) != $this->config['extension']) {
    		$template .= $this->config['extension'];
    	}
    	return $template;
    }
    /**
     * 字符串渲染
     *
     * @param string $string 需要渲染的字符串
     * @param array $data 变量数组
     * @param string $return true返回 false直接输出页面
     * @return string
     */
    public function parse($string, $data = array(), $return = FALSE)
    {
    	$string = $this->twig->loadTemplate ( $string );
    	$data = array_merge($this->data, $data);
    	if ($return === TRUE) {
    		return $string->render ( $data );
    	} else {
    		return $string->display ( $data );
    	}
    }
}
