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
    /**
     * @var string
     */
    public $source;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $quality;

    /**
     * @var array
     */
    public $sourceOptions;

    private static $qualityList = ['114p', '240p', '360p', '480p', '720p', '1080p', '1140p', '2160p', '4320p'];
    private static $hdQualityList = ['720p', '1080p', '1140p', '2160p', '4320p'];

    public function rules()
    {
        return [
            [['source', 'title'], 'trim'],
            [['source', 'title'], 'required'],
            
            ['quality', 'default', 'value' => '720p'],

            ['quality', 'in', 'range' => ['114p', '240p', '360p', '480p', '720p', '1080p', '1140p', '2160p', '4320p']],
            ['type', 'in', 'range' => ['video/mp4', 'video/webm', 'video/ogg', 'application/dash+xml', 'application/x-mpegURL']],
        ];
    }

    public function getIsHdReady()
    {
        return false !== array_search($this->quality, self::$hdQualityList);
    }

    public function getQualityOrder()
    {
        return array_search($this->quality, self::$qualityList);
    }
}
