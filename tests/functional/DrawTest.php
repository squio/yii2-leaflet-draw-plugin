<?php

namespace tests;


use tests\overrides\TestDraw;

class DrawTest extends TestCase
{
    public function testEncode()
    {
        $plugin = new TestDraw();
        $plugin->map = 'testMap';
        $this->assertEquals('plugin:Draw', $plugin->getPluginName());
        $this->assertEquals(
            'new L.Control.Draw({"provider":new L.Draw.Provider.OpenStreetMap(),"position":"topcenter","showMarker":true}).addTo(testMap)',
            $plugin->encode()
        );

        $plugin->clientOptions = [];
        $plugin->service = TestDraw::SERVICE_BING;
        $this->assertEquals(
            'new L.Control.Draw({"provider":new L.Draw.Provider.Bing(),"position":"topcenter","showMarker":true}).addTo(testMap)',
            $plugin->encode()
        );

        $plugin->clientOptions = [];
        $plugin->service = TestDraw::SERVICE_ESRI;
        $this->assertEquals(
            'new L.Control.Draw({"provider":new L.Draw.Provider.Esri(),"position":"topcenter","showMarker":true}).addTo(testMap)',
            $plugin->encode()
        );

        $plugin->clientOptions = [];
        $plugin->service = TestDraw::SERVICE_GOOGLE;
        $this->assertEquals(
            'new L.Control.Draw({"provider":new L.Draw.Provider.Google(),"position":"topcenter","showMarker":true}).addTo(testMap)',
            $plugin->encode()
        );

        $plugin->clientOptions = [];
        $plugin->service = TestDraw::SERVICE_NOKIA;
        $plugin->name = 'test';
        $this->assertEquals(
            'var test = new L.Control.Draw({"provider":new L.Draw.Provider.Nokia(),"position":"topcenter","showMarker":true}).addTo(testMap);',
            $plugin->encode()
        );

        $this->setExpectedException('yii\base\InvalidConfigException');
        $plugin->service = 'wrongService';
        $plugin->encode();
    }

    public function testRegister()
    {
        $view = $this->getView();
        $plugin = new TestDraw();

        $this->assertEquals($plugin, $plugin->registerAssetBundle($view));

        $this->assertCount(2, $view->assetBundles);

        $this->assertArrayHasKey('tests\overrides\TestDrawAsset', $view->assetBundles);

        $this->assertEquals(
            'js/l.control.Draw.js',
            $view->assetBundles['tests\overrides\TestDrawAsset']->js[0]
        );
        $this->assertEquals(
            'js/l.Draw.provider.openstreetmap.js',
            $view->assetBundles['tests\overrides\TestDrawAsset']->js[1]
        );
    }

}
