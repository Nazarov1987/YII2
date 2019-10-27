<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property string $price
 * @property int $created_at
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    public static function tableName()
    {
        return 'product';
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_DEFAULT => ['name'],
            self::SCENARIO_CREATE => ['name', 'price', 'created_at'],
            self::SCENARIO_UPDATE => ['!name', 'price', 'created_at'],
    ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price', 'created_at'], 'required'],
            [['created_at'], 'integer'],
            [['name'], 'string', 'max' => 19],
            [['price'], 'integer', 'min' => 1,'max' => 999],
            [['name'], 'filter', 'filter' => 'trim', 'filter' => function($value){
                return strip_tags($value);
            }],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'price' => 'Цена',
            'created_at' => 'Дата создания',
        ];
    }
}
