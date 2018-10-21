<?php
/**
 * @link http://www.diecoding.com/
 * @author Die Coding (Sugeng Sulistiyawan) <diecoding@gmail.com>
 * @copyright Copyright (c) 2018
 */

namespace diecoding\toastr;

use yii\helpers\Json;

/**
 *
 */
class Toastr extends ToastrBase
{
    /**
     *
     * @var string $type
     */
    public $type;

    /**
     *
     * @var string $title
     */
    public $title;

    /**
     *
     * @var string $message
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
