<?php
/**
 *
 * Draw.php
 *
 *
 * 
 * @copyright Copyright (c) 2015 David J Eddy
 * @link http://davidjeddy.com
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

namespace squio\leaflet\plugins\draw;

use dosamigos\leaflet\Plugin;
use yii\web\JsExpression;
use yii\helpers\Json;


/**
 * Draw adds the ability to place line, shapes, and markers to your leaflet maps
 * 
 * @author David J Eddy <me@davidjeddy.com>
 * @link http://www.davidjeddy.com/
 * @link https://github.com/davidjeddy
 * @package davidjeddy\leaflet\plugins\draw
 */
class Draw extends Plugin
{
    /**
     * @var string the name of the javascript variable that will hold the reference
     * to the map object.
     */
    public $map = 'map';
    /**
     * @var array the options for the underlying LeafLetJs JS component.
     * Please refer to the LeafLetJs api reference for possible
     * [options](http://leafletjs.com/reference.html).
     */
    public $options = null;

    private $_editLayer = null;

    /* get/set methods */

    /**
     * Returns the plugin name
     * @return string
     */
    public function getPluginName()
    {

        return 'leaflet:draw';
    }

    /**
     * Returns the processed js options
     * @return array
     */
    public function getOptions()
    {
        $options = ($this->options
            ? json::encode($this->options)
            : '{}'
        );
        // Kludge: add bare JS name 'drawnItems'
        $options = preg_replace('/"edit":{/', '"edit":{"featureGroup":drawnItems,', $options);
        return $options;
    }

    /* non get/set methods */

    public function addEditLayer($layer)
    {
        $this->_editLayer = $layer;
        $this->_editLayer->name = null; // suppress assignment in encode
    }

    /**
     * Returns the javascript ready code for the object to render
     * @return \yii\web\JsExpression
     */
    public function encode()
    {
        $drawnItems = 'var drawnItems = new L.FeatureGroup()';
        if ($this->_editLayer) {
            $drawnItems = 'var _editLayer = ' . $this->_editLayer->encode() . '; ';
            $drawnItems .= 'var drawnItems = new L.FeatureGroup([_editLayer])';
        }
        $js = "
            var editableLayers = new L.FeatureGroup();
            {$this->map}.addLayer(editableLayers);

            {$drawnItems};
            {$this->map}.addLayer(drawnItems);

            var drawControl = new L.Control.Draw({$this->getOptions()});
            {$this->map}.addControl(drawControl);

            {$this->map}.on('draw:created', function (e) {
                var type = e.layerType,
                    layer = e.layer;

                /* if (type === 'marker') {
                    layer.bindPopup('A popup!');
                } */

                drawnItems.addLayer(layer);
            });
        ";

        return new JsExpression($js);
    }

    /**
     * Registers plugin asset bundle
     * @param \yii\web\View $view
     * @return mixed
     * @codeCoverageIgnore
     */
    public function registerAssetBundle($view)
    {
        DrawAsset::register($view);
        return $this;
    }
}
