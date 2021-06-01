<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "food_ingredient".
 *
 * @property int $id
 * @property int|null $food_id
 * @property int|null $ing_id
 *
 * @property Food $food
 * @property Ingredient $ing
 */
class FoodIngredient extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'food_ingredient';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['food_id', 'ing_id'], 'integer'],
            [['food_id'], 'exist', 'skipOnError' => true, 'targetClass' => Food::className(), 'targetAttribute' => ['food_id' => 'id']],
            [['ing_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ingredient::className(), 'targetAttribute' => ['ing_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'food_id' => 'Food ID',
            'ing_id' => 'Ing ID',
        ];
    }

    /**
     * Gets query for [[Food]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFood()
    {
        return $this->hasOne(Food::className(), ['id' => 'food_id']);
    }

    /**
     * Gets query for [[Ing]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIng()
    {
        return $this->hasOne(Ingredient::className(), ['id' => 'ing_id']);
    }
}
