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
    public $options = [];

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
        if (!isset(Yii::$app->i18n->translations['diecoding'])) {
            Yii::$app->i18n->translations['diecoding'] = [
                'class'          => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en',
                'basePath'       => __DIR__ . '/i18n',
            ];
        }

        $this->view->registerAssetBundle(ToastrAsset::className());

        $this->type    = $this->type ? : self::TYPE_INFO;
        $this->options = Json::encode($this->options);
    }
}
