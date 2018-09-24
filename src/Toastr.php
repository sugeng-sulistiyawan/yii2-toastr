<?php
/**
 * @link http://www.diecoding.com/
 * @author Die Coding (Sugeng Sulistiyawan) <diecoding@gmail.com>
 * @copyright Copyright (c) 2018
 */

namespace diecoding\toastr\src;

/**
 *
 */
class Toastr extends ToastrBase
{
    /**
     * @inheritdoc
     */
    public function run()
    {
        $js = "toastr.{$this->type}(\"{$this->message}\", \"{$this->title}\", {$this->options});";

        return $this->view->registerJs($js);
    }
}
