# 小栗子HTTPAPI SDK For PHP

### 首次使用请根据自己框架设置修改**Lib/Config.php**

### 首次使用请根据自己框架设置修改**Lib/Config.php**

### 首次使用请根据自己框架设置修改**Lib/Config.php**

## 文件目录

**index.php** 文件中有基础调用案例

**Lib/Api.php** 为API文件（已实现部分功能）

**Lib/Color.php** 为颜色代码存储文件，需要更多请自行添加

**Lib/init.php** 为挂载核心文件

**Lib/Lib.class.php** 为部分核心功能文件

**Lib/Type.php** 为定义数据类型文件

**Lib/Url.php** 为定义访问路径文件（配合于API）

**Tips:** 所有功能会逐个增加，请耐心等待，你也可以自行添加

**点击链接加入群聊【xzfg①】：** [XLZ HTTPAPI交流群](https://jq.qq.com/?_wv=1027&k=zO0diIft)

**IDE推荐:** [VSCode](https://code.visualstudio.com/)

## 插件要求
插件位置存在于 **plugins** 文件夹
插件的文件名需与文件夹名相同（例：关键词回复/关键词回复.php）
插件中将功能以 **function** 写为函数调用
例如:
```php
<?php
//必须引入的文件
require_once("../Lib/init.php");

function 关键词回复($robot, $toqq, $msg)
{
    if ($toqq == 2792607647) {
        API::发送好友消息($robot,$toqq,$msg);
    }
}
//private私聊挂载点
addAction('private','关键词回复');


function 群关键词回复($robot, $group, $toqq, $msg, $req, $random)
{
    if ($msg == "123")
        API::发送群消息($robot, $group, "666");
}
//group群挂载点
addAction('group', '群关键词回复');
```
### 详情可看 [msg](./blob/master/msg/index.php) 的挂载点传递参数
