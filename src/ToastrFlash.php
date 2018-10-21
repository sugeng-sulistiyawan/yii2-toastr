<?php
/**
 * @link http://www.diecoding.com/
 * @author Die Coding (Sugeng Sulistiyawan) <diecoding@gmail.com>
 * @copyright Copyright (c) 2018
 */

namespace diecoding\toastr;

use Yii;

/**
 *
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
                if (is_array($datas[ 0 ])) {
                    foreach ($datas as $key => $value) {
                        Toastr::widget(
                            [
                                "type"    => $type,
                                "title"   => $value[ 0 ],
                                "message" => $value[ 1 ],
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
