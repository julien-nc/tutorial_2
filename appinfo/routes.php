<?php
/**
 * Nextcloud - Tutorial2
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Julien Veyssier <eneiluj@posteo.net>
 * @copyright Julien Veyssier 2022
 */

return [
	'routes' => [
		// this tells Nextcloud to link GET requests to /index.php/apps/tutorial_2/ with the "mainPage" method of the PageController class
		['name' => 'page#mainPage', 'url' => '/', 'verb' => 'GET'],
		// this tells Nextcloud to link PUT requests to /index.php/apps/tutorial_2/config with the "saveConfig" method of the PageController class
		['name' => 'page#saveConfig', 'url' => '/config', 'verb' => 'PUT'],
	],
];
