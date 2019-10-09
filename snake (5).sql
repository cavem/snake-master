-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 
-- 服务器版本: 5.5.53
-- PHP 版本: 7.0.12

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `snake`
--

-- --------------------------------------------------------

--
-- 表的结构 `snake_articles`
--

CREATE TABLE IF NOT EXISTS `snake_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章id',
  `title` varchar(155) NOT NULL COMMENT '文章标题',
  `description` varchar(255) NOT NULL COMMENT '文章描述',
  `keywords` varchar(155) NOT NULL COMMENT '文章关键字',
  `thumbnail` varchar(255) NOT NULL COMMENT '文章缩略图',
  `content` text NOT NULL COMMENT '文章内容',
  `add_time` datetime NOT NULL COMMENT '发布时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `snake_articles`
--

INSERT INTO `snake_articles` (`id`, `title`, `description`, `keywords`, `thumbnail`, `content`, `add_time`) VALUES
(2, '文章标题', '文章描述', '关键字1,关键字2,关键字3', '/upload/20170916/1e915c70dbb9d3e8a07bede7b64e4cff.png', '<p>测试文章内容<img src="http://img.baidu.com/hi/jx2/j_0057.gif"/></p><p>测试内容</p>', '2017-09-16 17:47:44');

-- --------------------------------------------------------

--
-- 表的结构 `snake_hot`
--

CREATE TABLE IF NOT EXISTS `snake_hot` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `price` varchar(10) NOT NULL,
  `dispose` varchar(30) NOT NULL,
  `bandwidth` varchar(15) NOT NULL,
  `defense` varchar(10) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `apply` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `snake_hot`
--

INSERT INTO `snake_hot` (`id`, `title`, `price`, `dispose`, `bandwidth`, `defense`, `ip`, `apply`) VALUES
(1, '江苏BGP100G', '1088元', '16H/16G/240G ssd/1T HDD', '30M独享', '100G', '43.248.189.3', '游戏、网站、视频、直播、区块链'),
(2, '江苏BGP100G', '999元', '16H/16G/240G ssd/1T HDD', '100M独享', '100G', '218.93.208.1', '游戏、网站、视频、直播、区块链'),
(3, '杭州 BGP180G', '1888元', '16H/32G/120G ssd/500G HDD', '50M独享', '180G', '103.219.29.1', '游戏、网站、视频、直播、区块链');

-- --------------------------------------------------------

--
-- 表的结构 `snake_node`
--

CREATE TABLE IF NOT EXISTS `snake_node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `node_name` varchar(155) NOT NULL DEFAULT '' COMMENT '节点名称',
  `control_name` varchar(155) NOT NULL DEFAULT '' COMMENT '控制器名',
  `action_name` varchar(155) NOT NULL COMMENT '方法名',
  `is_menu` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否是菜单项 1不是 2是',
  `type_id` int(11) NOT NULL COMMENT '父级节点id',
  `style` varchar(155) DEFAULT '' COMMENT '菜单样式',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=54 ;

--
-- 转存表中的数据 `snake_node`
--

