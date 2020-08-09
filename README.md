# manual

手册管理系统 管理端

另外您可能需要 [WEB端](http://github.com/xielei/manual-web) 或 [API端](http://github.com/xielei/manual-api)

web端提供web访问

api端提供接口，比如做小程序开发或者其他。

## 特点

* markdown书写
* 搜索
* 多级目录

## 安装

首先创建一个工程：

``` bash
composer create-project ebcms/project
```

进入工程目录，然后安装本系统

``` cmd
composer require xielei/manual
```

安装完成后，需要配置数据库信息，新建 `config/xielei/database/database.php` 数据库配置文件，配置如下：

``` php
// 若采用mysql数据库，则配置如下，还要导入包里面的import.sql
return [
  'database_name' => '...',
  'server' => '127.0.0.1',
  'username' => '...',
  'password' => '...',
  'prefix' => 'prefix_',
];
```
