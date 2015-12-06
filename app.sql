-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-12-06 08:38:09
-- 服务器版本： 5.5.46-0ubuntu0.14.04.2
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app`
--

-- --------------------------------------------------------

--
-- 表的结构 `auth`
--

CREATE TABLE `auth` (
  `auth_label` varchar(100) NOT NULL DEFAULT '' COMMENT '权限Label',
  `auth_name` varchar(100) NOT NULL,
  `auth_type` varchar(100) NOT NULL DEFAULT '' COMMENT '权限类型'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `auth`
--

INSERT INTO `auth` (`auth_label`, `auth_name`, `auth_type`) VALUES
('JSLB_ADD', '角色列表_增加', '权限中心'),
('JSLB_DELETE', '角色列表_删除', '权限中心'),
('JSLB_EDIT', '角色列表_编辑', '权限中心'),
('JSLB_INDEX', '角色列表_查看', '权限中心'),
('LEFTMENU_CRMWORKLOAD', '左部菜单交易员工作进度', '测试'),
('LEFTMENU_CRMWORKLOAD23', '交易员每日交易数据32', '测试'),
('LEFTMENU_DASHBOARD', '交易员每日交易数据1', '测试'),
('LEFTMENU_DASHBOARD1', '交易员每日交易数据', '测试'),
('LEFTMENU_DASHBOARD2', '左部菜单交易报表3', '测试'),
('LEFTMENU_DASHBOARD34', '左部菜单交易报表23', '测试'),
('LEFTMENU_JOBSCHEDUL', 'Dashboard', '测试'),
('LEFTMENU_TRADEREPORT', '左部菜单交易报表', '测试'),
('QXXX_ADD', '权限信息_增加', '权限中心'),
('QXXX_DELETE', '权限信息_删除', '权限中心'),
('QXXX_EDIT', '权限信息_编辑', '权限中心'),
('QXXX_INDEX', '权限信息_查看', '权限中心'),
('QXZX', '权限中心', '权限中心'),
('QXZ_ADD', '权限组_增加', '权限中心'),
('QXZ_DELETE', '权限组_删除', '权限中心'),
('QXZ_EDIT', '权限组_编辑', '权限中心'),
('QXZ_INDEX', '权限组_查看', '权限中心'),
('YHLB_ADD', '用户列表_增加', '权限中心'),
('YHLB_DELETE', '用户列表_删除', '权限中心'),
('YHLB_EDIT', '用户列表_编辑', '权限中心'),
('YHLB_INDEX', '用户列表_查看', '权限中心');

-- --------------------------------------------------------

--
-- 表的结构 `auth_group`
--

CREATE TABLE `auth_group` (
  `group_label` varchar(100) NOT NULL COMMENT '权限组Label',
  `group_name` varchar(100) NOT NULL COMMENT '权限组名称',
  `default_path` varchar(300) NOT NULL COMMENT '权限组默认进入controller'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `auth_group`
--

INSERT INTO `auth_group` (`group_label`, `group_name`, `default_path`) VALUES
('Admin', '系统管理员', 'Admin\\UserController@index'),
('Admin3', '测试3', '23423'),
('test', '测试', 'Admin\\UserController@index');

-- --------------------------------------------------------

--
-- 表的结构 `auth_group_relationship`
--

CREATE TABLE `auth_group_relationship` (
  `group_label` varchar(100) NOT NULL COMMENT '权限组Label',
  `auth_label` varchar(100) NOT NULL COMMENT '权限Label'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `auth_group_relationship`
--

INSERT INTO `auth_group_relationship` (`group_label`, `auth_label`) VALUES
('Admin', 'LEFTMENU_CRMWORKLOAD'),
('Admin', 'LEFTMENU_CRMWORKLOAD23'),
('Admin', 'LEFTMENU_DASHBOARD2'),
('Admin', 'QXXX_INDEX'),
('Admin', 'YHLB_INDEX'),
('Admin3', 'LEFTMENU_CRMWORKLOAD'),
('Admin3', 'LEFTMENU_CRMWORKLOAD23');

-- --------------------------------------------------------

--
-- 表的结构 `role`
--

CREATE TABLE `role` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `role_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '角色名称',
  `parent_role_id` int(11) NOT NULL COMMENT '上级角色ID',
  `auth_group` varchar(500) NOT NULL COMMENT '权限组'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `parent_role_id`, `auth_group`) VALUES
(3, '管理员', 0, 'Admin'),
(4, '技术部', 0, 'test'),
(5, '2123', 0, 'test'),
(6, '2123', 0, 'Admin'),
(7, 'sdfgfds', 0, 'Admin');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL COMMENT '员工账号',
  `password` varchar(100) NOT NULL COMMENT '密码',
  `salt` varchar(45) NOT NULL COMMENT '盐',
  `truename` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '姓名',
  `email` varchar(40) DEFAULT NULL COMMENT '邮箱',
  `mobile` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '移动电话',
  `landline` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '固定电话',
  `ext` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '分机号',
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色ID',
  `remember_token` varchar(50) NOT NULL,
  `status` enum('normal','locked') NOT NULL DEFAULT 'normal',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `googleauthenticatorsecret` varchar(100) NOT NULL COMMENT 'GoogleAuthenticator',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `salt`, `truename`, `email`, `mobile`, `landline`, `ext`, `role_id`, `remember_token`, `status`, `updated_at`, `googleauthenticatorsecret`, `created_at`) VALUES
(31, '234', '$2y$10$hkFn1HkQc48OZYukePb3y.AOR8f0eJV80LFAtKOQJaSnjJvE6Tz36', 'fnJK3', '12342', 'admin@admin.com', '13515100000', '', '', 4, '', 'normal', '2015-12-02 00:55:59', '', '2015-12-02 00:00:17'),
(32, '23434', '$2y$10$0r9WY7TYiVfbDdEkjCEpoOuL8lUWcXwMURSbElMX6eKFRbGInZs0i', 'g5SYq', '欧阳涛', '105221435@qq.com', '18728601392', '', '', 3, '', 'normal', '2015-12-02 00:56:06', '', '2015-12-02 00:16:03'),
(34, 'systemuser', '$2y$10$uKaP4AGmGzHqomFVEqGJOe2.MApP3i75qXlCu.8j/NWbbDjk4lNji', 'k205G', 'simon', '1052214395@qq.com', '18728601392', '', '', 3, 'UhPccOEhqq1T6bRDXUUiXpkbwg2AZPQowMvVQIpFYik8WFymc1', 'normal', '2015-12-05 00:28:29', '', '2015-12-04 01:03:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`auth_label`),
  ADD UNIQUE KEY `auth_label` (`auth_label`);

--
-- Indexes for table `auth_group`
--
ALTER TABLE `auth_group`
  ADD PRIMARY KEY (`group_label`),
  ADD UNIQUE KEY `group_label_unique` (`group_label`);

--
-- Indexes for table `auth_group_relationship`
--
ALTER TABLE `auth_group_relationship`
  ADD UNIQUE KEY `authgroupLabelauthLabelUq` (`group_label`,`auth_label`),
  ADD KEY `authgroupLabelIndex` (`group_label`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_id_UNIQUE` (`role_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
