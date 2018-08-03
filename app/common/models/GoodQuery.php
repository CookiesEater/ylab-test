<?php

namespace common\models;

use yii\db\ActiveQuery;

class GoodQuery extends ActiveQuery
{
    /**
     * @param int $order
     * @return GoodQuery
     */
    public function sortByCategory($order = SORT_ASC): self
    {
        $this->orderBy([ 'category_id' => $order ]);

        return $this;
    }

    /**
     * @param int $order
     * @return GoodQuery
     */
    public function sortByProvider($order = SORT_ASC): self
    {
        $this->orderBy([ 'provider_id' => $order ]);

        return $this;
    }
}
