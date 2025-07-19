<?php

namespace diecoding\toastr;

use yii\helpers\Json;

/**
 * Toastr widget
 *
 * @link https://github.com/wanforge
 * @copyright Copyright (c) 2025
 */
class Toastr extends ToastrBase
{
    /**
     *
     * @var string
     */
    public $type;

    /**
     *
     * @var string
     */
    public $title;

    /**
     *
     * @var string
     */
    public $message;

    /**
     * @inheritdoc
     */
    public function run()
    {
        $type = in_array($this->type, self::TYPES) ? $this->type : $this->typeDefault;
        $title = $this->title ?: $this->titleDefault;
        $message = $this->message ?: $this->messageDefault;
        $options = Json::encode($this->options);

        $this->view->registerJs("toastr.{$type}(\"{$message}\", \"{$title}\", {$options});");
    }
}
