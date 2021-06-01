<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%food}}`.
 */
class m210601_193636_create_food_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%food}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'img' => $this->text(),
            'active' => $this->tinyInteger(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%food}}');
    }
}
