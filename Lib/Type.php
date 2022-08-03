<?php
/*
 * @Author: hujiayucc
 * @Date: 2022-07-31 04:49:46
 * @Description: 数据类型
 */

const 真 = true;
const 假 = false;
const 是 = true;
const 否 = false;
const 留空 = null;

const 语音类型_普通语音 = 0;
const 语音类型_变声语音 = 1;
const 语音类型_文字语音 = 2;
const 语音类型_红包匹配语音 = 3;

const 文件类型_本地 = "path";
const 文件类型_网络 = "url";

const 群权限_发起新的群聊 = "newgroup";
const 群权限_发起临时会话 = "newtempsession";
const 群权限_上传文件 = "uploadfile";
const 群权限_上传图片 = "uploadimage";
const 群权限_邀请好友加群 = "invitefriend";
const 群权限_匿名聊天 = "anonymouschat";
const 群权限_坦白说 = "tanbaishuo";
const 群权限_新成员查看历史消息 = "viewhistmsg";

const 群权限2_邀请方式设置 = "setinviteway";
const 群权限2_限制发言频率 = "limitmsgspd";
const 群权限2_设置群昵称规则 = "setnicknamerule";
const 群权限2_设置群查找方式 = "setsearchway";
const 群权限2_无需审核 = 1;
const 群权限2_需要审核 = 3;
const 群权限2_100人以内无要审核 = 3;
const 群权限2_发言无限制 = 0;
const 群权限2_不允许查找 = 0;
const 群权限2_通过群号和关键词 = 1;
const 群权限2_仅可通过群号 = 2;

const 消息类型_群聊消息 = "group";
const 消息类型_私聊消息 = "private";
const 消息类型_讨论组消息 = "discussion";

const 事件类型_私聊消息 = "privatemsg";
const 事件类型_群聊消息 = "groupmsg";
const 事件类型_事件 = "eventmsg";
const 事件类型_频道推送数据 = "guildpush";