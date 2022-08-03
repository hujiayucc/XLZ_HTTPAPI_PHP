<?php
/*
 * @Author: hujiayucc
 * @Date: 2022-08-03 07:01:18
 * @Description: 私聊插件模板
 */

require_once("../Lib/init.php");

function 关键词回复($robot, $toqq, $msg)
{
    if ($toqq == 2792607647) {
        API::发送好友消息($robot,$toqq,$msg);
    }
}
//private私聊挂载点
addAction('private','关键词回复');
