<?php

use yii\db\Migration;

class m170403_072028_wx_user extends Migration
{
    public function up()
    {
        $sql=<<<str
         alter table wx_user add last_update_time varchar(20) NOT NULL DEFAULT '0' COMMENT '最后更新时间';
str;
        Yii::$app->db->createCommand($sql)->execute();
    }

    public function down()
    {
        echo "m170403_072028_wx_user cannot be reverted.\n";

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
