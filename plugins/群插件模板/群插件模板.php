<?php
/*
 * @Author: hujiayucc
 * @Date: 2022-08-03 11:55:13
 * @Description: 群插件模板
 */

require_once("../Lib/init.php");

function 关键词撤回($robot, $group, $toqq, $msg, $req, $random)
{
    if ($msg == "23333")
        API::撤回消息($robot, 消息类型_群聊消息, $toqq, $group, 留空, $random, $req);
}
//group群聊挂载点
addAction('group', '关键词撤回');

function 群关键词回复($robot, $group, $toqq, $msg, $req, $random)
{
    if ($msg == "123")
        API::发送群消息($robot, $group, "666");
}
addAction('group', '群关键词回复');
