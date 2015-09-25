<?php

namespace tests\overrides;


use davidjeddy\leaflet\plugins\draw\Draw;

class TestDraw extends Draw
{
    public function registerAssetBundle($view)
    {
        TestDrawAsset::register($view);
        return $this;
    }
}
