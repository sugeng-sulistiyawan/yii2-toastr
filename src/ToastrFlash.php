<?php

namespace diecoding\toastr;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * ToastrFlash is a widget integrating the [Toastr](https://codeseven.github.io/toastr/).
 *
 * @link https://github.com/wanforge
 * @author Sugeng Sulistiyawan
 * @copyright Copyright (c) 2018-2025
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
            if (! empty($flashes) && is_array($flashes[0])) {
                // Advanced
                foreach ($flashes as $data) {
                    $normalizedData = $this->normalizeData($data);
                    $this->generateToastr($type, $normalizedData['message'], $normalizedData['title'], $normalizedData['options']);
                }
            } else {
                // Simple
                foreach ($flashes as $value) {
                    $this->generateToastr($type, $value, null, []);
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
    protected function generateToastr($type, $message = null, $title = null, $options = [])
    {
        // For testing: if in test environment and view is null, just return
        if (YII_ENV_TEST && ! $this->hasValidView()) {
            return;
        }

        $this->renderToastr($type, $title, $message, $options);
    }

    /**
     * Render the Toastr widget - can be overridden for testing
     *
     * @param string $type
     * @param string|null $title
     * @param string|null $message
     * @param array $options
     * @return void
     */
    protected function renderToastr($type, $title, $message, $options)
    {
        Toastr::widget([
            "type" => $type,
            "title" => $title,
            "message" => $message,
            "options" => $options,
        ]);
    }

    /**
     * Check if we have a valid view for rendering
     *
     * @return bool
     */
    protected function hasValidView()
    {
        try {
            $view = $this->getView();

            return $view !== null && method_exists($view, 'registerJs');
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Normalize Data Flash Session
     *
     * @param array $data
     * @return array
     */
    protected function normalizeData($data)
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
