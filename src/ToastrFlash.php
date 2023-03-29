<?php

namespace diecoding\yii2\toastr;

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
        $session = Yii::$app->session;
        $flashes = $session->getAllFlashes();
        foreach ($flashes as $type => $data) {
            if (in_array($type, self::ALERT_TYPES)) {
                $datas = (array) $data;
                if (is_array($datas[0])) {
                    foreach ($datas as $key => $value) {
                        Toastr::widget(
                            [
                                "type"    => $type,
                                "title"   => $value[0],
                                "message" => $value[1],
                                "options" => $this->options,
                            ]
                        );
                    }
                } else {
                    foreach ($datas as $key => $value) {
                        Toastr::widget(
                            [
                                "type"    => $type,
                                "message" => $value,
                                "options" => $this->options,
                            ]
                        );
                    }
                }

                $session->removeFlash($type);
            }
        }
    }
}
