<?php
/*
 * @Author: hujiayucc
 * @Date: 2022-08-03 11:55:13
 * @Description: 群插件模板
 */

require_once("../Lib/init.php");

function 关键词撤回($robot, $group, $toqq, $msg, $req, $random)
{
    if ($msg == "hujiayucc")
        API::撤回消息($robot, 消息类型_群聊消息, $toqq, $group, 留空, $random, $req);
}
//group群聊挂载点
addAction('group', '关键词撤回');

function 群关键词回复($robot, $group, $toqq, $msg)
{
    //精准回复
    if ($msg == "咕咕咕" && $robot != $toqq && $toqq != 911782632)
        API::发送群消息($robot, $group, $msg);
    //模糊回复，不区分大小写
    if ($group == 942512455 && (strripos($msg, "php") !== false) && $toqq != $robot)
        API::发送群消息($robot, $group, 文本代码::艾特($toqq) . "\n小栗子:https://f.xiaolz.cn/thread-308-1-1.html
        Gitee:https://gitee.com/hujiayucc/XLZ_HTTPAPI_PHP
        GitHub:https://github.com/hujiayucc/XLZ_HTTPAPI_PHP");
    if ($msg == "清屏" && $robot != $toqq && $toqq == 2792607647)
        API::发送群消息($robot, $group, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n");
    if ($msg == "device status" && $toqq == 2792607647) {
        $os = php_uname('s') . " " . php_uname('r');
        exec("wmic cpu get Name", $cpu);
        exec("wmic cpu get loadpercentage", $cpuusage);
        exec("wmic os get TotalVisibleMemorySize", $memorys);
        exec("wmic os get FreePhysicalMemory", $memory);
        $memoryusage = (int)$memorys[1] - (int)$memory[1];
        $java = $_SERVER['JAVA_HOME'];
        $message = "OS: " . $os . "\n" .
            "CPU: " . $cpu[1] . "\n" .
            "CPU USAGE: " . $cpuusage[1] . "%\n" .
            "Memory: " . $memoryusage . "/" . $memorys[1] . "  " . number_format($memoryusage / (int)$memorys[1] * 100) . "%\n" .
            "JAVA_HOME: " . $java;
        API::发送群消息($robot, $group, $message);
    }
}
addAction('group', '群关键词回复');

function 闪照破解($robot, $group, $toqq, $msg)
{
    $flash = "[flashPic,hash=";
    if ($toqq != $robot) {
        if ($group == 703195149 || $group == 437932024 || $group == 936549039 || $group == 590201901) {
            if (strpos($msg, $flash) !== false) {
                $message = 文本代码::艾特($toqq) . "发送了一张闪照\n\n" . str_replace("flashPic", "pic", $msg);
                API::发送群消息($robot, $group, $message);
            }
        }
    }
}
addAction('group', '闪照破解');