INSERT INTO `snake_node` (`id`, `node_name`, `control_name`, `action_name`, `is_menu`, `type_id`, `style`) VALUES
(1, '用户管理', '#', '#', 2, 0, 'fa fa-users'),
(2, '管理员管理', 'user', 'index', 2, 1, ''),
(3, '添加管理员', 'user', 'useradd', 1, 2, ''),
(4, '编辑管理员', 'user', 'useredit', 1, 2, ''),
(5, '删除管理员', 'user', 'userdel', 1, 2, ''),
(6, '角色管理', 'role', 'index', 2, 1, ''),
(7, '添加角色', 'role', 'roleadd', 1, 6, ''),
(8, '编辑角色', 'role', 'roleedit', 1, 6, ''),
(9, '删除角色', 'role', 'roledel', 1, 6, ''),
(10, '分配权限', 'role', 'giveaccess', 1, 6, ''),
(11, '系统管理', '#', '#', 2, 0, 'fa fa-desktop'),
(12, '数据备份/还原', 'data', 'index', 2, 11, ''),
(13, '备份数据', 'data', 'importdata', 1, 12, ''),
(14, '还原数据', 'data', 'backdata', 1, 12, ''),
(15, '节点管理', 'node', 'index', 2, 1, ''),
(16, '添加节点', 'node', 'nodeadd', 1, 15, ''),
(17, '编辑节点', 'node', 'nodeedit', 1, 15, ''),
(18, '删除节点', 'node', 'nodedel', 1, 15, ''),
(19, '文章管理', 'articles', 'index', 2, 0, 'fa fa-book'),
(20, '文章列表', 'articles', 'index', 2, 19, ''),
(21, '添加文章', 'articles', 'articleadd', 1, 19, ''),
(22, '编辑文章', 'articles', 'articleedit', 1, 19, ''),
(23, '删除文章', 'articles', 'articledel', 1, 19, ''),
(24, '上传图片', 'articles', 'uploadImg', 1, 19, ''),
(25, '个人中心', '#', '#', 1, 0, ''),
(26, '编辑信息', 'profile', 'index', 1, 25, ''),
(27, '编辑头像', 'profile', 'headedit', 1, 25, ''),
(28, '上传头像', 'profile', 'uploadheade', 1, 25, ''),
(29, '网站管理', '#', '#', 2, 0, 'fa fa-globe'),
(30, '轮播图列表', 'slider', 'index', 2, 29, ''),
(31, '轮播图编辑', 'slider', 'slideredit', 1, 29, ''),
(32, '产品管理', '#', '#', 2, 0, 'fa fa-briefcase'),
(33, '产品类型', 'protype', 'index', 2, 32, 'fa fa-briefcase'),
(34, '类型添加', 'protype', 'protypeadd', 1, 33, 'fa fa-briefcase'),
(35, '类型编辑', 'protype', 'protypeedit', 1, 33, 'fa fa-briefcase'),
(36, '类型删除', 'protype', 'protypedel', 1, 33, 'fa fa-briefcase'),
(37, '产品类型2', 'protyped', 'index', 1, 32, ''),
(38, '类型2添加', 'protyped', 'protypedadd', 1, 37, ''),
(39, '类型2编辑', 'protyped', 'protypededit', 1, 37, ''),
(40, '类型2删除', 'protyped', 'protypeddel', 1, 37, ''),
(41, '产品列表', 'product', 'index', 2, 32, ''),
(42, '列表添加', 'product', 'productadd', 1, 41, ''),
(43, '列表编辑', 'product', 'productedit', 1, 41, ''),
(44, '列表删除', 'product', 'productdel', 1, 41, ''),
(45, '产品列表2', 'productd', 'index', 1, 32, ''),
(46, '列表2添加', 'productd', 'productdadd', 1, 45, ''),
(47, '列表2编辑', 'productd', 'productdedit', 1, 45, ''),
(48, '列表2删除', 'productd', 'productddel', 1, 45, ''),
(49, '热销产品', 'hot', 'index', 2, 29, ''),
(50, '热销产品编辑', 'hot', 'hotedit', 1, 49, ''),
(51, '轮播图添加', 'slider', 'slideradd', 1, 29, ''),
(52, '轮播图删除', 'slider', 'sliderdel', 1, 29, ''),
(53, '网站设置', 'siteconf', 'index', 2, 29, '');

-- --------------------------------------------------------

--
-- 表的结构 `snake_product_deposit`
--

CREATE TABLE IF NOT EXISTS `snake_product_deposit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(1) NOT NULL DEFAULT '1',
  `child_type` int(11) NOT NULL,
  `name` varchar(10) NOT NULL DEFAULT '',
  `bandwidth` varchar(10) NOT NULL DEFAULT '',
  `route` varchar(10) NOT NULL DEFAULT '',
  `ipnums` int(10) NOT NULL DEFAULT '0',
  `defense` varchar(20) NOT NULL DEFAULT '',
  `price` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `snake_product_deposit`
--

INSERT INTO `snake_product_deposit` (`id`, `type`, `child_type`, `name`, `bandwidth`, `route`, `ipnums`, `defense`, `price`) VALUES
(1, 1, 0, '1U', '50M', 'BGP', 1, '120G', '1000元/月');

-- --------------------------------------------------------

--
-- 表的结构 `snake_product_rent`
--

CREATE TABLE IF NOT EXISTS `snake_product_rent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(1) NOT NULL DEFAULT '1',
  `child_type` int(1) NOT NULL DEFAULT '0',
  `name` varchar(20) NOT NULL DEFAULT '',
  `cpu` varchar(10) NOT NULL DEFAULT '',
  `ram` varchar(10) NOT NULL DEFAULT '',
  `disk` varchar(25) NOT NULL DEFAULT '',
  `ipnums` int(10) NOT NULL DEFAULT '0',
  `route` varchar(50) NOT NULL DEFAULT '',
  `defense` varchar(20) NOT NULL DEFAULT '',
  `bandwidth` varchar(10) NOT NULL DEFAULT '',
  `price` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `snake_product_rent`
--

