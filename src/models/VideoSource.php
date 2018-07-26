<?php

/**
 * @link https://github.com/insma/yii2-fluid-player
 * @copyright Copyright (c) 2018 Insma Software
 * @license https://github.com/insma/yii2-fluid-player/wiki/LICENSE
 */

namespace insma\player\models;

use yii\base\Model;

/**
 * @author Maciej Klemarczyk <m.klemarczyk+dev@live.com>
 * @since 1.0
 */
class VideoSource extends Model
{
    public $source;
    public $title;
    public $type;
    public $quality;
    public $sourceOptions;

    public function rules()
    {
        return [
            [['source', 'title'], 'trim'],
            [['source', 'title'], 'required'],
            
            ['type', 'default', 'value' => '720p'],
            ['quality', 'default', 'value' => 'SD'],

            ['type', 'in', 'range' => ['114p', '240p', '360p', '480p', '720p', '1080p', '1140p', '2160p', '4320p']],
            ['quality', 'in', 'range' => ['SD', 'HD']],
        ];
    }
}
