delimiter $$

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(500) NOT NULL DEFAULT '',
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8$$

delimiter $$

CREATE TABLE `wx_sns_bindings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `sns_website` varchar(10) DEFAULT NULL,
  `sns_uid` varchar(45) DEFAULT NULL,
  `sns_oauth_token` varchar(100) NOT NULL,
  `sns_oauth_token_secret` varchar(100) DEFAULT NULL,
  `sns_display_name` varchar(100) DEFAULT NULL,
  `token_expire_date` datetime DEFAULT NULL COMMENT '标记sns_oauth_token的过期时间',
  `gender` char(1) DEFAULT NULL COMMENT 'm男，f女，null未设置',
  `province` int(2) DEFAULT NULL COMMENT '省份代码',
  `city` int(4) DEFAULT NULL COMMENT '城市代码',
  `location` varchar(40) DEFAULT NULL COMMENT '可读的所在地',
  `description` varchar(200) DEFAULT NULL COMMENT '自我介绍',
  `url` varchar(200) DEFAULT NULL COMMENT '个人博客地址',
  `profile_image_url` varchar(200) DEFAULT NULL COMMENT '头像图片地址',
  `followers_count` int(10) DEFAULT NULL COMMENT '粉丝数',
  `friends_count` int(4) DEFAULT NULL COMMENT '关注数',
  `statuses_count` int(5) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL COMMENT '帐号创建时间',
  `verified` bit(1) DEFAULT NULL COMMENT '是否是加V认证用户',
  `friends` varchar(20000) DEFAULT NULL COMMENT '用逗号分割的关注id列表',
  `friends_md5` varchar(100) DEFAULT NULL COMMENT '好友列表的md5值，用于简化好友无变化的情况的处理过程',
  `last_refresh` datetime DEFAULT NULL COMMENT '最近一次资料更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='记录的是用户绑定的sns帐号，一个用户同时绑定了qq和开心，那么就有两条记录'$$

delimiter $$

CREATE TABLE `wx_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `display_name` varchar(45) DEFAULT NULL,
  `user_token` varchar(80) DEFAULT NULL COMMENT '放在cookie里用于保持用户登录状态的token',
  `email` varchar(100) DEFAULT NULL,
  `passwd` varchar(50) DEFAULT NULL COMMENT '用户除了以sns帐号登录外，还可以以email+密码登录',
  `regist_time` datetime DEFAULT NULL,
  `last_login_time` datetime DEFAULT NULL,
  `last_login_ip` varchar(20) DEFAULT NULL,
  `selected_project_id` int(4) DEFAULT NULL,
  `follow_weibo` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=20004 DEFAULT CHARSET=utf8 COMMENT='用户表'$$


delimiter $$

