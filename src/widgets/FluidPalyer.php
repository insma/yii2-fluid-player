<?php

/**
 * @link https://github.com/insma/yii2-fluid-player
 * @copyright Copyright (c) 2018 Insma Software
 * @license https://github.com/insma/yii2-fluid-player/wiki/LICENSE
 */

namespace insma\player\widgets;

use yii\base\Widget;
use yii\web\View;

use insma\player\helpers\HtmlVideo;
use insma\player\models\VideoSource;

/**
 * @author Maciej Klemarczyk <m.klemarczyk+dev@live.com>
 * @since 1.0
 */
class FluidPlayer extends Widget
{
    /**
     * @var VideoSource[]
     */
    public $sources;

    /**
     * @var string
     */
    public $videoOptions;

    public function init()
    {
        parent::init();
        $this->registerAssetBundle()
        $this->registerPlayerScript();
    }

    public function run()
    {
        $htmlView = HtmlVideo::beginVideo($this->id, $videoOptions);
        foreach ($sources as $key => $value) {
            $htmlView .= self::prepareSourceTag($value);
        }
        $htmlView .= HtmlVideo::endVideo();
        return $htmlView;
    }

    protected function prepareSourceTag($source)
    {
        $options = [];

        $options['source'] = $source->source;
        $options['title'] = $source->title;
        $options['type'] = $source->type;
        $options['quality'] = $source->quality;

        return HtmlVideo::source($src, $options);
    }

    /**
     * Register assetBundle
     */
    protected function registerAssetBundle()
    {
        FluidPalyerAsset::register($this->getView());
    }

    protected function registerPlayerScript()
    {
        $jsScript = '';
        $this->getView()->registerJs($jsScript, View::POS_READY, $this->id);
    }
}
