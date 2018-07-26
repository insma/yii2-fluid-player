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
class FluidPlayerWidget extends \yii\helpers\BaseHtml
{
    public static function beginForm($id, $options = [])
    {
        $options['id'] = $id;
        return static::beginTag('video', $options);
    }

    public static function source($src, $type = 'SD', $options = [])
    {
        $options['src'] = Url::to($src);

        if (isset($options['srcset']) && is_array($options['srcset'])) {
            $srcset = [];
            foreach ($options['srcset'] as $descriptor => $url) {
                $srcset[] = Url::to($url) . ' ' . $descriptor;
            }
            $options['srcset'] = implode(',', $srcset);
        }

        if (!isset($options['alt'])) {
            $options['alt'] = '';
        }

        return static::tag('source', '', $options);
    }

    public static function endVideo()
    {
        return "</video>";
    }

    <script type="text/javascript">
    fluidPlayer('my-video');
 </script>
}
