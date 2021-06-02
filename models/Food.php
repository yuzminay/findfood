<?php

namespace app\models;

use Yii;
use yii\helpers\FileHelper;

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
    public $imageFile;
    public $ingrsArray = array(); #ingredients array
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
            [['ingrsArray'], 'safe'],
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
            'ingrsArray' => 'Ingredients'
        ];
    }

    public function save($runValidation = true, $attributeNames = null)
    {

        if ($this->imageFile) {
            $this->img = '/foods/' . Yii::$app->security->generateRandomString(16) . '_' . $this->imageFile->name;
        }

        $transaction = Yii::$app->db->beginTransaction();
        $ok = parent::save($runValidation, $attributeNames);

        if ($ok && $this->imageFile) {
            $fullPath = Yii::getAlias('@app/web/storage' . $this->img);
            $dir = dirname($fullPath);
            if (!FileHelper::createDirectory($dir) || !$this->imageFile->saveAs($fullPath)) {
                $transaction->rollBack();
                return false;
            }
        }

        $transaction->commit();
        return $ok;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $this->foodIngsSelection();
    }

    public function foodIngsSelection()
    {
        $ingsId = $this->getIngredients()->select('id')->all();
        $newIngsId = $this->ingrsArray ?: $ingsId;

        foreach (array_filter(array_diff($newIngsId, $ingsId)) as $itemId) :
            if ($item = Ingredient::find()->where(['id' => $itemId])->one()) {
                $this->link('ingredients', $item);
            }
        endforeach;
        foreach (array_filter(array_diff($ingsId, $newIngsId)) as $itemId) :
            if ($item = Ingredient::find()->where(['id' => $itemId])->one())
                $this->unlink('ingredients', $item, true);
        endforeach;
    }

    public function getImageUrl()
    {
        if (!$this->img) {
            return Yii::$app->params['appUrl'] . '/web/img/no-image.jpg';
        }
        return Yii::$app->params['appUrl'] . '/web/storage' . $this->img;
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

    public function getIngredients()
    {
        return $this->hasMany(Ingredient::className(), ['id' => 'ing_id'])
            ->viaTable('food_ingredient', ['food_id' => 'id']);
    }
}
