<?php
use OCP\Util;
$appId = OCA\Tutorial2\AppInfo\Application::APP_ID;
Util::addScript($appId, $appId . '-main');
?>

<?php
if ($_['app_version']) {
    // you can get the values you injected as template parameters in the "$_" array
	echo '<h3>App version: ' . p($_['app_version']) . '</h3>';
}
?>
<div id="tutorial_2"></div>
