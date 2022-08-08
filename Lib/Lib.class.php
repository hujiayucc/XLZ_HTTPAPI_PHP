<?php
/*
 * @Author: hujiayucc
 * @Date: 2022-07-26 04:08:13
 * @Description: 工具类
 */

require_once("init.php");

class Lib
{
    /**
     * @description 获取Cookie
     * @param string $url 请求路径
     * @param string $time 时间截
     * @return string Cookie信息
     */
    private static function getCookie(string $url, string $time): string
    {
        $cookie = "user=" . CONFIG_USER . ";timestamp=" . $time . ";signature=" . Lib::getSignature($url, $time);
        return $cookie;
    }


    /**
     * @description 获取signature
     * @param string $url 请求路径
     * @param string $time 时间截
     * @return string signature
     */
    private static function getSignature(string $url, string $time): string
    {
        //md5(用户名+请求路径+md5(密码)+timestamp)
        $signature = md5(CONFIG_USER . $url . md5(CONFIG_PASSWD) . $time);
        return $signature;
    }

    /**
     * @description 获取请求头
     * @return string[] Header请求头
     */
    private static function getHeader(string $signature, string $time): array
    {
        $header[] = "H-Auth-User:" . CONFIG_USER;
        $header[] = "H-Auth-Signature:" . $signature;
        $header[] = "H-Auth-Timestamp:" . $time;
        return $header;
    }

    /**
     * @description POST方法
     * @param string $url 访问路径
     * @param array $post POST信息
     * @return string 执行结果
     */
    public static function POST(string $url, array $post): string
    {
        $time = time();
        $cookie = self::getCookie($url, $time);
        $signature = self::getSignature($url, $time);
        $header = self::getHeader($signature, $time);
        $data = http_build_query($post);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, CONFIG_HOST . $url);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_COOKIE, $cookie);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_USERAGENT, CONFIG_UA);

        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}

class Text
{
    /**
     * @method getSubstr 取中间文本
     * @param string $str 原文本
     * @param string $leftStr 左边文本
     * @param string $rightStr 右边文本
     * @return string 中间文本
     */
    public static function getSubstr(string $str, string $leftStr, string $rightStr): string
    {
        $temp = self::getRightstr($str, $leftStr);
        $temp = self::getLeftstr($temp, $rightStr);
        return $temp;
    }

    /**
     * @method getRightstr 取右边文本
     * @param string $str 原文本
     * @param string $leftStr 左边文本
     * @return string 右边文本
     */
    public static function getRightstr(string $str, string $leftStr): string
    {
        $left = strpos($str, $leftStr);
        return substr($str, $left + strlen($leftStr));
    }


    /**
     * @method getLeftstr 取左边文本
     * @param string $str 原文本
     * @param string $rightStr 右边文本
     * @return string 左边文本
     */
    public static function getLeftstr(string $str, string $rightStr): string
    {
        $right = strpos($str, $rightStr);
        return substr($str, 0, $right);
    }

    /**
     * @method Ucs2Code UCS2编码
     * @param $str 输入字符串
     * @param $encod 输入字符串编码类型(UTF-8,GB2312,GBK)
     * @return string 返回编码后的字符串
     */
    public static function Ucs2Code($str, $encode = "UTF-8"): string
    {
        $jumpbit = strtoupper($encode) == 'GB2312' ? 2 : 3;
        $strlen = strlen($str);
        $pos = 0;
        $buffer = array();
        for ($pos = 0; $pos < $strlen;) {
            if (ord(substr($str, $pos, 1)) >= 0xa1) {
                $tmpChar = substr($str, $pos, $jumpbit);
                $pos += $jumpbit;
            } else {
                $tmpChar = substr($str, $pos, 1);
                ++$pos;
            }
            $buffer[] = bin2hex(iconv("UTF-8", "UCS-2", $tmpChar));
        }
        return strtoupper(join("", $buffer));
    }

    /**
     * @method unUcs2Code UCS2解码
     * @param $str 输入字符串
     * @param $encod 输入字符串编码类型(UTF-8,GB2312,GBK)
     * @return string 返回解码后的字符串
     */
    public static function unUcs2Code($str, $encode = "UTF-8"): string
    {
        $strlen = strlen($str);
        $step = 4;
        $buffer = array();
        for ($i = 0; $i < $strlen; $i += $step) {
            $buffer[] = iconv("UCS-2", $encode, pack("H4", substr($str, $i, $step)));
        }
        return join("", $buffer);
    }
}

/**
 * 该函数在插件中调用,挂载插件函数到预留的钩子上
 *
 * @param string $hook
 * @param string $actionFunc
 * @return bool
 */
