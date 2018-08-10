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
     * @inheritdoc
     */
    public function run()
    {
        if (in_array($this->type, $this->types)) {
            return $this->view->registerJs("toastr.{$this->type}(\"{$this->message}\", \"{$this->title}\", {$this->options});");
        }

        return $this->view->registerJs("toastr.{$this->typeDefault}(\"{$this->message}\", \"{$this->title}\", {$this->options});");
    }
}
