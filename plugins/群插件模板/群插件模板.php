<?php
/*
 * @Author: hujiayucc
 * @Date: 2022-08-03 11:55:13
 * @Description: 群插件模板
 */

require_once("../Lib/init.php");

function 关键词撤回($robot, $group, $toqq, $msg, $req, $random)
{
    if ($msg == "hujiayucc" )
        API::撤回消息($robot, 消息类型_群聊消息, $toqq, $group, 留空, $random, $req);
}
//group群聊挂载点
addAction('group', '关键词撤回');

function 群关键词回复($robot, $group, $toqq, $msg, $req, $random)
{
    if ($msg == "小宇最帅" && $robot != $toqq)
        API::发送群消息($robot, $group, $msg);
}
addAction('group', '群关键词回复');

function 闪照破解($robot, $group, $toqq, $msg)
{
    $flash = "[flashPic,hash=";
    if ($toqq != $robot) {
        if ($group == 703195149 || $group == 437932024 || $group == 936549039) {
            if (strpos($msg, $flash) !== false) {
                $message = "[@" . $toqq . "] 发送了一张闪照\n\n" . str_replace("flashPic", "pic", $msg);
                API::发送群消息($robot, $group, $message);
            }
        }
    }
}
addAction('group', '闪照破解');