INSERT INTO `snake_product_rent` (`id`, `type`, `child_type`, `name`, `cpu`, `ram`, `disk`, `ipnums`, `route`, `defense`, `bandwidth`, `price`) VALUES
(1, 1, 0, '基础静态BGP', '16H', '32G', '120GSSD/500G hdd', 1, '', '120G', '50M', '1288元/月'),
(2, 1, 0, '中端静态BGP', '16H', '32G', '120GSSD/500G hdd', 1, '', '180G', '50M', '1888元/月'),
(3, 1, 0, '高端静态BGP', '16H', '32G', '120GSSD/500G hdd', 1, '', '320G', '50M', '2988元/月'),
(4, 1, 0, '至尊静态BGP', '16H', '32G', '120GSSD/500G hdd', 1, '', '400G', '50M', '5088元/月'),
(5, 2, 3, '产品001', '16H', '16G', '120GSSD/500G hdd', 1, '电信/联通/移动三选一', '100G/50G/40G', '30M', '588元/月'),
(6, 2, 4, '腾讯游戏', '16H', '32G', '120GSSD/500G hdd', 2, '联通', '150G', '20M', '999元/月');

-- --------------------------------------------------------

--
-- 表的结构 `snake_product_typed`
--

CREATE TABLE IF NOT EXISTS `snake_product_typed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '',
  `fid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `snake_product_typed`
--

INSERT INTO `snake_product_typed` (`id`, `name`, `fid`) VALUES
(1, '浙江杭州', 0),
(2, '江苏宿迁', 0),
(3, '山东枣庄', 0),
(4, '高仿CN2', 0);

-- --------------------------------------------------------

--
-- 表的结构 `snake_product_typer`
--

CREATE TABLE IF NOT EXISTS `snake_product_typer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '',
  `fid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `snake_product_typer`
--

INSERT INTO `snake_product_typer` (`id`, `name`, `fid`) VALUES
(1, '浙江杭州', 0),
(2, '江苏宿迁', 0),
(3, '单线产品', 2),
(4, '双线产品', 2),
(5, '精品BGP产品', 2),
(6, '百兆独享产品', 2),
(7, '大带宽', 2),
(8, '山东枣庄', 0),
(9, '高防CN2', 0);

-- --------------------------------------------------------

--
-- 表的结构 `snake_role`
--

CREATE TABLE IF NOT EXISTS `snake_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `role_name` varchar(155) NOT NULL COMMENT '角色名称',
  `rule` varchar(255) DEFAULT '' COMMENT '权限节点数据',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `snake_role`
--

INSERT INTO `snake_role` (`id`, `role_name`, `rule`) VALUES
(1, '超级管理员', '*'),
(2, '系统维护员', '1,2,3,4,5,6,7,8,9,10');

-- --------------------------------------------------------

--
-- 表的结构 `snake_siteconf`
--

CREATE TABLE IF NOT EXISTS `snake_siteconf` (
  `id` int(11) unsigned NOT NULL,
  `keword` text NOT NULL,
  `desc` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `snake_siteconf`
--

INSERT INTO `snake_siteconf` (`id`, `keword`, `desc`) VALUES
(1, '高防BGP，高防CN2，大流量ddos攻击防御，防御策略定制，三线机房，浙江杭州BGP机房，江苏宿迁BGP机房，山东枣庄BGP机房', '宿迁晴空网络-专业高防BGP服务器提供商，以诚信安全稳定的服务理念全心全意服务客户，以口碑打造品牌价值');

-- --------------------------------------------------------

--
-- 表的结构 `snake_slider`
--

CREATE TABLE IF NOT EXISTS `snake_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '',
  `img_url` varchar(100) NOT NULL DEFAULT '',
  `type` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `snake_slider`
--

INSERT INTO `snake_slider` (`id`, `name`, `img_url`, `type`) VALUES
(1, '首页轮播图', '/upload/20190811/b838f96edb6aa8eb28d49f6f6e67d66a.png', 0),
(2, '活动页轮播图', '/upload/20190811/bc8bf54a82e03ddd3f4714ebd5eb7448.png', 1);

-- --------------------------------------------------------

--
-- 表的结构 `snake_user`
--

CREATE TABLE IF NOT EXISTS `snake_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '密码',
  `head` varchar(255) COLLATE utf8_bin DEFAULT '' COMMENT '头像',
  `login_times` int(11) NOT NULL DEFAULT '0' COMMENT '登陆次数',
  `last_login_ip` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '最后登录IP',
  `last_login_time` int(11) NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `real_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '真实姓名',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `role_id` int(11) NOT NULL DEFAULT '1' COMMENT '用户角色id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `snake_user`
--

INSERT INTO `snake_user` (`id`, `user_name`, `password`, `head`, `login_times`, `last_login_ip`, `last_login_time`, `real_name`, `status`, `role_id`) VALUES
(1, 'admin', 'a9ddd2e7bdff202e3e9bca32765e9ba0', '/static/admin/images/profile_small.jpg', 53, '127.0.0.1', 1568460687, 'admin', 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
