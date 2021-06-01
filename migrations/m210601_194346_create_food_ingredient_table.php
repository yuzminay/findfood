<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%food_ingredient}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%food}}`
 * - `{{%ingredient}}`
 */
class m210601_194346_create_food_ingredient_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%food_ingredient}}', [
            'id' => $this->primaryKey(),
            'food_id' => $this->integer(),
            'ing_id' => $this->integer(),
        ]);

        // creates index for column `food_id`
        $this->createIndex(
            '{{%idx-food_ingredient-food_id}}',
            '{{%food_ingredient}}',
            'food_id'
        );

        // add foreign key for table `{{%food}}`
        $this->addForeignKey(
            '{{%fk-food_ingredient-food_id}}',
            '{{%food_ingredient}}',
            'food_id',
            '{{%food}}',
            'id',
            'CASCADE'
        );

        // creates index for column `ing_id`
        $this->createIndex(
            '{{%idx-food_ingredient-ing_id}}',
            '{{%food_ingredient}}',
            'ing_id'
        );

        // add foreign key for table `{{%ingredient}}`
        $this->addForeignKey(
            '{{%fk-food_ingredient-ing_id}}',
            '{{%food_ingredient}}',
            'ing_id',
            '{{%ingredient}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%food}}`
        $this->dropForeignKey(
            '{{%fk-food_ingredient-food_id}}',
            '{{%food_ingredient}}'
        );

        // drops index for column `food_id`
        $this->dropIndex(
            '{{%idx-food_ingredient-food_id}}',
            '{{%food_ingredient}}'
        );

        // drops foreign key for table `{{%ingredient}}`
        $this->dropForeignKey(
            '{{%fk-food_ingredient-ing_id}}',
            '{{%food_ingredient}}'
        );

        // drops index for column `ing_id`
        $this->dropIndex(
            '{{%idx-food_ingredient-ing_id}}',
            '{{%food_ingredient}}'
        );

        $this->dropTable('{{%food_ingredient}}');
    }
}
