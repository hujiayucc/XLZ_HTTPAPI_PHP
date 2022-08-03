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
        $left = strpos($str, $leftStr);
        $right = strpos($str, $rightStr, $left);
        if ($left < 0 or $right < $left) return '';
        return substr($str, $left + strlen($leftStr), $right - $left - strlen($leftStr));
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
     * @return 返回编码后的字符串
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
     * @return 返回解码后的字符串
     */
    public static function unUcs2Code($str, $encode = "UTF-8"): string
    {
        $strlen = strlen($str);
        $step = 4;
        $buffer = array();
        for ($i = 0; $i < $strlen; $i += $step) {
            $buffer[] = iconv("UCS-2", $encode, pack("H4", substr($str, $i, $step)));
        }
        return   join("", $buffer);
    }
}

/**
 * 该函数在插件中调用,挂载插件函数到预留的钩子上
 *
 * @param string $hook
 * @param string $actionFunc
 * @return boolearn
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
