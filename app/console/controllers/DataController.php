<?php

namespace console\controllers;

use common\models\Category;
use common\models\Good;
use common\models\Provider;
use yii\console\ExitCode;

class DataController extends \yii\console\Controller
{
    /**
     * Truncate all data before fill.
     * @var bool
     */
    public $truncate = false;

    /**
     * Count of categories to create.
     * @var int
     */
    public $categoryCount = 10;

    /**
     * Count of providers to create.
     * @var int
     */
    public $providerCount = 10;

    /**
     * Count of goods to create.
     * @var int
     */
    public $goodCount = 30;

    /**
     * @inheritdoc
     */
    public function options($actionID): array
    {
        $options = parent::options($actionID);

        return array_merge($options, ['truncate', 'categoryCount', 'providerCount', 'goodCount']);
    }

    /**
     * Truncate all data.
     * @return int
     */
    public function actionTruncate(): int
    {
        $this->stdout("Truncate all data...\n");
        $this->truncate();
        $this->stdout(" ok\n");

        return ExitCode::OK;
    }

    /**
     * Filling database by random data.
     * @return int
     * @throws \Exception
     */
    public function actionFill(): int
    {
        if ($this->truncate) {
            $this->stdout("Truncate all data...\n");
            $this->truncate();
            $this->stdout(" ok\n");
        }

        $this->stdout("Run the filling of some data\n");

        $this->stdout("Filling {$this->categoryCount} categories...");
        $categoryIds = $this->createCategories($this->categoryCount);
        $this->stdout(" ok\n");
        $this->stdout("Filling {$this->providerCount} providers...");
        $providerIds = $this->createProviders($this->providerCount);
        $this->stdout(" ok\n");
        $this->stdout("Filling {$this->goodCount} goods...");
        $this->createGoods($this->goodCount, $categoryIds, $providerIds);
        $this->stdout(" ok\n");

        $this->stdout("All jobs done\n");

        return ExitCode::OK;
    }

    /**
     * @param int $count
     * @return array
     * @throws \Exception
     */
    protected function createCategories(int $count): array
    {
        $ids = [];

        for ($i = 0; $i < $count; $i++) {
            $category = new Category();
            $category->name = $this->getFaker()->name;
            $category->description = $this->getFaker()->text;
            $category->is_visible = random_int(0, 1);
            $category->sort = 0;
            $category->save();
            $ids[] = $category->id;
        }

        return $ids;
    }

    /**
     * @param int $count
     * @return array
     */
    protected function createProviders(int $count): array
    {
        $ids = [];

        for ($i = 0; $i < $count; $i++) {
            $provider = new Provider();
            $provider->name = $this->getFaker()->name;
            $provider->sort = 0;
            $provider->save();
            $ids[] = $provider->id;
        }

        return $ids;
    }

    /**
     * @param int $count
     * @param array $categoryIds
     * @param array $providerIds
     * @return array
     * @throws \Exception
     */
    protected function createGoods(int $count, array $categoryIds, array $providerIds): array
    {
        $ids = [];

        for ($i = 0; $i < $count; $i++) {
            $good = new Good();
            $good->category_id = $categoryIds[random_int(0, count($categoryIds) - 1)];
            $good->provider_id = $providerIds[random_int(0, count($providerIds) - 1)];
            $good->name = $this->getFaker()->name;
            $good->description = $this->getFaker()->text;
            $good->price = $this->getFaker()->randomFloat(2, 0, 100000);
            $good->image = '';
            $good->sort = 0;
            $good->save();
            $ids[] = $good->id;
        }

        return $ids;
    }

    /**
     * Truncate all data.
     */
    protected function truncate(): void
    {
        Good::deleteAll();
        Provider::deleteAll();
        Category::deleteAll();
    }

    private $faker;

    /**
     * @return \Faker\Generator
     */
    protected function getFaker(): \Faker\Generator
    {
        if ($this->faker === null) {
            $this->faker = \Faker\Factory::create();
        }

        return $this->faker;
    }
}
