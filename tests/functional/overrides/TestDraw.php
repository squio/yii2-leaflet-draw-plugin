<?php

namespace tests\overrides;


use dosamigos\leaflet\plugins\Draw\Draw;

class TestDraw extends Draw
{
    public function registerAssetBundle($view)
    {
        switch ($this->service) {
            case static::SERVICE_OPENSTREETMAP:
            case static::SERVICE_BING:
            case static::SERVICE_ESRI:
            case static::SERVICE_GOOGLE:
            case static::SERVICE_NOKIA:
                TestDrawAsset::register($view)->js[] = "js/l.Draw.provider.{$this->service}.js";
                break;
            default:
                TestDrawAsset::register($view);
        }
        return $this;
    }
}
