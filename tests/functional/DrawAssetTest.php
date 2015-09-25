<?php

namespace tests;

use tests\overrides\TestDrawAsset;
use yii\web\AssetBundle;

class DrawAssetTest extends TestCase
{
    public function testRegister()
    {
        $view = $this->getView();
        $this->assertEmpty($view->assetBundles);
        TestDrawAsset::register($view);
        $this->assertEquals(2, count($view->assetBundles));
        $this->assertTrue($view->assetBundles['tests\\overrides\\TestDrawAsset'] instanceof AssetBundle);
        $content = $view->render('//layouts/rawlayout.php');
        $this->assertContains('leaflet.css', $content);
        $this->assertContains('l.Draw.css', $content);
        $this->assertContains('leaflet-src.js', $content);
        $this->assertContains('l.control.Draw.js', $content);

    }
}
