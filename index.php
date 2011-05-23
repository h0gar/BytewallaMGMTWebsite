<?php
#INIT
ob_start();
require_once('db.inc.php');
require_once('view.inc.php');
$db = new Database('localhost', 'root', 'safesql', 'DTNGateway');

#MODULE
if(isset($_GET['m']) && ctype_alnum($_GET['m']) && file_exists('modules/'.$_GET['m'].'.php'))
	$module = $_GET['m'];
else
	$module = 'default';

#PREPARE OUTPUT
$title = 'Management';

$modules = array(
	'Overview' => 'default',
	'Statistics' => 'stats',
	'Bundles' => 'bundles',
	'Configuration' => 'config'
);
$menu = array();
foreach($modules as $k=>$v) {
	$menu[$k] = array('url'=>'?m='.$v);
	if($v == $module)
		$menu[$k]['selected'] = true;
}
	
ob_start();
include('modules/'.$module.'.php');
$content = ob_get_contents();
ob_end_clean();

$view = new View('template/view.php');
$view->set('title', $title);
$view->set('menu', $menu);
$view->set('content', $content);
$view->prepare();
$view->flush();

#FINISH
#$db->close();
ob_flush();
