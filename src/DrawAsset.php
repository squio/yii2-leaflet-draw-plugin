<?php
/**
 * @copyright Copyright (c) 2013 2amigOS! Consulting Group LLC
 * @link http://davidjeddy.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace davidjeddy\leaflet\plugins\draw;

use yii\web\AssetBundle;

/**
 * DrawMarkerAsset
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.davidjeddy.us/
 * @package davidjeddy\leaflet\plugins\draw
 */
class DrawMarkerAsset extends AssetBundle
{
    public $sourcePath = '@vendor/davidjeddy/yii2-leaflet-draw-plugin/assets';

    public $css = ['css/leaflet.draw-markers.css'];

    public $depends = [
        'davidjeddy\leaflet\LeafLetAsset',
    ];

    public function init()
    {
        $this->js[] = YII_DEBUG ? 'js/leaflet.draw-markers.js' : 'js/leaflet.draw-markers.min.js';
    }
}
