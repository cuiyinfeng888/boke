<?php

use yii\db\Migration;

class m170210_024739_quest extends Migration
{
    public function up()
    {
          $sql =<<<str
             create  index t on quest(title);
str;
        Yii::$app->db->createCommand($sql)->execute();
    }

    public function down()
    {
        echo "m170210_024739_quest cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
