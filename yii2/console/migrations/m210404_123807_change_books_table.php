<?php

use yii\db\Migration;

/**
 * Class m210404_123807_change_books_table
 */
class m210404_123807_change_books_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('books', 'pageCount', $this->integer()->after('ibsn'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210404_123807_change_books_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210404_123807_change_books_table cannot be reverted.\n";

        return false;
    }
    */
}