function addAction($hook, $actionFunc)
{
    // 通过全局变量来存储挂载点上挂载的插件函数
    global $Hooks;
    if (!isset($Hooks[$hook]) || !in_array($actionFunc, $Hooks[$hook])) {
        $Hooks[$hook][] = $actionFunc;
    }
    return true;
}

/**
 * 插入式挂载：执行挂在钩子上的函数,支持多参数 doAction('事件类型_私聊消息', $robot, $toqq, $mag);
 * 在挂载点插入扩展内容
 */
function doAction($hook)
{
    global $Hooks;
    $args = array_slice(func_get_args(), 1);
    if (isset($Hooks[$hook])) {
        foreach ($Hooks[$hook] as $function) {
            call_user_func_array($function, $args);
        }
    }
}

function runPlugins()
{
    $pluginFiles = null;
    $pluginPath = '../plugins';
    $pluginDir = @dir($pluginPath);
    if ($pluginDir) {
        while (($file = $pluginDir->read()) !== false) {
            if (preg_match('|^\.+$|', $file)) {
                continue;
            }
            if (is_dir($pluginPath . '/' . $file)) {
                $pluginsSubDir = @dir($pluginPath . '/' . $file);
                if ($pluginsSubDir) {
                    while (($subFile = $pluginsSubDir->read()) !== false) {
                        if (preg_match('|^\.+$|', $subFile)) {
                            continue;
                        }
                        if ($subFile == $file . '.php') {
                            $pluginFiles = "$file/$subFile";
                            require_once($pluginPath . '/' . $pluginFiles);
                        }
                    }
                }
            }
        }
    }
}

class 文本代码
{
    public static function 小黄豆表情(int $id): string
    {
        $code = "[bq" . $id . "]";
        return $code;
    }

    public static function 大表情(int $id, string $name, string $hash, string $flag): string
    {
        $code = "[bigFace,Id=" . $id . ",name=" . $name . ",hash=" . $hash . ",flag=" . $flag . "]";
        return $code;
    }

    public static function 小表情(int $id, string $name): string
    {
        $code = "[smallFace,name=" . $name . ",Id=" . $id . "]";
        return $code;
    }

    public static function 表情(int $id, string $name): string
    {
        $code = "[Face,Id=" . $id . ",name=" . $name . "]";
        return $code;
    }

    /**
     * @param string $bq emoji对应的usc2代码，支持多个任意拼接
     * @return string emoji表情
     */
    public static function emoji表情(string $bq): string
    {
        return $bq;
    }

    public static function 小视频(string $linkParam, string $hash1, string $hash2, int $width = null, int $height = null, int $time = null): string
    {
        $code = "[litleVideo,linkParam=" . $linkParam . ",hash1=" . $hash1 . ",hash2=" . $hash2 . ",wide=" . $width . ",high=" . $height . ",time=" . $time . "]";
        return $code;
    }

    /**
     * @param int $qq 对方QQ
     * @param bool $space 是否添加空格
     * @return string 艾特文本
     */
    public static function 艾特(int $qq, bool $space = true): string
    {
        if ($space)
            return "[@" . $qq . "] ";
        else
            return "[@" . $qq . "]";
    }

    public static function 艾特全体(): string
    {
        return "[@all]";
    }

    public static function 抖一抖(int $id, int $type, string $name, int $count = null): string
    {
        $code = "[Shake,name=" . $name . ",Type=" . $type . ",Id=" . $id . ",Count=" . $count . "]";
        return $code;
    }

    /**
     * @param string $info json格式 厘米秀数据
     */
    public static function 厘米秀(int $id, int $type, string $name, string $info): string
    {
        $code = "[limiShow,Id=" . $id . ",name=" . $name . ",type=" . $type . ",info=" . $info . "]";
        return $code;
    }

    public static function 超级QQ秀(int $id, string $name, string $hash): string
    {
        $code = "[SuperShow,Id=" . $id . ",name=" . $name . ",hash=" . $hash . ",guid=/0-0-" . $hash . ",url=https://gchat.qpic.cn/gchatpic_new/0/000000000-000000000-" . $hash . "/0?term=3]";
        return $code;
    }

    public static function 回复消息(string $msg, int $qq, int $time, int $req, int $random): string
    {
        $code = "[Reply,Content=" . $msg . ",SendQQID=" . $qq . ",Req=" . $req . ",Random=" . $random . ",SendTime=" . $time . "]";
        return $code;
    }

    public static function 闪字(string $desc, string $resid, string $prompt): string
    {
        $code = "[flashWord,Desc=" . $desc . ",Resid=" . $resid . ",Prompt=" . $prompt . "]";
        return $code;
    }

