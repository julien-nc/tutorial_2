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

namespace OCA\Tutorial2\Controller;

use Exception;
use OCP\App\IAppManager;
use OCP\AppFramework\Http;
use OCP\AppFramework\Http\Response;
use OCP\AppFramework\Services\IInitialState;
use OCP\Constants;
use OCP\Files\IRootFolder;
use OCP\Files\NotFoundException;
use OCP\IConfig;
use OCP\IL10N;
use OCP\IServerContainer;
use OCP\IURLGenerator;
use Psr\Log\LoggerInterface;
use Throwable;
use OCA\Tutorial2\Service\ImageService;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\ContentSecurityPolicy;
use OCP\AppFramework\Http\DataDownloadResponse;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Http\RedirectResponse;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\IRequest;

use OCA\Tutorial2\AppInfo\Application;

class PageController extends Controller {

	/**
	 * @var LoggerInterface
	 */
	private $logger;
	/**
	 * @var IAppManager
	 */
	private $appManager;
	/**
	 * @var IRootFolder
	 */
	private $root;
	/**
	 * @var IInitialState
	 */
	private $initialStateService;
	/**
	 * @var IL10N
	 */
	private $l10n;
	/**
	 * @var IConfig
	 */
	private $config;
	/**
	 * @var IURLGenerator
	 */
	private $urlGenerator;
	/**
	 * @var string|null
	 */
	private $userId;

	public function __construct(string $appName,
								IRequest $request,
								LoggerInterface $logger,
								IAppManager $appManager,
								IRootFolder $root,
								IInitialState $initialStateService,
								IL10N $l10n,
								IConfig $config,
								IURLGenerator $urlGenerator,
								?string $userId) {
		parent::__construct($appName, $request);
		$this->logger = $logger;
		$this->appManager = $appManager;
		$this->root = $root;
		$this->initialStateService = $initialStateService;
		$this->l10n = $l10n;
		$this->config = $config;
		$this->urlGenerator = $urlGenerator;
		$this->userId = $userId;
	}

	/**
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 *
	 * @return TemplateResponse
	 */
	public function mainPage(): TemplateResponse {
		$fileNameList = $this->getGifFilenameList();
		$myInitialState = [
			'file_name_list' => $fileNameList,
		];
		$this->initialStateService->provideInitialState('tutorial_initial_state', $myInitialState);

		$appVersion = $this->config->getAppValue(Application::APP_ID, 'installed_version');
		return new TemplateResponse(
			Application::APP_ID,
			'myMainTemplate',
			[
				'app_version' => $appVersion,
			]
		);
	}

	private function getGifFilenameList(): array {
		$path = dirname(__DIR__, 2) . '/img/gifs';
		$names = array_filter(scandir($path), static function ($name) {
			return $name !== '.' && $name !== '..';
		});
		return array_values($names);
	}
}
