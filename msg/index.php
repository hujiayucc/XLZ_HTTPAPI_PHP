<?php
/*
 * @Author: hujiayucc
 * @Date: 2022-08-02 10:01:47
 * @Description: 事件回调 http(s)://127.0.0.1/msg/
 */

require_once("../Lib/init.php");
//Header校验
if ($_SERVER["CONTENT_TYPE"] != CONTENT_TYPE) exit(header("HTTP/1.1 404 Not Found"));
$msg = json_decode(file_get_contents("php://input"));
$msgtype = $msg->type;
switch ($msgtype) {
    case 事件类型_私聊消息:
        事件类型_私聊消息($msg);
        break;
    case 事件类型_群聊消息:
        事件类型_群聊消息($msg);
        break;
    case 事件类型_事件:
        事件类型_事件($msg);
        break;
    case 事件类型_频道推送数据:
        # code...
        break;
    default:
        header("HTTP/1.1 404 Not Found");
        break;
}

function 事件类型_私聊消息($msg)
{
    define('私聊_框架QQ', $msg->logonqq);
    define('私聊_消息QQ', $msg->fromqq->qq);
    define('私聊_消息内容', $msg->msg->text);
    doAction('private', 私聊_框架QQ, 私聊_消息QQ, 私聊_消息内容);
}

function 事件类型_群聊消息($msg)
{
    define('群聊_框架QQ', $msg->logonqq);
    define('群聊_消息群号', $msg->fromgroup->group);
    define('群聊_消息QQ', $msg->fromqq->qq);
    define('群聊_消息内容', $msg->msg->msg);
    define('群聊_消息Req', $msg->msg->req);
    define('群聊_消息Random', $msg->msg->random);
    doAction('group', 群聊_框架QQ, 群聊_消息群号, 群聊_消息QQ, 群聊_消息内容, 群聊_消息Req, 群聊_消息Random);
}

function 事件类型_事件($msg)
{
    define('事件_框架QQ', $msg->logonqq);
    define('事件_事件群号', $msg->fromgroup->group);
    define('事件_事件QQ', $msg->fromqq->qq);
    define('事件_事件类型', getEventType($msg->msg->type));
    API::发送好友消息(事件_框架QQ, 2792607647, 事件_事件类型);
}
//API::发送好友消息($msg->logonqq, 2792607647, file_get_contents("php://input"));