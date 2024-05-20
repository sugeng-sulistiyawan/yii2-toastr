<?php

namespace diecoding\toastr;

use Yii;
use yii\helpers\ArrayHelper;

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
        $allFlashes = Yii::$app->getSession()->getAllFlashes(true);
        foreach ($allFlashes as $type => $flash) {
            $flashes = (array) $flash;
            if (is_array($flashes[0])) {
                // Advanced
                foreach ($flashes as $data) {
                    $normalizedData = $this->normalizeData($data);
                    $this->generateToastr($type, $normalizedData['message'], $normalizedData['title'], $normalizedData['options']);
                }
            } else {
                // Simple
                foreach ($flashes as $value) {
                    $this->generateToastr($type, $value);
                }
            }
        }
    }

    /**
     * Generate Single Toastr
     * 
     * @param string $type
     * @param string|null $message
     * @param string|null $title
     * @param array $options
     * @return void
     */
    private function generateToastr($type, $message = null, $title = null, $options = [])
    {
        Toastr::widget([
            "type" => $type,
            "title" => $title,
            "message" => $message,
            "options" => $options,
        ]);
    }

    /**
     * Normalize Data Flash Session
     * 
     * @param array $data
     * @return array
     */
    private function normalizeData($data)
    {
        $title = $data['title'] ?? (isset($data[1]) ? ($data[0] ?? null) : null);
        $message = $data['message'] ?? ($data[1] ?? ($data[0] ?? null));
        $options = $data['options'] ?? (isset($data[2]) ? $data[2] : []);

        return [
            'title' => $title,
            'message' => $message,
            'options' => ArrayHelper::merge($this->options, (array) $options),
        ];
    }
}
