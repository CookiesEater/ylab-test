<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%good}}".
 *
 * @property string $id
 * @property string $category_id
 * @property string $provider_id
 * @property string $name
 * @property string $description
 * @property double $price
 * @property string $image
 * @property string $sort
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Category $category
 * @property Provider $provider
 */
class Good extends \yii\db\ActiveRecord
{
    protected const IMAGE_PATH_ALIAS = '@webroot/uploads/goods';
    protected const IMAGE_URL_ALIAS = '@web/uploads/goods';

    public $imageTemp;

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%good}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['category_id', 'provider_id', 'name', 'description', 'price'], 'required'],
            [['description'], 'string'],
            [['price'], 'number'],
            ['name', 'string', 'max' => 255],
            [['category_id'], 'exist', 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['provider_id'], 'exist', 'targetClass' => Provider::class, 'targetAttribute' => ['provider_id' => 'id']],
            ['imageTemp', 'image'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'category_id' => 'Категория',
            'provider_id' => 'Поставщик',
            'name' => 'Название',
            'description' => 'Описание',
            'price' => 'Цена',
            'image' => 'Изображение',
            'imageTemp' => 'Изображение',
            'sort' => 'Сортировка',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors(): array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert): bool
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        $file = UploadedFile::getInstance($this, 'imageTemp');
        if ($file !== null) {
            $old = Yii::getAlias(self::IMAGE_PATH_ALIAS) . '/' . $this->image;
            if (is_file($old)) {
                unlink($old);
            }
            $name = substr(md5(time()), 0, 10) . '.' . $file->getExtension();
            $file->saveAs(Yii::getAlias(self::IMAGE_PATH_ALIAS) . '/' . $name);
            $this->image = $name;
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function beforeDelete(): bool
    {
        if (!parent::beforeDelete()) {
            return false;
        }

        $file = Yii::getAlias(self::IMAGE_PATH_ALIAS) . '/' . $this->image;
        if (is_file($file)) {
            unlink($file);
        }

        return true;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvider(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Provider::class, ['id' => 'provider_id']);
    }

    /**
     * Return url to good image.
     * @return string
     */
    public function getImageUrl(): string
    {
        if (!$this->image) {
            return '';
        }

        return Yii::getAlias(self::IMAGE_URL_ALIAS . '/' . $this->image);
    }

    /**
     * @return GoodQuery
     */
    public static function find(): GoodQuery
    {
        return new GoodQuery(static::class);
    }
}
