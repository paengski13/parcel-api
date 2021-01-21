<?php

namespace App\Helpers\Traits;

use Illuminate\Support\Facades\Log;

trait LogTrait
{
    /**
     * Control the log level depending on the configuration
     *
     * @param $message
     * @param string $level
     * @return null
     */
    public function saveLog($message, $level = "info")
    {
        $overrideLevel = $this->getOverrideLevel();
        if (!empty($overrideLevel)) {
            Log::$overrideLevel($message);
        } else {
            Log::$level($message);
        }
    }

    /**
     * An option to automatically set the level to debug
     *
     * @return string | null
     */
    private function getOverrideLevel()
    {
        return 'debug';
    }
}
