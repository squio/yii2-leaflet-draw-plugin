Awesome Plugin
==============

[![Latest Version](https://img.shields.io/github/tag/2amigos/yii2-leaflet-awesome-plugin.svg?style=flat-square&label=release)](https://github.com/2amigos/yii2-leaflet-awesome-plugin/tags)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/2amigos/yii2-leaflet-awesome-plugin/master.svg?style=flat-square)](https://travis-ci.org/2amigos/yii2-leaflet-awesome-plugin)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/2amigos/yii2-leaflet-awesome-plugin.svg?style=flat-square)](https://scrutinizer-ci.com/g/2amigos/yii2-leaflet-awesome-plugin/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/2amigos/yii2-leaflet-awesome-plugin.svg?style=flat-square)](https://scrutinizer-ci.com/g/2amigos/yii2-leaflet-awesome-plugin)
[![Total Downloads](https://img.shields.io/packagist/dt/2amigos/yii2-leaflet-awesome-plugin.svg?style=flat-square)](https://packagist.org/packages/2amigos/yii2-leaflet-awesome-plugin)


Yii 2 [LeafletJs](http://leafletjs.com/) Plugin to create map icons using [Font Awesome](http://fontawesome.io/) and GlyphIcon Icons.

This Plugin works in conjunction with [LeafLet](https://github.com/2amigos/yii2-leaflet-extension)
library for [Yii 2](https://github.com/yiisoft/yii2) framework, Bootstrap and/or [Font Awesome](http://fontawesome.io/) iconic font and css toolkit. 

In order to make it work with GlyphIcon (included with Bootstrap) or [Font Awesome](http://fontawesome.io/) files you need to add the required files your self.

To swap betwen GlyphIcon (default) and FontAwesome, you just need to modify its prefix. Should work with other Font Toolkits as long as it follows the following class signature: "prefix prefix-iconname".

Installation
------------
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require "2amigos/yii2-leaflet-awesome-plugin" "*"
```
or add

```json
"2amigos/yii2-leaflet-awesome-plugin" : "*"
```

to the require section of your application's `composer.json` file.

Usage
-----

```
// LeafLet initialization component
// ...

// Initialize plugin
$awesomeMarkers = new dosamigos\leaflet\plugins\awesome\AwesomeMarker(['name' => 'awesome']);

// install
$leafLet->installPlugin($awesomeMarkers);

// sample location
$center = new dosamigos\leaflet\types\LatLng(['lat' => 51.508, 'lng' => -0.11]);

// generate icon through its icon
$marker = new dosamigos\leaflet\layers\Marker([
    'latLng' => $center,
    'icon' => $leafLet->plugins->awesome->make("star",['markerColor' => "green", 'prefix' => "fa"]),
    'popupContent' => 'Hey! I am a marker'
]);

```

Testing
-------

```bash
$ ./vendor/bin/phpunit
```

Contributing
------------

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

Credits
-------

- [Antonio Ramirez](https://github.com/tonydspaniard)
- [All Contributors](../../contributors)

License
-------

The BSD License (BSD). Please see [License File](LICENSE.md) for more information.

> [![2amigOS!](http://www.gravatar.com/avatar/55363394d72945ff7ed312556ec041e0.png)](http://www.2amigos.us)  
<i>Web development has never been so fun!</i>  
[www.2amigos.us](http://www.2amigos.us)
