<?php
/*
 * @Author: hujiayucc
 * @Date: 2022-07-26 06:13:38
 * @Description: 小栗子HTTP API SDK For PHP
 */

require_once("init.php");
class API
{

    /**
     * @param string $log 日志文本
     * @param int $textColor 字体颜色
     * @param int $bgColor 背景颜色
     * @return string 访问结果
     */
    public static function 输出日志(string $log, int $textColor = 黑色, int $bgColor = 白色): string
    {
        $array = [
            "log"       =>     $log,
            "textclr"   =>     $textColor,
            "bgclr"     =>     $bgColor
        ];

        $ret = Lib::POST(输出日志, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param int $toqq 对方QQ
     * @param string $msg 消息内容
     * @param string $type xml和json消息，留空为普通消息
     * @return string 处理结果
     */
    public static function 发送好友消息(int $robot, int $toqq, string $msg, string $type = null): string
    {
        $array = [
            "type"      =>     $type,
            "logonqq"   =>     $robot,
            "toqq"      =>     $toqq,
            "msg"       =>     $msg
        ];

        $ret = Lib::POST(发送好友消息, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param int $group 群号
     * @param string $msg 消息内容
     * @param string $type xml和json消息，留空为普通消息
     * @param bool $anonymous 是否匿名（留空为不匿名）
     * @return string 处理结果
     */
    public static function 发送群消息(int $robot, int $group, string $msg, string $type = null, bool $anonymous = false): string
    {
        if ($anonymous)
            $anonymous = "true";
        else
            $anonymous = "false";

        $array = [
            "type"      =>     $type,
            "logonqq"   =>     $robot,
            "group"     =>     $group,
            "msg"       =>     $msg,
            "anonymous" =>     $anonymous
        ];

        $ret = Lib::POST(发送群消息, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param int $group 群号
     * @param int $toqq 对方QQ
     * @param string 消息内容
     * @return string 处理结果
     */
    public static function 发送群临时消息(int $robot, int $group, int $toqq, string $msg): string
    {
        $array = [
            "logonqq"   =>     $robot,
            "group"     =>     $group,
            "toqq"      =>     $toqq,
            "msg"       =>     $msg
        ];

        $ret = Lib::POST(发送群临时消息, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param int $id 讨论组ID
     * @param string $msg 消息内容
     * @param string $type xml和json消息，留空为普通消息
     * @return string 处理结果
     */
    public static function 发送讨论组消息(int $robot, int $id, string $msg, string $type = null): string
    {
        $array = [
            "type"          =>     $type,
            "logonqq"       =>     $robot,
            "discussionid"  =>     $id,
            "msg"           =>     $msg
        ];

        $ret = Lib::POST(发送讨论组消息, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param int $id 讨论组ID
     * @param int $toqq 对方QQ
     * @param string $msg 消息内容
     * @return string 处理结果
     */
    public static function 发送讨论组临时消息(int $robot, int $id, int $toqq, string $msg): string
    {
        $array = [
            "logonqq"       =>     $robot,
            "discussionid"  =>     $id,
            "toqq"          =>     $toqq,
            "msg"           =>     $msg
        ];

        $ret = Lib::POST(发送讨论组临时消息, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param int $toqq 对方QQ
     * @param string $msg 验证消息
     * @param string $remark 备注
     * @return string 处理结果
     */
    public static function 添加好友(int $robot, int $toqq, string $msg, string $remark): string
    {
        $array = [
            "logonqq"   =>     $robot,
            "toqq"      =>     $toqq,
            "msg"       =>     $msg,
            "remark"    =>     $remark
        ];

        $ret = Lib::POST(添加好友, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param int $group 群号
     * @param string $msg 消息文本
     * @return string 处理结果
     */
    public static function 添加群(int $robot, int $group, string $msg): string
    {
        $array = [
            "logonqq"   =>     $robot,
            "group"     =>     $group,
            "msg"       =>     $msg
        ];

        $ret = Lib::POST(添加群, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param int $toqq 对方QQ
     * @return string 处理结果
     */
    public static function 删除好友(int $robot, int $toqq): string
    {
        $array = [
            "logonqq"   =>     $robot,
            "toqq"      =>     $toqq
        ];

        $ret = Lib::POST(删除好友, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param int $toqq 对方QQ
     * @param bool $block 是否屏蔽（可空）
     * @return string 处理结果
     */
    public static function 置屏蔽好友(int $robot, int $toqq, bool $block = true): string
    {
        if ($block)
            $block = "true";
        else
            $block = "false";

        $array = [
            "logonqq"   =>     $robot,
            "toqq"      =>     $toqq,
            "isblock"   =>     $block
        ];

        $ret = Lib::POST(置屏蔽好友, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param int $toqq 对方QQ
     * @param bool $care 是否特别关心（可空）
     * @return string 处理结果
     */
    public static function 置特别关心好友(int $robot, int $toqq, bool $care = true): string
    {
        if ($care)
            $care = "true";
        else
            $care = "false";

        $array = [
            "logonqq"   =>     $robot,
            "toqq"      =>     $toqq,
            "iscare"    =>     $care
        ];

        $ret = Lib::POST(置特别关心好友, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param int $toqq 对方QQ
     * @param string $pic 本地路径或图片URL 
     * @param string $type path:本地路径 url:网络路径 
     * @param bool $flash 是否闪照（可空）
     * @param bool $gif 是否动图（可空）
     * @return string 处理结果
     */
    public static function 上传好友图片(int $robot, int $toqq, string $pic, string $type, bool $flash = false, bool $gif = false)
    {
        switch ($type) {
            case 文件类型_网络:
                break;
            case 文件类型_本地:
                break;
            default:
                return "type参数错误";
                break;
        };

        if ($flash)
            $flash = "true";
        else
            $flash = "false";

        if ($gif)
            $gif = "true";
        else
            $gif = "false";

        $array = [
            "logonqq"   =>     $robot,
            "toqq"      =>     $toqq,
            "isflash"   =>     $flash,
            "pic"       =>     $pic,
            "type"      =>     $type
        ];

        $ret = Lib::POST(上传好友图片, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param int $group 群号
     * @param string $pic 本地路径或图片URL 
     * @param string $type path:本地路径 url:网络路径 
     * @param bool $flash 是否闪照（可空）
     * @param bool $gif 是否动图（可空）
     * @return string 处理结果
     */
    public static function 上传群图片(int $robot, int $group, string $pic, string $type, bool $flash = false, bool $gif = false)
    {
        switch ($type) {
            case 文件类型_网络:
                break;
            case 文件类型_本地:
                break;
            default:
                return "type参数错误";
                break;
        };

        if ($flash)
            $flash = "true";
        else
            $flash = "false";

        if ($gif)
            $gif = "true";
        else
            $gif = "false";

        $array = [
            "logonqq"   =>     $robot,
            "group"     =>     $group,
            "isflash"   =>     $flash,
            "pic"       =>     $pic,
            "type"      =>     $type
        ];

        $ret = Lib::POST(上传群图片, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param int $toqq 对方QQ
     * @param int $audiotype 语音类型
     * @param string $text 语音文字（可空）
     * @param string $type path:本地路径 url:网络路径
     * @param string $audio 本地路径或语音URL
     * @return string 处理结果
     */
    public static function 上传好友语音(int $robot, int $toqq, int $audiotype = 语音类型_普通语音, string $text = null, string $type, string $audio): string
    {
        switch ($type) {
            case 文件类型_网络:
                break;
            case 文件类型_本地:
                break;
            default:
                return "type参数错误";
                break;
        };

        $array = [
            "logonqq"       =>     $robot,
            "toqq"          =>     $toqq,
            "audiotype"     =>     $audiotype,
            "audio"         =>     $audio,
            "type"          =>     $type,
            "text"          =>     $text
        ];

        $ret = Lib::POST(上传好友语音, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param int $group 群号 
     * @param int $audiotype 语音类型
     * @param string $text 语音文字（可空）
     * @param string $type path:本地路径 url:网络路径
     * @param string $audio 本地路径或语音URL
     * @return string 处理结果
     */
    public static function 上传群语音(int $robot, int $group, int $audiotype = 语音类型_普通语音, string $text = null, string $type, string $audio): string
    {
        switch ($type) {
            case 文件类型_网络:
                break;
            case 文件类型_本地:
                break;
            default:
                return "type参数错误";
                break;
        };

        $array = [
            "logonqq"       =>     $robot,
            "group"         =>     $group,
            "audiotype"     =>     $audiotype,
            "audio"         =>     $audio,
            "type"          =>     $type,
            "text"          =>     $text
        ];

        $ret = Lib::POST(上传群语音, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param string $type path:本地路径 url:网络路径
     * @param string $pic 本地路径或图片URL
     * @return string 处理结果
     */
    public static function 上传头像(int $robot, string $type, string $pic): string
    {
        switch ($type) {
            case 文件类型_网络:
                break;
            case 文件类型_本地:
                break;
            default:
                return "type参数错误";
                break;
        };

        $array = [
            "logonqq"   =>     $robot,
            "type"      =>     $type,
            "pic"       =>     $pic
        ];

        $ret = Lib::POST(上传头像, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param int $group 群号
     * @param string 群名片
     * @return string 处理结果
     */
    public static function 设置群名片(int $robot, int $group, string $card): string
    {
        $array = [
            "logonqq"   =>     $robot,
            "group"     =>     $group,
            "newcard"   =>     $card
        ];

        $ret = Lib::POST(设置群名片, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param int $toqq 对方QQ
     * @param bool $cache 是否从缓存中获取
     * @return string 昵称
     */
    public static function 取昵称(int $robot, int $toqq, bool $cache = false): string
    {
        if ($cache)
            $cache = "true";
        else
            $cache = "false";

        $array = [
            "logonqq"   =>     $robot,
            "toqq"      =>     $toqq,
            "fromcache" =>     $cache
        ];

        $ret = Lib::POST(取昵称, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @return string skey
     */
    public static function 获取skey(int $robot): string
    {
        $array = [
            "logonqq"   =>     $robot
        ];

        $ret = Lib::POST(获取skey, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param string $domain 域
     * @return string pskey
     */
    public static function 获取pskey(int $robot, string $domain): string
    {
        $array = [
            "logonqq"   =>     $robot,
            "domain"    =>     $domain
        ];

        $ret = Lib::POST(获取pskey, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @return string clientkey
     */
    public static function 获取clientkey(int $robot): string
    {
        $array = [
            "logonqq"   =>     $robot
        ];

        $ret = Lib::POST(获取clientkey, $array);
        return $ret;
    }

    /**
     * @return string 框架QQ
     * @return string 框架QQ数据
     */
    public static function 取框架QQ(): string
    {
        $array = [];
        $ret = Lib::POST(取框架QQ, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @return string 好友列表
     */
    public static function 取好友列表(int $robot): string
    {
        $array = [
            "logonqq"   =>     $robot
        ];

        $ret = Lib::POST(取好友列表, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @return string 群列表
     */
    public static function 取群列表(int $robot): string
    {
        $array = [
            "logonqq"   =>     $robot
        ];

        $ret = Lib::POST(取群列表, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param int $group 群号
     * @return string 群成员列表
     */
    public static function 取群成员列表(int $robot, int $group): string
    {
        $array = [
            "logonqq"   =>     $robot,
            "group"     =>     $group
        ];

        $ret = Lib::POST(取群成员列表, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param int $group 群号
     * @param int $toqq 对方QQ
     * @param bool $unadmin 是否取消管理员
     * @return string 处理结果
     */
    public static function 设置管理员(int $robot, int $group, int $toqq, bool $unadmin = false): string
    {
        if ($unadmin)
            $unadmin = "true";
        else
            $unadmin = "false";

        $array = [
            "logonqq"   =>     $robot,
            "group"     =>     $group,
            "toqq"      =>     $toqq,
            "unadmin"   =>     $unadmin
        ];

        $ret = Lib::POST(设置管理员, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param int $group 群号
     * @param string 处理结果
     */
    public static function 取群管理层列表(int $robot, int $group): string
    {
        $array = [
            "logonqq"   =>     $robot,
            "group"     =>     $group
        ];

        $ret = Lib::POST(取群管理层列表, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param int $group 群号
     * @param int $toqq 对方QQ
     * @return string 群名片
     */
    public static function 取群名片(int $robot, int $group, int $toqq): string
    {
        $array = [
            "logonqq"   =>     $robot,
            "group"     =>     $group,
            "toqq"      =>     $toqq
        ];

        $ret = Lib::POST(取群名片, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param int $toqq 对方QQ
     * @return string 个性签名
     */
    public static function 取个性签名(int $robot, int $toqq): string
    {
        $array = [
            "logonqq"   =>     $robot,
            "toqq"      =>     $toqq
        ];

        $ret = Lib::POST(取个性签名, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param string $nickname 昵称
     * @return string 处理结果
     */
    public static function 修改昵称(int $robot, string $nickname): string
    {
        $array = [
            "logonqq"   =>     $robot,
            "nickname"  =>     $nickname
        ];

        $ret = Lib::POST(修改昵称, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param string $signat 签名
     * @param string $pos 签名地点
     */
    public static function 修改个性签名(int $robot, string $signat, string $pos): string
    {
        $array = [
            "logonqq"   =>     $robot,
            "signat"    =>     $signat,
            "pos"       =>     $pos
        ];

        $ret = Lib::POST(修改个性签名, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param int $group 群号
     * @param int $toqq 对方QQ
     * @param bool $ignoreaddgrequest 是否拒绝加群
     */
    public static function 删除群成员(int $robot, int $group, int $toqq, bool $ignoreaddgrequest): string
    {
        if ($ignoreaddgrequest)
            $ignoreaddgrequest = "true";
        else
            $ignoreaddgrequest = "false";

        $array = [
            "logonqq"               =>     $robot,
            "group"                 =>     $group,
            "toqq"                  =>     $toqq,
            "ignoreaddgrequest"     =>     $ignoreaddgrequest
        ];

        $ret = Lib::POST(删除群成员, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param int $group 群号
     * @param int $toqq 对方QQ
     * @param int $time 禁言时长
     * @return string 禁言结果
     */
    public static function 禁言群成员(int $robot, int $group, int $toqq, int $time): string
    {
        $array = [
            "logonqq"   =>     $robot,
            "group"     =>     $group,
            "toqq"      =>     $toqq,
            "time"      =>     $time
        ];

        $ret = Lib::POST(禁言群成员, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param int $group 群号
     * @param bool $dismiss 是否解散
     * @return string 处理结果
     */
    public static function 退群(int $robot, int $group, bool $dismiss = false): string
    {
        if ($dismiss)
            $dismiss = "true";
        else
            $dismiss = "false";

        $array = [
            "logonqq"   =>     $robot,
            "group"     =>     $group,
            "dismiss"   =>     $dismiss
        ];

        $ret = Lib::POST(退群, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param int $group 群号
     * @param string $type path:本地路径 url:网络路径
     * @param string $pic 本地路径或图片URL
     * @return string 处理结果
     */
    public static function 上传群头像(int $robot, int $group, string $type, string $pic): string
    {
        switch ($type) {
            case 文件类型_网络:
                break;
            case 文件类型_本地:
                break;
            default:
                return "type参数错误";
                break;
        };

        $array = [
            "logonqq"   =>     $robot,
            "group"     =>     $group,
            "type"      =>     $type,
            "pic"       =>     $pic
        ];

        $ret = Lib::POST(上传群头像, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param int $group 群号
     * @param bool $ismute 是否禁言
     * @return string 处理结果
     */
    public static function 全员禁言(int $robot, int $group, bool $ismute = true): string
    {
        if ($ismute)
            $ismute = "true";
        else
            $ismute = "false";

        $array = [
            "logonqq"   =>     $robot,
            "group"     =>     $group,
            "ismute"    =>     $ismute
        ];

        $ret = Lib::POST(全员禁言, $array);
        return $ret;
    }

    /**
     * @param string $type 群权限常量（群权限_XXX）
     * @param bool $isallow 是否允许
     */
    public static function 设置群权限(string $type, bool $isallow): string
    {
        if ($isallow)
            $isallow = "true";
        else
            $isallow = "false";

        switch ($type) {
            case 群权限_发起新的群聊:
                break;
            case 群权限_发起临时会话:
                break;
            case 群权限_上传文件:
                break;
            case 群权限_上传图片:
                break;
            case 群权限_邀请好友加群:
                break;
            case 群权限_匿名聊天:
                break;
            case 群权限_坦白说:
                break;
            case 群权限_新成员查看历史消息:
                break;
            default:
                return "type参数错误";
                break;
        }

        $array = [
            "type"      =>     $type,
            "isallow"   =>     $isallow
        ];

        $ret = Lib::POST(设置群权限, $array);
        return $ret;
    }

    /**
     * @param string $type 群权限2_XXX
     * @param int|string $value 除昵称规则外，都可用 "群权限2_XXX"
     * @return string 处理结果
     */
    public static function 设置群权限2(string $type, $value): string
    {
        switch ($type) {
            case 群权限2_邀请方式设置:
                if ($value == 群权限2_无需审核) {
                } elseif ($value == 群权限2_需要审核) {
                } elseif ($value == 群权限2_100人以内无要审核) {
                } else return "value参数错误";
                break;
            case 群权限2_限制发言频率:
                if (is_int($value)) {
                } else return "请以int类型传入value参数";
                break;
            case 群权限2_设置群昵称规则:
                if (is_string($value)) {
                    $value = Text::Ucs2Code($value);
                } else return "请以string类型传入value参数";
                break;
            case 群权限2_设置群查找方式:
                if ($value == 群权限2_不允许查找) {
                } elseif ($value == 群权限2_通过群号和关键词) {
                } elseif ($value == 群权限2_仅可通过群号) {
                } else return "value参数错误";
                break;
            default:
                return "type参数错误";
                break;
        };

        $array = [
            "type"     =>     $type,
            "value"    =>     $value
        ];

        $ret = Lib::POST(设置群权限2, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param string $type 消息类型_XXX
     * @param int $toqq 对方QQ，撤回消息为私聊消息时填写
     * @param int $group 群号，撤回消息为群聊消息时填写
     * @param int $discussionid 讨论组ID，撤回消息为讨论组消息时填写
     * @param int $random 消息random
     * @param int $req 消息req
     * @param int $time 消息time，撤回消息为私聊消息时填写
     * @return string 处理结果
     */
    public static function 撤回消息(int $robot, string $type, int $toqq = null, int $group = null, int $discussionid = null, int $random, int $req, int $time = null): string
    {
        switch ($type) {
            case 消息类型_私聊消息:
                if ($toqq == null) return "toqq参数错误";
                if ($time == null) return "time参数错误";
                break;
            case 消息类型_群聊消息:
                if ($group == null) return "group参数错误";
                break;
            case 消息类型_讨论组消息:
                if ($discussionid == null) return "discussionid参数错误";
                break;
            default:
                return "type参数错误";
                break;
        };

        $array = [
            "logonqq"       =>     $robot,
            "type"          =>     $type,
            "toqq"          =>     $toqq,
            "group"         =>     $group,
            "discussionid"  =>     $discussionid,
            "random"        =>     $random,
            "req"           =>     $req,
            "time"          =>     $time
        ];

        $ret = Lib::POST(撤回消息, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param int $group 群号
     * @param string $long 经度
     * @param string $lat 纬度
     * @param bool $enable 是否开启
     * @return string 处理结果
     */
    public static function 设置位置共享(int $robot, int $group, string $long = null, string $lat = null, bool $enable = 真): string
    {
        if ($enable) {
            if ($long == null) return "long参数错误";
            if ($lat == null) return "lat参数错误";
            $enable = "true";
        } else {
            $enable = "false";
        }

        $array = [
            "logonqq"   =>     $robot,
            "group"     =>     $group,
            "long"      =>     $long,
            "lat"       =>     $lat,
            "enable"    =>     $enable
        ];

        $ret = Lib::POST(设置位置共享, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param int $group 群号
     * @param string $long 经度
     * @param string $lat 纬度
     * @param bool $enable 是否开启
     * @return string 处理结果
     */
    public static function 上报当前位置(int $robot, int $group, string $long, string $lat): string
    {
        $array = [
            "logonqq"   =>     $robot,
            "group"     =>     $group,
            "long"      =>     $long,
            "lat"       =>     $lat,
        ];

        $ret = Lib::POST(上报当前位置, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param int $group 群号
     * @return string 禁言时长
     */
    public static function 取禁言时长(int $robot, int $group): string
    {
        $array = [
            "logonqq"   =>     $robot,
            "group"     =>     $group
        ];

        $ret = Lib::POST(取禁言时长, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param int $group 群号
     * @param int $seq 消息seq
     * @param int $allow 操作类型，群事件验证_XXX
     * @param int $eventtype 事件类型，群事件类型_我被邀请进群_XXX
     * @param string $reason 拒绝理由
     * @param bool $isrisk 是否为风险号
     * @return string 处理结果
     */
    public static function 处理群验证事件(int $robot, int $group, int $fromqq, int $seq, int $allow, int $eventtype, string $reason = null, bool $isrisk = false): string
    {
        switch ($allow) {
            case 群事件验证_同意:
                break;
            case 群事件验证_拒绝:
                break;
            case 群事件验证_忽略:
                break;
            default:
                return "allow参数错误";
                break;
        };

        switch ($eventtype) {
            case 群事件类型_我被邀请进群:
                break;
            case 群事件类型_某人申请加群:
                break;
            default:
                return "eventtype参数错误";
                break;
        };
        if($isrisk)
            $isrisk = "true";
        else
            $isrisk = "false";

        $array = [
            "logonqq"       =>    $robot,
            "group"         =>    $group,
            "fromqq"        =>    $fromqq,
            "seq"           =>    $seq,
            "optype"        =>    $allow,
            "eventtype"     =>    $eventtype,
            "reason"        =>    $reason,
            "isrisk"        =>    $isrisk
        ];

        $ret = Lib::POST(处理群验证事件, $array);
        return $ret;
    }
}
