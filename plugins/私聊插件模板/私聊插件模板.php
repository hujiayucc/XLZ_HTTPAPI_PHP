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
        API::发送好友消息($robot, $toqq, $msg);
    }
}
//private私聊挂载点
addAction('private', '关键词回复');

function 通知主人($robot, $toqq, $msg, $nickname)
{
    //定义主人QQ
    $master = 2792607647;
    //所有私信消息通知主人QQ
    if ($toqq != $master) {
        $message = $nickname . "(" . $toqq . ") 发送了一条消息\n" . $msg;
        API::发送好友消息($robot, $master, $message);
    }

    if ($toqq == $master) {
        $qq = Text::getSubstr($msg, "回复#", "#");
        $message = Text::getRightstr($msg, $qq . "#");
        API::发送好友消息($robot, (int)$qq, $message);
    }
}
addAction('private', '通知主人');
