<?php

namespace tests;

use tests\overrides\TestDrawAsset;
use yii\web\AssetBundle;

class DrawAssetTest extends TestCase
{
    public function testRegister()
    {
        $view = $this->getView();
        TestDrawAsset::register($view);
        $content = $view->render('//layouts/rawlayout.php');

        $this->assertContains('leaflet.draw.css',   $content);
        $this->assertContains('leaflet.draw-src.js',$content);
        $this->assertContains('leaflet.draw.js',    $content);
        $this->assertEmpty($view->assetBundles);
        $this->assertEquals(2, count($view->assetBundles));
        $this->assertTrue($view->assetBundles['tests\\overrides\\TestDrawAsset'] instanceof AssetBundle);
    }
}
