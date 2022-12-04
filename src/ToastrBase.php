<?php
/**
 * @link http://www.diecoding.com/
 * @author Die Coding (Sugeng Sulistiyawan) <diecoding@gmail.com>
 * @copyright Copyright (c) 2018
 */


namespace diecoding\toastr;

use yii\base\Widget;

/**
 * 
 * @inheritdoc
 * 
 */
class ToastrBase extends Widget
{
	/**
	 *
	 * @var bool $closeButton
	 */
	public $closeButton = FALSE;

	/**
	 *
	 * @var bool $debug
	 */
	public $debug = FALSE;

	/**
	 *
	 * @var bool $newestOnTop
	 */
	public $newestOnTop = TRUE;

	/**
	 *
	 * @var bool $progressBar
	 */
	public $progressBar = TRUE;

	/**
	 *
	 * @var string $positionClass
	 */
	public $positionClass = "toast-top-right";

	/**
	 *
	 * @var bool $preventDuplicates
	 */
	public $preventDuplicates = TRUE;

	/**
	 *
	 * @var string $onclick
	 */
	public $onclick = NULL;

	/**
	 *
	 * @var string $showDuration
	 */
	public $showDuration = "300";

	/**
	 *
	 * @var string $hideDuration
	 */
	public $hideDuration = "1000";

	/**
	 *
	 * @var string $timeOut
	 */
	public $timeOut = "5000";

	/**
	 *
	 * @var string $extendedTimeOut
	 */
	public $extendedTimeOut = "1000";

	/**
	 *
	 * @var string $showEasing swing | linear
	 */
	public $showEasing = "swing";

	/**
	 *
	 * @var string $hideEasing swing | linear
	 */
	public $hideEasing = "swing";

	/**
	 *
	 * @var string $showMethod show | fadeIn | slideDown
	 */
	public $showMethod = "slideDown";

	/**
	 *
	 * @var string $hideMethod hide | fadeOut | slideUp
	 */
	public $hideMethod = "slideUp";

	/**
	 *
	 * @var bool $tapToDismiss
	 */
	public $tapToDismiss = TRUE;

	/**
	 *
	 * @var bool $useCustomAssets
	 */
	public $useCustomAssets = FALSE;

	/**
	 *
	 * @var array $options
	 */
	public $options = [ ];

	/**
	 *
	 */
	const ALERT_TYPES = [ "info", "error", "success", "warning" ];

	const POSITION_TOP_RIGHT      = "toast-top-right";
	const POSITION_TOP_LEFT       = "toast-top-left";
	const POSITION_TOP_CENTER     = "toast-top-center";
	const POSITION_TOP_FULL_WIDTH = "toast-top-full-width";

	const POSITION_BOTTOM_RIGHT      = "toast-bottom-right";
	const POSITION_BOTTOM_LEFT       = "toast-bottom-left";
	const POSITION_BOTTOM_CENTER     = "toast-bottom-center";
	const POSITION_BOTTOM_FULL_WIDTH = "toast-bottom-full-width";

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();

		if ($this->useCustomAssets === FALSE)
			$this->view->registerAssetBundle(ToastrAsset::class);
		
		if (empty($this->options)) {
			$this->options = [
				"closeButton"       => $this->closeButton,
				"debug"             => $this->debug,
				"newestOnTop"       => $this->newestOnTop,
				"progressBar"       => $this->progressBar,
				"positionClass"     => $this->positionClass,
				"preventDuplicates" => $this->preventDuplicates,
				"onclick"           => $this->onclick,
				"showDuration"      => $this->showDuration,
				"hideDuration"      => $this->hideDuration,
				"timeOut"           => $this->timeOut,
				"extendedTimeOut"   => $this->extendedTimeOut,
				"showEasing"        => $this->showEasing,
				"hideEasing"        => $this->hideEasing,
				"showMethod"        => $this->showMethod,
				"hideMethod"        => $this->hideMethod,
				"tapToDismiss"      => $this->tapToDismiss,
			];
		}
	}
}
