<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%booksCategories}}`.
 */
class m210404_121532_create_booksCategories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%booksCategories}}', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer(),
            'category_id'=> $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%booksCategories}}');
    }
}
