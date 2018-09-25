<?php
/**
 * @link http://www.diecoding.com/
 * @author Die Coding (Sugeng Sulistiyawan) <diecoding@gmail.com>
 * @copyright Copyright (c) 2018
 */

namespace diecoding\toastr;

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
        $js = "toastr.{$this->type}(\"{$this->message}\", \"{$this->title}\", {$this->_options});";

        return $this->view->registerJs($js);
    }
}
