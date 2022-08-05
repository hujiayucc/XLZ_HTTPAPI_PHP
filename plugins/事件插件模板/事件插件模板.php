<?php
/*
 * @Author: hujiayucc
 * @Date: 2022-08-05 11:59:32
 * @Description: 事件插件模板
 */

function 防撤回(int $robbot, int $group, int $toqq, string $type, string $msg)
{
    if ($group == 703195149 || $group == 437932024 && $type == "群事件_某人撤回事件" && $toqq != 1299881001) {
        $message = "[@" . $toqq . "] 撤回了一条消息\n\n" . $msg;
        API::发送群消息($robbot, $group, $message);
    }
}
//event事件挂载点
addAction('event', '防撤回');
