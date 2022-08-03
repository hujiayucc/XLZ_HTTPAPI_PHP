<?php
/*
 * @Author: hujiayucc
 * @Date: 2022-07-30 07:38:53
 * @Description: 载入核心文件
 */

/** @var string 根目录 */
const DIR_ROOT = __DIR__;
//机器人框架配置
require_once(DIR_ROOT . "/Config.php");
//API文件
require_once(DIR_ROOT . "/Api.php");
//颜色列表
require_once(DIR_ROOT . "/Color.php");
//Lib核心文件
require_once(DIR_ROOT . "/Lib.class.php");
//访问路径文件
require_once(DIR_ROOT . "/Url.php");
//数据类型文件
require_once(DIR_ROOT . "/Type.php");
//运行所有插件
runPlugins();