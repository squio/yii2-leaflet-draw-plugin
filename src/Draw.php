<?php
/**
 * @copyright Copyright (c) 2015 David J Eddy
 * @link http://davidjeddy.com
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace davidjeddy\leaflet\plugins\draw;


use davidjeddy\leaflet\Plugin;
use yii\web\JsExpression;
use yii\helpers\Json;

/**
 * @author David J Eddy <me@davidjeddy.com>
 * @link http://www.davidjeddy.com/
 * @link https://github.com/davidjeddy
 * @package davidjeddy\leaflet\plugins\draw
 */
class Draw extends Plugin
{
    /**
     * Returns the javascript ready code for the object to render
     * @return \yii\web\JsExpression
     */
    public function encode()
    {
        $options = $this->getOptions();
        $name = $this->getName();

        $js = "L.Draws.draw($options)";

        if (!empty($name)) {
            $js = "var $name = $js;";
        }

        return new JsExpression($js);
    }

    /**
     * Returns the plugin name
     * @return string
     */
    public function getPluginName()
    {

        return 'plugin:draw';
    }

    /**
     * Generates the code to generate a maki marker. Helper method made for speed purposes.
     *
     * @param string $icon the icon name
     * @param array $options the maki marker icon
     *
     * @return string the resulting js code
     */
    public function make($options = [])
    {
        $options = Json::encode($options);
        return new JsExpression("L.Draws.icon($options)");
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
        DrawAsset::register($view);
        return $this;
    }
}
