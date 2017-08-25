<?php

use yii\db\Migration;

class m170210_080831_admin extends Migration
{
    public function up()
    {
        $sql =<<<str
     insert into admin set username = 'cyfwebadmin',password='cyfweb19900329',userType = 1;
str;
        Yii::$app->db->createCommand($sql)->execute();
    }

    public function down()
    {
        echo "m170210_080831_admin cannot be reverted.\n";

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
