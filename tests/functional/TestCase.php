<?php

namespace tests;

use yii\helpers\ArrayHelper;
use yii\web\View;

/**
 * This is the base class for all tests.
 */
abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    public static $params;

    /**
     * Mock application prior running tests.
     */
    protected function setUp()
    {
        $this->mockWebApplication(
            [
                'components' => [
                    'request' => [
                        'class'                => 'yii\web\Request',
                        'enableCsrfValidation' => false,
                        'url'                  => '/test',
                    ],
                    'response' => [
                        'class' => 'yii\web\Response',
                    ],
                ],
            ]
        );
    }

    /**
     * Clean up after test.
     * By default the application created with [[mockApplication]] will be destroyed.
     */
    protected function tearDown()
    {
        parent::tearDown();
        $this->destroyApplication();
    }

    protected function mockApplication($config = [], $appClass = '\yii\console\Application')
    {
        new $appClass(
            ArrayHelper::merge(
                [
                    'basePath'   => '@tests',
                    'id'         => 'testapp',
                    'vendorPath' => '@vendor',
                ],
                $config
            )
        );
    }

    protected function mockWebApplication($config = [], $appClass = '\yii\web\Application')
    {
        new $appClass(ArrayHelper::merge([
            'id'         => 'testapp',
            'basePath'   => '@tests',
            'vendorPath' => '@vendor',
            'components' => [
                'request' => [
                    'cookieValidationKey' => 'wefJDF8sfdsfSDefwqdxj9oq',
                    'scriptFile'          => '@tests' .'/index.php',
                    'scriptUrl'           => '/index.php',
                ],
                'assetManager' => [
                    'basePath' => '@tests/assets',
                    'baseUrl'  => '@tests',
                    //'class'    => 'tests\AssetManager',
                ]
            ]
        ], $config));
    }

    /**
     * Destroys application in Yii::$app by setting it to null.
     */
    protected function destroyApplication()
    {

        return (\Yii::$app = null);
    }

    /**
     * Creates a view for testing purposes
     *
     * @return View
     */
    protected function getView()
    {
        $view = new View();
        /* $view->setAssetManager(new AssetManager([
            'basePath' => '@vendor/leaflet.draw/dist',
            'baseUrl' => '/',
        ])); */
        return $view;
    }

    /**
     * Asserting two strings equality ignoring line endings
     *
     * @param string $expected
     * @param string $actual
     */
    public function assertEqualsWithoutLE($expected, $actual)
    {
        return $this->assertEquals(
            str_replace("\r\n", "\n", $expected),
            str_replace("\r\n", "\n", $actual)
        );
    }
}
