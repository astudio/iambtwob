<?php
/*
說明:MySQL只讀服務器(slave)配置
注意:MySQL讀寫必須使用相同的MySQL版本和數據庫名
示例:
$MYSQLRW = array(
	array('host'=>'192.168.1.10', 'user'=>'root', 'pass'=>'123456'),
	array('host'=>'192.168.1.11', 'user'=>'root', 'pass'=>'123456'),
	array('host'=>'192.168.1.12', 'user'=>'root', 'pass'=>'123456'),
);
*/
$MYSQLRW = array(
	array('host'=>'192.168.1.35', 'user'=>'root', 'pass'=>'123456'),
);
?>