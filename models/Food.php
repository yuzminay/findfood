<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "food".
 *
 * @property int $id
 * @property string $title
 * @property string|null $img
 * @property int|null $active
 *
 * @property FoodIngredient[] $foodIngredients
 */
class Food extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'food';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['img'], 'string'],
            [['active'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'img' => 'Img',
            'active' => 'Active',
        ];
    }

    /**
     * Gets query for [[FoodIngredients]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFoodIngredients()
    {
        return $this->hasMany(FoodIngredient::className(), ['food_id' => 'id']);
    }
}
