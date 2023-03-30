<?php

namespace diecoding\toastr;

use yii\base\Widget;
use yii\helpers\ArrayHelper;

/**
 * ToastrBase is the base class for widgets.
 * 
 * @link [sugeng-sulistiyawan.github.io](sugeng-sulistiyawan.github.io)
 * @author Sugeng Sulistiyawan <sugeng.sulistiyawan@gmail.com>
 * @copyright Copyright (c) 2023
 */
class ToastrBase extends Widget
{
	const TYPE_INFO    = "info";
	const TYPE_ERROR   = "error";
	const TYPE_SUCCESS = "success";
	const TYPE_WARNING = "warning";

	const POSITION_TOP_RIGHT      = "toast-top-right";
	const POSITION_TOP_LEFT       = "toast-top-left";
	const POSITION_TOP_CENTER     = "toast-top-center";
	const POSITION_TOP_FULL_WIDTH = "toast-top-full-width";

	const POSITION_BOTTOM_RIGHT      = "toast-bottom-right";
	const POSITION_BOTTOM_LEFT       = "toast-bottom-left";
	const POSITION_BOTTOM_CENTER     = "toast-bottom-center";
	const POSITION_BOTTOM_FULL_WIDTH = "toast-bottom-full-width";

	const TYPES = [
		self::TYPE_INFO,
		self::TYPE_ERROR,
		self::TYPE_SUCCESS,
		self::TYPE_WARNING,
	];

	const POSITIONS = [
		self::POSITION_TOP_RIGHT,
		self::POSITION_TOP_LEFT,
		self::POSITION_TOP_CENTER,
		self::POSITION_TOP_FULL_WIDTH,

		self::POSITION_BOTTOM_RIGHT,
		self::POSITION_BOTTOM_LEFT,
		self::POSITION_BOTTOM_CENTER,
		self::POSITION_BOTTOM_FULL_WIDTH,
	];

	/**
	 * @var string default `self::TYPE_INFO`
	 */
	public $typeDefault = self::TYPE_INFO;

	/**
	 * @var string default `""`
	 */
	public $titleDefault = "";

	/**
	 * @var string default `""`
	 */
	public $messageDefault = "";

	/**
	 * @var bool default `false`
	 */
	public $closeButton = false;

	/**
	 * @var bool default `false`
	 */
	public $debug = false;

	/**
	 * @var bool default `true`
	 */
	public $newestOnTop = true;

	/**
	 * @var bool default `true`
	 */
	public $progressBar = true;

	/**
	 * @var string default `self::POSITION_TOP_RIGHT`
	 */
	public $positionClass = self::POSITION_TOP_RIGHT;

	/**
	 * @var bool default `true`
	 */
	public $preventDuplicates = true;

	/**
	 * @var int|null default `300` in `ms`, `null` for skip
	 */
	public $showDuration = 300;

	/**
	 * @var int|null default `1000` in `ms`, `null` for skip
	 */
	public $hideDuration = 1000;

	/**
	 * @var int|null default `5000` in `ms`, `null` for skip
	 */
	public $timeOut = 5000;

	/**
	 * @var int|null default `1000` in `ms`, `null` for skip
	 */
	public $extendedTimeOut = 1000;

	/**
	 * @var string default `swing`, `swing` and `linear` are built into jQuery
	 */
	public $showEasing = "swing";

	/**
	 * @var string default `swing`, `swing` and `linear` are built into jQuery
	 */
	public $hideEasing = "swing";

	/**
	 * @var string default `slideDown`, `fadeIn`, `slideDown`, and `show` are built into jQuery
	 */
	public $showMethod = "slideDown";

	/**
	 * @var string default `slideUp`, `hide`, `fadeOut` and `slideUp` are built into jQuery
	 */
	public $hideMethod = "slideUp";

	/**
	 * @var bool default `true`
	 */
	public $tapToDismiss = true;

	/**
	 * @var bool default `true`
	 */
	public $escapeHtml = true;

	/**
	 * @var bool default `false`
	 */
	public $rtl = false;

	/**
	 * @var bool default `false`, `true` if use custom or external toastr assets
	 */
	public $skipCoreAssets = false;

	/**
	 * @var array default `[]`, Custom Toastr options and override default options
	 */
	public $options = [];

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		if ($this->skipCoreAssets === false) {
			$this->view->registerAssetBundle(ToastrAsset::class);
		}

		$this->options = ArrayHelper::merge([
			"closeButton"       => $this->closeButton,
			"debug"             => $this->debug,
			"newestOnTop"       => $this->newestOnTop,
			"progressBar"       => $this->progressBar,
			"positionClass"     => $this->positionClass,
			"preventDuplicates" => $this->preventDuplicates,
			"showDuration"      => $this->showDuration,
			"hideDuration"      => $this->hideDuration,
			"timeOut"           => $this->timeOut,
			"extendedTimeOut"   => $this->extendedTimeOut,
			"showEasing"        => $this->showEasing,
			"hideEasing"        => $this->hideEasing,
			"showMethod"        => $this->showMethod,
			"hideMethod"        => $this->hideMethod,
			"tapToDismiss"      => $this->tapToDismiss,
			"escapeHtml"        => $this->escapeHtml,
			"rtl"               => $this->rtl,
		], $this->options);

		parent::init();
	}
}
