<?php

namespace common\components;

use yii\helpers\ArrayHelper;

class GroupedColumn extends \yii\grid\DataColumn
{
    /**
     * Grouping value or not.
     * @var bool
     */
    public $grouping = true;

    /**
     * To render filter cell or not.
     * @var bool
     */
    public $filterRender = true;

    /**
     * @inheritdoc
     */
    public function renderFilterCell(): string
    {
        if ($this->filterRender) {
            return parent::renderFilterCell();
        }

        return '';
    }

    /**
     * @inheritdoc
     */
    public function renderDataCell($model, $key, $index): string
    {
        if (!$this->grouping) {
            return parent::renderDataCell($model, $key, $index);
        }

        $current = ArrayHelper::getValue($model, $this->attribute);
        $prev = ArrayHelper::getValue($this->getPrevModel($index), $this->attribute);

        if ($current === $prev) {
            return '';
        }

        $i = $index;
        $rowspan = 1;
        while ($nextModel = $this->getNextModel($i)) {
            $next = ArrayHelper::getValue($nextModel, $this->attribute);
            if ($next !== $current) {
                break;
            }
            $i++;
            $rowspan++;
        }

        if ($rowspan > 1) {
            $this->contentOptions[ 'rowspan' ] = $rowspan;
        } else {
            $this->contentOptions[ 'rowspan' ] = null;
        }

        return parent::renderDataCell($model, $key, $index);
    }

    /**
     * @param $index
     * @return mixed
     */
    protected function getPrevModel(int $index)
    {
        if ($index > 0) {
            return $this->grid->dataProvider->getModels()[$index - 1];
        }

        return null;
    }

    /**
     * @param int $index
     * @return mixed
     */
    protected function getNextModel(int $index)
    {
        $models = $this->grid->dataProvider->getModels();

        return $models[ $index + 1 ] ?? null;
    }
}
