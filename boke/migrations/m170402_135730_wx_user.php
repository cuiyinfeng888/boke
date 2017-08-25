<?php

use yii\db\Migration;

class m170402_135730_wx_user extends Migration
{
    public function up()
    {
         $sql=<<<str
        CREATE TABLE `wx_user` (
          `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
          `subscribe` int(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否关注',
          `openid` varchar(64) NOT NULL DEFAULT '' COMMENT '用户的标识，对当前公众号唯一',
          `nickname` varchar(100) NOT NULL DEFAULT '' COMMENT '用户昵称',
          `sex` int(1) unsigned NOT NULL DEFAULT '1' COMMENT '用户性别 1男性 0女性',
          `language` varchar(20) NOT NULL DEFAULT '' COMMENT '用户语言',
          `city` varchar(20) NOT NULL DEFAULT '' COMMENT '用户城市',
          `province` varchar(20) NOT NULL DEFAULT '' COMMENT '用户省份',
          `country` varchar(20) NOT NULL DEFAULT '' COMMENT '用户国家',
          `headimgurl` varchar(256) NOT NULL DEFAULT '' COMMENT '用户头像',
          `subscribe_time` varchar(20) NOT NULL DEFAULT '' COMMENT '用户关注时间',
          `unionid` varchar(64) NOT NULL DEFAULT '' ,
          `remark` varchar(128) NOT NULL DEFAULT '' COMMENT '公众号运营者对粉丝的备注',
          `groupid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户所在的分组ID',
          `tagid_list` varchar(128) DEFAULT '' COMMENT '用户被打上的标签ID列表',
          PRIMARY KEY (`id`),
          UNIQUE KEY `nickname` (`nickname`) USING BTREE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='关注者信息表';
str;
        Yii::$app->db->createCommand($sql)->execute();
    }

    public function down()
    {
        echo "m170402_135730_wx_user cannot be reverted.\n";

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
