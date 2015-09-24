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
class Draw extends \dosamigos\leaflet\controls
{
    /**
     * @var string the name of the javascript variable that will hold the reference
     * to the map object.
     */
    public $map;
    /**
     * @var string the initial position of the control (one of the map corners).
     */
    public $position = 'topright';
    /**
     * @var array the options for the underlying LeafLetJs JS component.
     * Please refer to the LeafLetJs api reference for possible
     * [options](http://leafletjs.com/reference.html).
     */
    public $clientOptions = [];
    /**
     * @var string the variable name. If not null, then the js creation script
     * will be returned as a variable. If null, then the js creation script will
     * be returned as a constructor that you can use on other object's configuration options.
     */
    private $_name;

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
     * Returns the name of the layer.
     *
     * @param boolean $autoGenerate whether to generate a name if it is not set previously
     *
     * @return string name of the layer.
     */
    public function getName($autoGenerate = false)
    {
        if ($autoGenerate && $this->_name === null) {
            $this->_name = LeafLet::generateName();
        }
        return $this->_name;
    }

    /**
     * Sets the name of the layer.
     *
     * @param string $value name of the layer.
     */
    public function setName($value)
    {
        $this->_name = $value;
    }

    /**
     * Returns the processed js options
     * @return array
     */
    public function getOptions()
    {
        return empty($this->clientOptions) ? '{}' : Json::encode($this->clientOptions);
    }
}
