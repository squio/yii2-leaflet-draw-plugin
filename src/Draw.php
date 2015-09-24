<?php
/**
 * @copyright Copyright (c) 2015 David J Eddy
 * @link http://davidjeddy.com
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace davidjeddy\leaflet\plugins\draw;


use dosamigos\leaflet\Plugin;
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
     * @var string the icon name
     * @see https://github.com/lvoogdt/Leaflet.draw#properties
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
        return new JsExpression("L.Draws.icon($options)");
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

        $js = "L.Draws.icon($options)";

        if (!empty($name)) {
            $js = "var $name = $js;";
        }

        return new JsExpression($js);
    }

}
