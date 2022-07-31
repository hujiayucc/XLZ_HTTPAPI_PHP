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
     * @description 取中间文本
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
     * @description 取右边文本
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
     * @description 取左边文本
     * @param string $str 原文本
     * @param string $rightStr 右边文本
     * @return string 左边文本
     */
    public static function getLeftstr(string $str, string $rightStr): string
    {
        $right = strpos($str, $rightStr);
        return substr($str, 0, $right);
    }
}
