<?php

namespace frontend\models;

use common\models\Good;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

class GoodSearch extends Model
{
    public const GROUP_CATEGORY = 'category_id';
    public const GROUP_PROVIDER = 'provider_id';

    public $id;
    public $name;
    public $description;
    public $group = self::GROUP_PROVIDER;

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            ['id', 'integer'],
            [['name', 'description'], 'string'],
            ['group', 'in', 'range' => [self::GROUP_CATEGORY, self::GROUP_PROVIDER]],
        ];
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = Good::find();
        $query->orderBy([ 'sort' => SORT_ASC ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->addCondition($query, 'id');
        $this->addCondition($query, 'name', true);
        $this->addCondition($query, 'description', true);

        return $dataProvider;
    }

    /**
     * @return bool
     */
    public function isGroupCategory(): bool
    {
        return $this->group === self::GROUP_CATEGORY;
    }

    /**
     * @return bool
     */
    public function isGroupProvider(): bool
    {
        return $this->group === self::GROUP_PROVIDER;
    }

    /**
     * @param ActiveQuery $query
     * @param string $attribute
     * @param bool $partialMatch
     */
    protected function addCondition(ActiveQuery $query, string $attribute, bool $partialMatch = false): void
    {
        $value = $this->{$attribute};
        if (trim($value) === '') {
            return;
        }

        if ($partialMatch) {
            $query->andWhere(['like', $attribute, $value]);
        } else {
            $query->andWhere([$attribute => $value]);
        }
    }
}
