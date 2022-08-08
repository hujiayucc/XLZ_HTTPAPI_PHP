<?php
/*
 * @Author: hujiayucc
 * @Date: 2022-08-05 11:59:32
 * @Description: 事件插件模板
 */

function 防撤回(int $robbot, int $group, int $toqq, string $type, string $msg)
{
    if ($robbot != $toqq && $type == "群事件_某人撤回事件") {
        $message = 文本代码::艾特($toqq) . "撤回了一条消息\n\n" . $msg;
        API::发送群消息($robbot, $group, $message);
    }
}
//event事件挂载点
addAction('event', '防撤回');

function 禁言嘲讽(int $robbot, int $group, int $toqq, string $type)
{
    if ($type == "群事件_某人被禁言")
        API::发送群消息($robbot, $group, 文本代码::艾特($toqq) . "叼毛被禁言了吧，我们一起嘲笑他！");

    if ($type == "群事件_某人被解除禁言")
        API::发送群消息($robbot, $group, 文本代码::艾特($toqq) . "饶你一条狗命，看你下次还敢不敢");
}
addAction('event', '禁言嘲讽');
