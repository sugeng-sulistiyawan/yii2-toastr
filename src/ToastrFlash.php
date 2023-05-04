<?php

namespace diecoding\toastr;

use Yii;

/**
 * ToastrFlash is a widget integrating the [Toastr](https://codeseven.github.io/toastr/).
 * 
 * @link [sugeng-sulistiyawan.github.io](sugeng-sulistiyawan.github.io)
 * @author Sugeng Sulistiyawan <sugeng.sulistiyawan@gmail.com>
 * @copyright Copyright (c) 2023
 */
class ToastrFlash extends ToastrBase
{
    /**
     * @inheritdoc
     */
    public function run()
    {
        /** @var array $flashes */
        $flashes = Yii::$app->getSession()->getAllFlashes(true);
        foreach ($flashes as $type => $data) {
            $datas = (array) $data;
            if (is_array($datas[0])) {
                foreach ($datas as $value) {
                    $this->generateToastr($type, $value[1], $value[0]);
                }
            } else {
                foreach ($datas as $value) {
                    $this->generateToastr($type, $value);
                }
            }
        }
    }

    /**
     * Generate Single Toastr
     * 
     * @param string $type
     * @param string $message
     * @param string|null $title
     * @return void
     */
    private function generateToastr($type, $message, $title = null)
    {
        Toastr::widget([
            "type"    => $type,
            "title"   => $title,
            "message" => $message,
            "options" => $this->options,
        ]);
    }
}
