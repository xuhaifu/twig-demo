## 对Twig的使用
/cache/twig。缓存目录。需要新建，或者修改配置

/config/twig.php。配置文件

views。模板目录，默认文件后缀twig

libraries 。Twig封装类

如果使用Composer，则通过下面方式加载twig：
```
    require_once 'vendor/autoload.php';  
    $loader = new Twig_Loader_Filesystem('/path/to/templates');  
    $twig = new Twig_Environment($loader, array(  
        'cache' => '/path/to/compilation_cache',  
    ));
    echo $twig->render('index.html', array('name' => 'Fabien'));  
        
```
如果你不使用Composer，你可以使用Twig内置的自动加载器：
```
    require_once 'twig/lib/Twig/Autoloader.php';  
    Twig_Autoloader::register();  
```