<?php

namespace console\tests\unit\controllers;

use Yii;
use common\models\Good;
use common\models\Provider;
use \console\controllers\DataController;
use common\models\Category;

class DataTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * Test data filling.
     */
    public function testDataFilling(): void
    {
        $this->runControllerAction('fill', ['categoryCount' => 12, 'providerCount' => 14, 'goodCount' => 42]);
        $this->assertEquals(12, (int) Category::find()->count());
        $this->assertEquals(14, (int) Provider::find()->count());
        $this->assertEquals(42, (int) Good::find()->count());
    }

    /**
     * Test truncate data before filling.
     */
    public function testDataTruncateBeforeFilling(): void
    {
        $this->runControllerAction('fill');
        $this->runControllerAction('fill', ['truncate' => true]);
        $this->assertEquals(10, (int) Category::find()->count());
        $this->assertEquals(10, (int) Provider::find()->count());
        $this->assertEquals(30, (int) Good::find()->count());
    }

    /**
     * Test data truncate.
     */
    public function testDataTruncate(): void
    {
        $this->runControllerAction('fill');
        $this->runControllerAction('truncate');
        $this->assertEquals(0, (int) Category::find()->count());
        $this->assertEquals(0, (int) Provider::find()->count());
        $this->assertEquals(0, (int) Good::find()->count());
    }

    /**
     * @param string $actionId
     * @param array $args
     * @param array $config
     * @return string
     */
    protected function runControllerAction(string $actionId, array $args = [], array $config = []): string
    {
        $controller = $this->createController($config);
        ob_start();
        ob_implicit_flush(false);
        $controller->run($actionId, $args);
        return ob_get_clean();
    }

    /**
     * @param array $config
     * @return DataController
     */
    protected function createController(array $config = []): DataController
    {
        $module = $this->getMockBuilder(\yii\base\Module::class)
            ->setMethods([ 'fake' ])
            ->setConstructorArgs([ 'console' ])
            ->getMock();
        $controller = new DataController('data', $module);
        $controller->interactive = false;

        return Yii::configure($controller, $config);
    }
}
