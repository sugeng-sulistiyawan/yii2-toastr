<?php
/**
 * @link http://www.diecoding.com/
 * @author Die Coding (Sugeng Sulistiyawan) <diecoding@gmail.com>
 * @copyright Copyright (c) 2018
 */

namespace diecoding\toastr\src;

use yii\helpers\Html;
use yii\helpers\Json;

/**
 *
 */
class ToastrFlash extends ToastrBase
{
    /**
     *
     *
     * @var object $_session
     */
    private $_session;

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->_session = \Yii::$app->session;
        $flashes        = $this->_session->getAllFlashes();
        foreach ($flashes as $type => $data) {
            $datas = (array) $data;

            foreach ($datas as $message) {
                Toastr::widget(
                    [
                        'type'    => Html::encode($type),
                        'message' => Html::encode($message),
                        'options' => Json::decode($this->options),
                    ]
                );
            }

            $this->_session->removeFlash($type);
        }
    }
}
