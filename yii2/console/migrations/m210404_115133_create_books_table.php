<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%books}}`.
 */
class m210404_115133_create_books_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%books}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(140)->notNull(),
            'ibsn' => $this->integer(20)->notNull(),
            'publishedDate' => $this->dateTime(),
            'shortDescription' => $this->text(),
            'longDescription'=> $this->text(),
            'status' => $this->string(15),
        ]);
    }



    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%books}}');
    }
}
