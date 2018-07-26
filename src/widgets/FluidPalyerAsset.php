<?php

/**
 * @link https://github.com/insma/yii2-fluid-player
 * @copyright Copyright (c) 2018 Insma Software
 * @license https://github.com/insma/yii2-fluid-player/wiki/LICENSE
 */

namespace insma\player\widgets;

/**
 * @author Maciej Klemarczyk <m.klemarczyk+dev@live.com>
 * @since 1.0
 */
class FluidPalyerAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@vendor/fluid-player/fluid-player';

    public function init()
    {
        if (YII_DEBUG) {
            $this->js[] = 'fluidplayer.js';
            $this->css[] = 'fluidplayer.css';
        } else {
            $this->js[] = 'fluidplayer.min.js';
            $this->css[] = 'fluidplayer.min.css';
        }
    }
}
