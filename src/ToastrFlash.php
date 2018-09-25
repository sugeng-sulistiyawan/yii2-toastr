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
class ToastrFlash extends ToastrBase
{
    /**
     * @inheritdoc
     */
    public function run()
    {
        $session = \Yii::$app->session;
        $flashes = $session->getAllFlashes();
        foreach ($flashes as $type => $data) {
            $datas = (array) $data;
            foreach ($datas as $message) {
                Toastr::widget(
                    [
                        'type'    => $type,
                        'title'   => is_array($message) ? $message['title'] : "",
                        'message' => is_array($message) ? $message['message'] : $message,
                    ]
                );
            }

            $session->removeFlash($type);
        }
    }
}
