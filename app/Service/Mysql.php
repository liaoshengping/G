<?php


namespace app\Service;


use app\Controller\Build;

class Mysql
{
    public function buildSysMenu(){
        $sql = <<<TEXT
CREATE TABLE `sys_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(255) NOT NULL COMMENT '菜单名',
  `pid` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL,
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '类型|1.后台,2.前台',
  `url` varchar(255) NOT NULL COMMENT '连接地址',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `is_url` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否url|1.是2.否',
  `class` varchar(10) NOT NULL COMMENT '属于',
  `is_hide` tinyint(1) NOT NULL DEFAULT '0' COMMENT '隐藏|1.是,0.否',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=168 DEFAULT CHARSET=utf8mb4 COMMENT='我是注释';
TEXT;
        return  (new Build())->PDO()->query($sql);
    }

}
