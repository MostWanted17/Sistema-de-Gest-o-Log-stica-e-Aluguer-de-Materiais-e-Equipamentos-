<?php

Class Template extends SmartyBC{
    function __construct($template_dir = 'view/templates/', $compile_dir = 'view/compile/', $cache_dir = 'view/cache/'){
        parent:: __construct();
        
        $this->setTemplateDir($template_dir);
        $this->setCompileDir($compile_dir);
        $this->setCacheDir($cache_dir);
    }
}

?>