    /**
     * @param int $qq 对方QQ（可自定义）
     * @param string $nickname 对方昵称（可自定义）
     * @param string $desc 描述（可自定义）
     * @param string $time 十位时间截（可自定义）
     * @param string $random 发送Random（可自定义）
     * @param int $gbtype 背景类型（可自定义）
     * @return string 文本代码类,不支持频道
     */
    public static function 坦白说(int $qq, string $nickname, string $desc, string $time, string $random, int $bgtype): string
    {
        $code = "[Honest,ToUin=" . $qq . ",ToNick=" . $nickname . ",Desc" . $desc . ",Time=" . $time . ",Random=" . $random . ",Bgtype=" . $bgtype . "]";
        return $code;
    }

    /**
     * @param int $id 手机QQ上涂鸦背景从左往右数，从0开始
     * @param string $hash 和图片地址对应
     * @param string $pic 图片地址，和hash对应
     */
    public static function 涂鸦(int $id, string $hash, string $pic): string
    {
        $code = "[Graffiti,ModelId=" . $id . ",hash=" . $hash . ",url=" . $pic . "]";
        return $code;
    }

    public static function 秀图(string $hash, int $type = null, int $width = null, int $height = null, bool $gif = false): string
    {
        if ($type == null)
            $type = 40000;
        if ($gif)
            $gif = "true";
        else
            $gif = "false";
        $code = "[picShow,hash=" . $hash . ",showtype=" . $type . ",wide=" . $width . ",high=" . $height . ",cartoon=" . $gif . "]";
        return $code;
    }

    /**
     * @param int $i 1-6,不在1-6的范围时,默认无结果(无限摇骰子)
     */
    public static function 自定义骰子(int $i): string
    {
        if ($i >= 1 && $i <= 6) {
            $code = "[bigFace,Id=11464,name=[随机骰子]" . $i . ",hash=4823D3ADB15DF08014CE5D6796B76EE1,flag=409e2a69b16918f9]";
            return $code;
        } else {
            $code = "[bigFace,Id=11464,name=[随机骰子],hash=4823D3ADB15DF08014CE5D6796B76EE1,flag=409e2a69b16918f9]";
            return $code;
        }
    }

    /**
     * @param string $x 与粘贴位置有关,由横向位置经过特定算法得到
     * @param string $y 与粘贴位置有关,由纵向位置经过特定算法得到
     * @param string $width 可决定粘贴内容的宽度,由缩放宽度经过特定算法得到
     * @param string $height 可决定粘贴内容的高度,由缩放高度经过特定算法得到
     * @param string $rotate 粘贴内容与水平位置的倾角
     * @param int $time 消息接收时间
     * @param int $req 消息req
     * @param int $random 消息random
     */
    public static function 粘贴消息(string $x, string $y, string $width, string $height, string $rotate, int $time, int $req, int $random): string
    {
        $code = "[Sticker,X=" . $x . ",Y=" . $y . ",Width=" . $width . ",Height=" . $height . ",Rotate=" . $rotate . ",Req=" . $req . ",Random=" . $random . ",SendTime=" . $time . "]";
        return $code;
    }

    public static function 自定义猜拳(int $i): string
    {
        if ($i >= 1 && $i <= 6) {
            $code = "[bigFace,Id=11415,name=[猜拳]" . $i . ",hash=83C8A293AE65CA140F348120A77448EE,flag=7de39febcf45e6db]";
            return $code;
        } else {
            $code = "[bigFace,Id=11415,name=[猜拳],hash=83C8A293AE65CA140F348120A77448EE,flag=7de39febcf45e6db]";
            return $code;
        }
    }

    public static function 分享名片(string $type, int $number): string
    {
        switch ($type) {
            case 名片类型_好友:
                return "[Share,ID=" . $number . ",Type=" . $type . "]";
                break;
            case 名片类型_群聊:
                return "[Share,ID=" . $number . ",Type=" . $type . "]";
                break;
            default:
                return "名片类型错误";
                break;
        }
    }

    public static function Lottie动画(int $id, string $name): string
    {
        $code = "[Lottie,Id=" . $id . ",name=" . $name . "]";
        return $code;
    }

    public static function 弹射表情(string $name, int $faceid, int $count = null): string
    {
        $code = "[Shoot,name=" . $name . ",Faceid=" . $faceid . ",Count=" . $count . "]";
        return $code;
    }

    /**
     * @param int $id 频道ID
     * @param bool $space 是否添加空格
     */
    public static function 引用子频道(int $id, bool $space = true): string
    {
        if ($space)
            return "[#" . $id . "] ";
        else
            return "[#" . $id . "]";
    }
}
