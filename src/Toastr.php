<?php

namespace diecoding\yii2\toastr;

use yii\helpers\Json;

/**
 * Class Toastr
 * 
 * @link [sugeng-sulistiyawan.github.io](sugeng-sulistiyawan.github.io)
 * @author Sugeng Sulistiyawan <sugeng.sulistiyawan@gmail.com>
 * @copyright Copyright (c) 2023
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
        $options = Json::encode($this->options);
        $js      = "toastr.{$this->type}(\"{$this->message}\", \"{$this->title}\", {$options});";

        $this->view->registerJs($js);
    }
}