CREATE TABLE `wx_orders` (
  `idwx_orders` int(11) NOT NULL AUTO_INCREMENT,
  `idraw_order` int(11) DEFAULT NULL COMMENT '最近一次更新此订单条目的raw_orders表条目id。',
  `order_no` varchar(100) DEFAULT NULL COMMENT '订单在商家的订单号',
  `yiqifa_unique_id` varchar(10) DEFAULT NULL COMMENT '订单在亿起发的unique_id，用来跟踪用户的参数',
  `feed_back` varchar(50) DEFAULT NULL COMMENT '我们传递给yiqifa的e参数',
  `wx_create_time` datetime DEFAULT NULL COMMENT '此条记录在微笑网创建的时间',
  `wx_last_update_time` datetime DEFAULT NULL COMMENT '此条记录在微笑网的最近更新时间',
  `order_time` datetime DEFAULT NULL COMMENT '订单在商家的下单时间',
  `commision` varchar(10) DEFAULT NULL,
  `status` varchar(4) DEFAULT NULL COMMENT '订单状态（R=未确认；A=成功订单；F=无效订单）',
  `action_id` varchar(10) DEFAULT NULL COMMENT '亿起发的推广活动id，例如“245”',
  `action_name` varchar(100) DEFAULT NULL COMMENT '亿起发的推广活动名称，例如“卓越CPS”',
  `prod_id` varchar(100) DEFAULT NULL COMMENT '购买的商品编号(在商家的)',
  `prod_name` varchar(200) DEFAULT NULL COMMENT '购买的商品名称',
  `prod_count` varchar(4) DEFAULT NULL COMMENT '购买的商品数量',
  `prod_money` varchar(10) DEFAULT NULL COMMENT '商品单价',
  `prod_type` varchar(10) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT '这条订单所属的用户名,如果订单找不到用户名,那么用户名就是空',
  PRIMARY KEY (`idwx_orders`),
  KEY `user_id` (`feed_back`,`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1000000 DEFAULT CHARSET=utf8 COMMENT='这是记录用户当前订单的主表。\n另外还有wx_orders_raw记录的是原始的get/push订单记录；wx_orders_changelog记录的是wx_orders的变动记录，只要订单有变动都会形成一条wx_orders_changelog'$$

delimiter $$

CREATE TABLE `wx_orders_changelog` (
  `idwx_orders_changelog` int(11) NOT NULL AUTO_INCREMENT,
  `idwx_orders` int(11) NOT NULL,
  `idraw_order` int(11) DEFAULT NULL COMMENT '最近一次更新此订单条目的raw_orders表条目id。',
  `order_no` varchar(100) DEFAULT NULL COMMENT '订单在商家的订单号',
  `yiqifa_unique_id` varchar(10) DEFAULT NULL COMMENT '订单在亿起发的unique_id，用来跟踪用户的参数',
  `feed_back` varchar(50) DEFAULT NULL COMMENT '我们传递给yiqifa的e参数',
  `wx_create_time` datetime DEFAULT NULL COMMENT '此条记录在微笑网创建的时间',
  `wx_last_update_time` datetime DEFAULT NULL COMMENT '此条记录在微笑网的最近更新时间',
  `order_time` datetime DEFAULT NULL COMMENT '订单在商家的下单时间',
  `commision` varchar(10) DEFAULT NULL,
  `status` varchar(4) DEFAULT NULL COMMENT '订单状态（R=未确认；A=成功订单；F=无效订单）',
  `action_id` varchar(10) DEFAULT NULL COMMENT '亿起发的推广活动id，例如“245”',
  `action_name` varchar(100) DEFAULT NULL COMMENT '亿起发的推广活动名称，例如“卓越CPS”',
  `prod_id` varchar(100) DEFAULT NULL COMMENT '购买的商品编号(在商家的)',
  `prod_name` varchar(200) DEFAULT NULL COMMENT '购买的商品名称',
  `prod_count` varchar(4) DEFAULT NULL COMMENT '购买的商品数量',
  `prod_money` varchar(10) DEFAULT NULL COMMENT '商品单价',
  `prod_type` varchar(10) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT '这条订单所属的用户名,如果订单找不到用户名,那么用户名就是空',
  `changelog_time` datetime DEFAULT NULL COMMENT '该条订单变动记录的入库时间',
  PRIMARY KEY (`idwx_orders_changelog`),
  KEY `user_id` (`feed_back`,`user_id`),
  KEY `idwx_orders` (`idwx_orders`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='wx_orders_changelog记录的是wx_orders的变动记录，只要订单有变动都会形成一条wx_orders_changelog'$$

delimiter $$

CREATE TABLE `wx_orders_sync` (
  `idraw_order` int(11) NOT NULL AUTO_INCREMENT,
  `log_time` datetime DEFAULT NULL COMMENT '写入数据库的时间',
  `data_source` varchar(5) DEFAULT NULL COMMENT '''push'',''get''区分这两个接口的数据',
  `yiqifa_unique_id` varchar(10) DEFAULT NULL COMMENT '订单在亿起发的唯一标识，一单多个物品的情况会被亿起发拆成多个条目，所以yiqifa_unique_id和order_no不一对一',
  `order_no` varchar(100) DEFAULT NULL COMMENT '订单号',
  `feed_back` varchar(50) DEFAULT NULL COMMENT '反馈参数，我们传给亿起发的跟踪标签',
  `data` varchar(2000) DEFAULT NULL COMMENT '原始的数据',
  PRIMARY KEY (`idraw_order`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8$$

delimiter $$

CREATE TABLE `wx_projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL COMMENT '公益项目名称',
  `desc` varchar(800) DEFAULT NULL COMMENT '公益项目描述',
  `order` int(11) NOT NULL DEFAULT '100' COMMENT '该公益项目在列表中的排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8 COMMENT='公益项目们'$$

delimiter $$

CREATE TABLE `wx_friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '纯id字段',
  `me` int(11) DEFAULT NULL COMMENT '我，在仰望的那个人。user表uid',
  `you` int(11) DEFAULT NULL COMMENT '你，被仰望的那个人。',
  `create_time` datetime DEFAULT NULL COMMENT '记录生成订单时间',
  `at_weixiao` int(1) DEFAULT '0' COMMENT '好友来源：在微笑认识的',
  `at_sina` int(1) DEFAULT '0' COMMENT '好友来源：在新浪认识的',
  `at_invite` int(1) DEFAULT '0' COMMENT '好友来源：me邀请you',
  `at_invited` int(1) DEFAULT '0' COMMENT '好友来源：me被you邀请',
  `canceled` int(1) DEFAULT '0' COMMENT '是否取消关注了？默认false。\n只有用户的手动操作可以修改这个值，其他如微博好友同步等不会修改这个值。',
  PRIMARY KEY (`id`),
  KEY `idx_you` (`you`),
  KEY `idx_me` (`me`),
  KEY `idx_you_and_me` (`me`,`you`)
) ENGINE=InnoDB AUTO_INCREMENT=10000001 DEFAULT CHARSET=utf8 COMMENT='好友关系记录表，微笑网好友关系仿微博：单向45度角仰望。即(me,you)/(you,me)是两条记录。\n特别的是微笑网有多种好友来源：微笑网笑友、微博好友、邀请、被邀请（邀请被邀请人是互相关注的）。邀请被邀请关系只能创建不能修改，即用户填写一次邀请人后就不能修改了。'$$


