<?php
require_once __DIR__ . '/../php_libs/init.php';
require_once __DIR__.'/../php_libs/smarty/libs/Smarty.class.php';

$smarty  = new Smarty;
$smarty->template_dir = _SMARTY_TEMPLATES_DIR;
$smarty->compile_dir  = _SMARTY_TEMPLATES_C_DIR;
$smarty->config_dir   = _SMARTY_CONFIG_DIR;
$smarty->cache_dir    = _SMARTY_CACHE_DIR;

$smarty->assign("test", "スマイリー");

$file = 'test.tpl';

$smarty->display($file);
?>
