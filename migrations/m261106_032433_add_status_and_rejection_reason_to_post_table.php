<?php

use yii\db\Migration;

class m261106_032433_add_status_and_rejection_reason_to_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('post', 'status', $this->string(20)->notNull()->defaultValue('draft'));
        $this->addColumn('post', 'rejection_reason', $this->text()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('post', 'rejection_reason');
        $this->dropColumn('post', 'status');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m261106_032433_add_status_and_rejection_reason_to_post_table cannot be reverted.\n";

        return false;
    }
    */
}
