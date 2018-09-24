<?php
/**
 * @link http://www.diecoding.com/
 * @author Die Coding (Sugeng Sulistiyawan) <diecoding@gmail.com>
 * @copyright Copyright (c) 2018
 */


namespace diecoding\toastr;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Json;

/**
 *
 */
class ToastrBase extends Widget
{
    /**
     *
     *
     * @var string $title
     */
    public $title;

    /**
     *
     *
     * @var string $message
     */
    public $message;

    /**
     *
     *
     * @var string $type
     */
    public $type;

    /**
     *
     *
     * @var array $options
     */
    public $options = [
        "closeButton"       => false,
        "debug"             => false,
        "newestOnTop"       => true,
        "progressBar"       => true,
        "positionClass"     => "toast-top-right",
        "preventDuplicates" => false,
        "onclick"           => null,
        "showDuration"      => "300",
        "hideDuration"      => "1000",
        "timeOut"           => "5000",
        "extendedTimeOut"   => "1000",
        "showEasing"        => "swing",
        "hideEasing"        => "linear",
        "showMethod"        => "fadeIn",
        "hideMethod"        => "fadeOut",
    ];

    const TYPE_INFO    = 'info';
    const TYPE_ERROR   = 'error';
    const TYPE_SUCCESS = 'success';
    const TYPE_WARNING = 'warning';

    const POSITION_TOP_RIGHT      = 'toast-top-right';
    const POSITION_TOP_LEFT       = 'toast-top-left';
    const POSITION_TOP_CENTER     = 'toast-top-center';
    const POSITION_TOP_FULL_WIDTH = 'toast-top-full-width';

    const POSITION_BOTTOM_RIGHT      = 'toast-bottom-right';
    const POSITION_BOTTOM_LEFT       = 'toast-bottom-left';
    const POSITION_BOTTOM_CENTER     = 'toast-bottom-center';
    const POSITION_BOTTOM_FULL_WIDTH = 'toast-bottom-full-width';

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->view->registerAssetBundle(ToastrAsset::className());		
		
        $this->type    = $this->type ? : self::TYPE_INFO;
        $this->options = Json::encode($this->options);
    }
}
