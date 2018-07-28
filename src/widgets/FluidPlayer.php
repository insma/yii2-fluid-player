<?php

/**
 * @link https://github.com/insma/yii2-fluid-player
 * @copyright Copyright (c) 2018 Insma Software
 * @license https://github.com/insma/yii2-fluid-player/wiki/LICENSE
 */

namespace insma\player\widgets;

use yii\base\Widget;
use yii\helpers\Json;
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
     * @var boolean
     */
    public $useCdn;

    /**
     * @var VideoSource[]
     */
    public $sources;

    /**
     * @var array
     */
    public $videoOptions;

    /**
     * @var array
     */
    public $playerOptions;

    public function init()
    {
        parent::init();
        $this->registerAssetBundle();
        $this->registerPlayerScript();
    }

    public function run()
    {
        $htmlView = HtmlVideo::beginVideo($this->id, $this->videoOptions);
        $sources = [];
        foreach ($this->sources as $key => $value) {
            if ($value instanceof VideoSource && $value->validate()) {
                $sources[$value->qualityOrder . '_' . $key] = self::prepareSourceTag($value);
            }
        }
        krsort($sources, SORT_NATURAL);
        $htmlView .= implode($sources);
        $htmlView .= HtmlVideo::endVideo();
        return $htmlView;
    }

    protected function prepareSourceTag($source)
    {
        $options = [];

        if (is_array($source->sourceOptions)) {
            $options = $source->sourceOptions;
        }

        $options['title'] = $source->title;
        $options['type'] = $source->type;
        $options['quality'] = $source->quality;

        if ($source->isHdReady) {
            $options['data-fluid-hd'] = 'true';
        }

        return HtmlVideo::source($source->source, $options);
    }

    /**
     * Register assetBundle
     */
    protected function registerAssetBundle()
    {
        if ($this->useCdn === true) {
            $this->getView()->registerCssFile('http://cdn.fluidplayer.com/2.4.2/fluidplayer.min.css', [], 'fluidPlayer-widget-css-cdn');
            $this->getView()->registerJsFile('http://cdn.fluidplayer.com/2.4.2/fluidplayer.min.js', [], 'fluidPlayer-widget-js-cdn');
        } else {
            FluidPlayerAsset::register($this->getView());
        }
    }

    protected function registerPlayerScript()
    {
        $options = Json::encode($this->playerOptions);
        $jsScript = 'fluidPlayer("' . $this->id . '",' . $options . ');';
        $this->getView()->registerJs($jsScript, View::POS_READY, $this->id);
    }
}
