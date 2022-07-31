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
            "log"       => $log,
            "textclr"   => $textColor,
            "bgclr"     => $bgColor
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
            "type"      => $type,
            "logonqq"   => $robot,
            "toqq"      => $toqq,
            "msg"       => $msg
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
            "type"      => $type,
            "logonqq"   => $robot,
            "group"     => $group,
            "msg"       => $msg,
            "anonymous" => $anonymous
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
            "logonqq"   => $robot,
            "group"     => $group,
            "toqq"      => $toqq,
            "msg"       => $msg
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
            "type"          => $type,
            "logonqq"       => $robot,
            "discussionid"  => $id,
            "msg"           => $msg
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
            "logonqq"       => $robot,
            "discussionid"  => $id,
            "toqq"          => $toqq,
            "msg"           => $msg
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
            "logonqq"   => $robot,
            "toqq"      => $toqq,
            "msg"       => $msg,
            "remark"    => $remark
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
            "logonqq"   => $robot,
            "group"     => $group,
            "msg"       => $msg
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
            "logonqq"   => $robot,
            "toqq"      => $toqq
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
            "logonqq"   => $robot,
            "toqq"      => $toqq,
            "isblock"   => $block
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
            "logonqq"   => $robot,
            "toqq"      => $toqq,
            "iscare"    => $care
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
            case "url":
                break;
            case "path":
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
            "logonqq"   => $robot,
            "toqq"      => $toqq,
            "isflash"   => $flash,
            "pic"       => $pic,
            "type"      => $type
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
            case "url":
                break;
            case "path":
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
            "logonqq"   => $robot,
            "group"     => $group,
            "isflash"   => $flash,
            "pic"       => $pic,
            "type"      => $type
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
            case "url":
                break;
            case "path":
                break;
            default:
                return "type参数错误";
                break;
        };
        $array = [
            "logonqq"       => $robot,
            "toqq"          => $toqq,
            "audiotype"     => $audiotype,
            "audio"         => $audio,
            "type"          => $type,
            "text"          => $text
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
            case "url":
                break;
            case "path":
                break;
            default:
                return "type参数错误";
                break;
        };
        $array = [
            "logonqq"       => $robot,
            "group"         => $group,
            "audiotype"     => $audiotype,
            "audio"         => $audio,
            "type"          => $type,
            "text"          => $text
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
            case "url":
                break;
            case "path":
                break;
            default:
                return "type参数错误";
                break;
        };
        $array = [
            "logonqq"   => $robot,
            "type"      => $type,
            "pic"       => $pic
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
            "logonqq"   => $robot,
            "group"     => $group,
            "newcard"   => $card
        ];

        $ret = Lib::POST(设置群名片, $array);
        return $ret;
    }

    /**
     * @param int $robot 框架QQ
     * @param int $toqq 对方QQ
     * @param bool $cache 是否从缓存中获取
     * @return string 处理结果
     */
    public static function 取昵称(int $robot, int $toqq, bool $cache = false): string
    {
        if ($cache)
            $cache = "true";
        else
            $cache = "false";
        
        $array =[
            "logonqq"   => $robot,
            "toqq"      => $toqq,
            "fromcache" => $cache
        ];

        $ret = Lib::POST(取昵称, $array);
        return $ret;
    }
}
