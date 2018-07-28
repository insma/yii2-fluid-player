<?php

/**
 * @link https://github.com/insma/yii2-fluid-player
 * @copyright Copyright (c) 2018 Insma Software
 * @license https://github.com/insma/yii2-fluid-player/wiki/LICENSE
 */

namespace insma\player\helpers;

use yii\base\InvalidConfigException;
use yii\helpers\BaseHtml;
use yii\helpers\Url;

/**
 * @author Maciej Klemarczyk <m.klemarczyk+dev@live.com>
 * @since 1.0
 */
class HtmlVideo extends \yii\helpers\BaseHtml
{
    public static function beginVideo($id, $options = [])
    {
        $options['id'] = $id;
        return static::beginTag('video', $options);
    }

    public static function source($src, $options = [])
    {
        $options['src'] = Url::to($src);

        return static::tag('source', '', $options);
    }

    public static function endVideo()
    {
        return "</video>";
    }
}
