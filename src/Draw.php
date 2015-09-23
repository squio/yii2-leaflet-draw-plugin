<?php
/**
 * @copyright Copyright (c) 2013-2015 2amigOS! Consulting Group LLC
 * @link http://davidjeddy.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace davidjeddy\leaflet\plugins\draw;


use davidjeddy\leaflet\Plugin;
use yii\web\JsExpression;
use yii\helpers\Json;

/**
 * DrawMarker allows to create map icons using FontDraw Icons.
 *
 * Font draw files are required to be installed
 *
 * @see https://github.com/lvoogdt/Leaflet.draw-markers
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.davidjeddy.us/
 * @package davidjeddy\leaflet\plugins\draw
 */
class DrawMarker extends Plugin
{
    /**
     * @var string the icon name
     * @see https://github.com/lvoogdt/Leaflet.draw-markers#properties
     */
    public $icon;

    /**
     * Generates the code to generate a maki marker. Helper method made for speed purposes.
     *
     * @param string $icon the icon name
     * @param array $options the maki marker icon
     *
     * @return string the resulting js code
     */
    public function make($icon, $options = [])
    {
        $options['icon'] = $icon;
        $options = Json::encode($options);
        return new JsExpression("L.DrawMarkers.icon($options)");
    }

    /**
     * Returns the plugin name
     * @return string
     */
    public function getPluginName()
    {
        return 'plugin:drawmarker';
    }

    /**
     * Registers plugin asset bundle
     *
     * @param \yii\web\View $view
     *
     * @return mixed
     * @codeCoverageIgnore
     */
    public function registerAssetBundle($view)
    {
        DrawMarkerAsset::register($view);
        return $this;
    }

    /**
     * Returns the javascript ready code for the object to render
     * @return \yii\web\JsExpression
     */
    public function encode()
    {
        $icon = $this->icon;

        if (empty($icon)) {
            return "";
        }
        $this->clientOptions['icon'] = $icon;
        $options = $this->getOptions();
        $name = $this->getName();

        $js = "L.DrawMarkers.icon($options)";

        if (!empty($name)) {
            $js = "var $name = $js;";
        }

        return new JsExpression($js);
    }

}
