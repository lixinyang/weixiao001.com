-- MySQL dump 10.13  Distrib 5.1.52, for unknown-linux-gnu (x86_64)
--
-- Host: localhost    Database: lixinyang
-- ------------------------------------------------------
-- Server version	5.1.52-community

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(500) NOT NULL DEFAULT '',
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wp_commentmeta`
--

DROP TABLE IF EXISTS `wp_commentmeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_commentmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`meta_id`),
  KEY `comment_id` (`comment_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=MyISAM AUTO_INCREMENT=3781 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wp_comments`
--

DROP TABLE IF EXISTS `wp_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_comments` (
  `comment_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_post_ID` bigint(20) unsigned NOT NULL DEFAULT '0',
  `comment_author` tinytext NOT NULL,
  `comment_author_email` varchar(100) NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) NOT NULL DEFAULT '',
  `comment_type` varchar(20) NOT NULL DEFAULT '',
  `comment_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_ID`),
  KEY `comment_approved` (`comment_approved`),
  KEY `comment_post_ID` (`comment_post_ID`),
  KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  KEY `comment_date_gmt` (`comment_date_gmt`),
  KEY `comment_parent` (`comment_parent`)
) ENGINE=MyISAM AUTO_INCREMENT=8491 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wp_links`
--

DROP TABLE IF EXISTS `wp_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_links` (
  `link_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `link_url` varchar(255) NOT NULL DEFAULT '',
  `link_name` varchar(255) NOT NULL DEFAULT '',
  `link_image` varchar(255) NOT NULL DEFAULT '',
  `link_target` varchar(25) NOT NULL DEFAULT '',
  `link_category` bigint(20) NOT NULL DEFAULT '0',
  `link_description` varchar(255) NOT NULL DEFAULT '',
  `link_visible` varchar(20) NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) unsigned NOT NULL DEFAULT '1',
  `link_rating` int(11) NOT NULL DEFAULT '0',
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) NOT NULL DEFAULT '',
  `link_notes` mediumtext NOT NULL,
  `link_rss` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`link_id`),
  KEY `link_category` (`link_category`),
  KEY `link_visible` (`link_visible`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wp_options`
--

DROP TABLE IF EXISTS `wp_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_options` (
  `option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) NOT NULL DEFAULT '0',
  `option_name` varchar(64) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL,
  `autoload` varchar(20) NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=MyISAM AUTO_INCREMENT=14405 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wp_pollsa`
--

DROP TABLE IF EXISTS `wp_pollsa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_pollsa` (
  `polla_aid` int(10) NOT NULL AUTO_INCREMENT,
  `polla_qid` int(10) NOT NULL DEFAULT '0',
  `polla_answers` varchar(200) NOT NULL DEFAULT '',
  `polla_votes` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`polla_aid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wp_pollsip`
--

DROP TABLE IF EXISTS `wp_pollsip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_pollsip` (
  `pollip_id` int(10) NOT NULL AUTO_INCREMENT,
  `pollip_qid` varchar(10) NOT NULL DEFAULT '',
  `pollip_aid` varchar(10) NOT NULL DEFAULT '',
  `pollip_ip` varchar(100) NOT NULL DEFAULT '',
  `pollip_host` varchar(200) NOT NULL DEFAULT '',
  `pollip_timestamp` varchar(20) NOT NULL DEFAULT '0000-00-00 00:00:00',
  `pollip_user` tinytext NOT NULL,
  `pollip_userid` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pollip_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wp_pollsq`
--

DROP TABLE IF EXISTS `wp_pollsq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_pollsq` (
  `pollq_id` int(10) NOT NULL AUTO_INCREMENT,
  `pollq_question` varchar(200) NOT NULL DEFAULT '',
  `pollq_timestamp` varchar(20) NOT NULL DEFAULT '',
  `pollq_totalvotes` int(10) NOT NULL DEFAULT '0',
  `pollq_active` tinyint(1) NOT NULL DEFAULT '1',
  `pollq_expiry` varchar(20) NOT NULL DEFAULT '',
  `pollq_multiple` tinyint(3) NOT NULL DEFAULT '0',
  `pollq_totalvoters` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pollq_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wp_postmeta`
--

DROP TABLE IF EXISTS `wp_postmeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_postmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`meta_id`),
  KEY `post_id` (`post_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=MyISAM AUTO_INCREMENT=3360 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wp_posts`
--

DROP TABLE IF EXISTS `wp_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_posts` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext NOT NULL,
  `post_title` text NOT NULL,
  `post_category` int(4) NOT NULL DEFAULT '0',
  `post_excerpt` text NOT NULL,
  `post_status` varchar(20) NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) NOT NULL DEFAULT 'open',
  `post_password` varchar(20) NOT NULL DEFAULT '',
  `post_name` varchar(200) NOT NULL DEFAULT '',
  `to_ping` text NOT NULL,
  `pinged` text NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` text NOT NULL,
  `post_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `guid` varchar(255) NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `post_name` (`post_name`),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`post_author`)
) ENGINE=MyISAM AUTO_INCREMENT=2344 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wp_term_relationships`
--

DROP TABLE IF EXISTS `wp_term_relationships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wp_term_taxonomy`
--

DROP TABLE IF EXISTS `wp_term_taxonomy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) NOT NULL DEFAULT '',
  `description` longtext NOT NULL,
  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=MyISAM AUTO_INCREMENT=124 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wp_terms`
--

DROP TABLE IF EXISTS `wp_terms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_terms` (
  `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(200) NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=123 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wp_usermeta`
--

DROP TABLE IF EXISTS `wp_usermeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wp_users`
--

DROP TABLE IF EXISTS `wp_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_users` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(64) NOT NULL DEFAULT '',
  `user_nicename` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_url` varchar(100) NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(60) NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wx_friends`
--

DROP TABLE IF EXISTS `wx_friends`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '´¿id×Ö¶Î',
  `me` int(11) DEFAULT NULL COMMENT 'ÎÒ£¬ÔÚÑöÍûµÄÄÇ¸öÈË¡£user±íuid',
  `you` int(11) DEFAULT NULL COMMENT 'Äã£¬±»ÑöÍûµÄÄÇ¸öÈË¡£',
  `create_time` datetime DEFAULT NULL COMMENT '¼ÇÂ¼Éú³É¶©µ¥Ê±¼ä',
  `at_weixiao` int(1) DEFAULT '0' COMMENT 'ºÃÓÑÀ´Ô´£ºÔÚÎ¢Ð¦ÈÏÊ¶µÄ',
  `at_sina` int(1) DEFAULT '0' COMMENT 'ºÃÓÑÀ´Ô´£ºÔÚÐÂÀËÈÏÊ¶µÄ',
  `at_invite` int(1) DEFAULT '0' COMMENT 'ºÃÓÑÀ´Ô´£ºmeÑûÇëyou',
  `at_invited` int(1) DEFAULT '0' COMMENT 'ºÃÓÑÀ´Ô´£ºme±»youÑûÇë',
  `canceled` int(1) DEFAULT '0' COMMENT 'ÊÇ·ñÈ¡Ïû¹Ø×¢ÁË£¿Ä¬ÈÏfalse¡£\nÖ»ÓÐÓÃ»§µÄÊÖ¶¯²Ù×÷¿ÉÒÔÐÞ¸ÄÕâ¸öÖµ£¬ÆäËûÈçÎ¢²©ºÃÓÑÍ¬²½µÈ²»»áÐÞ¸ÄÕâ¸öÖµ¡£',
  PRIMARY KEY (`id`),
  KEY `idx_you` (`you`),
  KEY `idx_me` (`me`),
  KEY `idx_you_and_me` (`me`,`you`)
) ENGINE=MyISAM AUTO_INCREMENT=10000899 DEFAULT CHARSET=utf8 COMMENT='ºÃÓÑ¹ØÏµ¼ÇÂ¼±í£¬Î¢Ð¦ÍøºÃÓÑ¹ØÏµ·ÂÎ¢²©£ºµ¥Ïò45¶È½ÇÑöÍû¡£¼´(me,';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wx_orders`
--

DROP TABLE IF EXISTS `wx_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_orders` (
  `idwx_orders` int(11) NOT NULL AUTO_INCREMENT,
  `idraw_order` int(11) DEFAULT NULL COMMENT 'æœ€è¿‘ä¸€æ¬¡æ›´æ–°æ­¤è®¢å•æ¡ç›®çš„raw_ordersè¡¨æ¡ç›®idã€‚',
  `order_no` varchar(100) DEFAULT NULL COMMENT 'è®¢å•åœ¨å•†å®¶çš„è®¢å•å·',
  `yiqifa_unique_id` varchar(10) DEFAULT NULL COMMENT 'è®¢å•åœ¨äº¿èµ·å‘çš„unique_idï¼Œç”¨æ¥è·Ÿè¸ªç”¨æˆ·çš„å‚æ•°',
  `feed_back` varchar(50) DEFAULT NULL COMMENT 'æˆ‘ä»¬ä¼ é€’ç»™yiqifaçš„eå‚æ•°',
  `wx_create_time` datetime DEFAULT NULL COMMENT 'æ­¤æ¡è®°å½•åœ¨å¾®ç¬‘ç½‘åˆ›å»ºçš„æ—¶é—´',
  `wx_last_update_time` datetime DEFAULT NULL COMMENT 'æ­¤æ¡è®°å½•åœ¨å¾®ç¬‘ç½‘çš„æœ€è¿‘æ›´æ–°æ—¶é—´',
  `order_time` datetime DEFAULT NULL COMMENT 'è®¢å•åœ¨å•†å®¶çš„ä¸‹å•æ—¶é—´',
  `commision` varchar(10) DEFAULT NULL,
  `status` varchar(4) DEFAULT NULL COMMENT 'è®¢å•çŠ¶æ€ï¼ˆR=æœªç¡®è®¤ï¼›A=æˆåŠŸè®¢å•ï¼›F=æ— æ•ˆè®¢å•ï¼‰',
  `action_id` varchar(10) DEFAULT NULL COMMENT 'äº¿èµ·å‘çš„æŽ¨å¹¿æ´»åŠ¨idï¼Œä¾‹å¦‚â€œ245â€',
  `action_name` varchar(100) DEFAULT NULL COMMENT 'äº¿èµ·å‘çš„æŽ¨å¹¿æ´»åŠ¨åç§°ï¼Œä¾‹å¦‚â€œå“è¶ŠCPSâ€',
  `prod_id` varchar(100) DEFAULT NULL COMMENT 'è´­ä¹°çš„å•†å“ç¼–å·(åœ¨å•†å®¶çš„)',
  `prod_name` varchar(200) DEFAULT NULL COMMENT 'è´­ä¹°çš„å•†å“åç§°',
  `prod_count` varchar(4) DEFAULT NULL COMMENT 'è´­ä¹°çš„å•†å“æ•°é‡',
  `prod_money` varchar(10) DEFAULT NULL COMMENT 'å•†å“å•ä»·',
  `prod_type` varchar(10) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT 'è¿™æ¡è®¢å•æ‰€å±žçš„ç”¨æˆ·å,å¦‚æžœè®¢å•æ‰¾ä¸åˆ°ç”¨æˆ·å,é‚£ä¹ˆç”¨æˆ·åå°±æ˜¯ç©º',
  PRIMARY KEY (`idwx_orders`),
  KEY `user_id` (`feed_back`,`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1000233 DEFAULT CHARSET=utf8 COMMENT='è¿™æ˜¯è®°å½•ç”¨æˆ·å½“å‰è®¢å•çš„ä¸»è¡¨ã€‚\nå¦å¤–è¿˜æœ‰wx_or';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wx_orders_changelog`
--

DROP TABLE IF EXISTS `wx_orders_changelog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_orders_changelog` (
  `idwx_orders_changelog` int(11) NOT NULL AUTO_INCREMENT,
  `idwx_orders` int(11) NOT NULL,
  `idraw_order` int(11) DEFAULT NULL COMMENT 'æœ€è¿‘ä¸€æ¬¡æ›´æ–°æ­¤è®¢å•æ¡ç›®çš„raw_ordersè¡¨æ¡ç›®idã€‚',
  `order_no` varchar(100) DEFAULT NULL COMMENT 'è®¢å•åœ¨å•†å®¶çš„è®¢å•å·',
  `yiqifa_unique_id` varchar(10) DEFAULT NULL COMMENT 'è®¢å•åœ¨äº¿èµ·å‘çš„unique_idï¼Œç”¨æ¥è·Ÿè¸ªç”¨æˆ·çš„å‚æ•°',
  `feed_back` varchar(50) DEFAULT NULL COMMENT 'æˆ‘ä»¬ä¼ é€’ç»™yiqifaçš„eå‚æ•°',
  `wx_create_time` datetime DEFAULT NULL COMMENT 'æ­¤æ¡è®°å½•åœ¨å¾®ç¬‘ç½‘åˆ›å»ºçš„æ—¶é—´',
  `wx_last_update_time` datetime DEFAULT NULL COMMENT 'æ­¤æ¡è®°å½•åœ¨å¾®ç¬‘ç½‘çš„æœ€è¿‘æ›´æ–°æ—¶é—´',
  `order_time` datetime DEFAULT NULL COMMENT 'è®¢å•åœ¨å•†å®¶çš„ä¸‹å•æ—¶é—´',
  `commision` varchar(10) DEFAULT NULL,
  `status` varchar(4) DEFAULT NULL COMMENT 'è®¢å•çŠ¶æ€ï¼ˆR=æœªç¡®è®¤ï¼›A=æˆåŠŸè®¢å•ï¼›F=æ— æ•ˆè®¢å•ï¼‰',
  `action_id` varchar(10) DEFAULT NULL COMMENT 'äº¿èµ·å‘çš„æŽ¨å¹¿æ´»åŠ¨idï¼Œä¾‹å¦‚â€œ245â€',
  `action_name` varchar(100) DEFAULT NULL COMMENT 'äº¿èµ·å‘çš„æŽ¨å¹¿æ´»åŠ¨åç§°ï¼Œä¾‹å¦‚â€œå“è¶ŠCPSâ€',
  `prod_id` varchar(100) DEFAULT NULL COMMENT 'è´­ä¹°çš„å•†å“ç¼–å·(åœ¨å•†å®¶çš„)',
  `prod_name` varchar(200) DEFAULT NULL COMMENT 'è´­ä¹°çš„å•†å“åç§°',
  `prod_count` varchar(4) DEFAULT NULL COMMENT 'è´­ä¹°çš„å•†å“æ•°é‡',
  `prod_money` varchar(10) DEFAULT NULL COMMENT 'å•†å“å•ä»·',
  `prod_type` varchar(10) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT 'è¿™æ¡è®¢å•æ‰€å±žçš„ç”¨æˆ·å,å¦‚æžœè®¢å•æ‰¾ä¸åˆ°ç”¨æˆ·å,é‚£ä¹ˆç”¨æˆ·åå°±æ˜¯ç©º',
  `changelog_time` datetime DEFAULT NULL COMMENT 'è¯¥æ¡è®¢å•å˜åŠ¨è®°å½•çš„å…¥åº“æ—¶é—´',
  PRIMARY KEY (`idwx_orders_changelog`),
  KEY `user_id` (`feed_back`,`user_id`),
  KEY `idwx_orders` (`idwx_orders`)
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=utf8 COMMENT='wx_orders_changelogè®°å½•çš„æ˜¯wx_ordersçš„å˜åŠ¨è®°å½•ï¼Œå';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wx_orders_sync`
--

DROP TABLE IF EXISTS `wx_orders_sync`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_orders_sync` (
  `idraw_order` int(11) NOT NULL AUTO_INCREMENT,
  `log_time` datetime DEFAULT NULL COMMENT 'å†™å…¥æ•°æ®åº“çš„æ—¶é—´',
  `data_source` varchar(5) DEFAULT NULL COMMENT '''push'',''get''åŒºåˆ†è¿™ä¸¤ä¸ªæŽ¥å£çš„æ•°æ®',
  `yiqifa_unique_id` varchar(10) DEFAULT NULL COMMENT 'è®¢å•åœ¨äº¿èµ·å‘çš„å”¯ä¸€æ ‡è¯†ï¼Œä¸€å•å¤šä¸ªç‰©å“çš„æƒ…å†µä¼šè¢«äº¿èµ·å‘æ‹†æˆå¤šä¸ªæ¡ç›®ï¼Œæ‰€ä»¥yiqifa_unique_idå’Œorder_noä¸ä¸€å¯¹ä¸€',
  `order_no` varchar(100) DEFAULT NULL COMMENT 'è®¢å•å·',
  `feed_back` varchar(50) DEFAULT NULL COMMENT 'åé¦ˆå‚æ•°ï¼Œæˆ‘ä»¬ä¼ ç»™äº¿èµ·å‘çš„è·Ÿè¸ªæ ‡ç­¾',
  `data` varchar(2000) DEFAULT NULL COMMENT 'åŽŸå§‹çš„æ•°æ®',
  PRIMARY KEY (`idraw_order`)
) ENGINE=MyISAM AUTO_INCREMENT=237 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wx_projects`
--

DROP TABLE IF EXISTS `wx_projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL COMMENT '公益项目名称',
  `desc` varchar(800) DEFAULT NULL COMMENT '公益项目描述',
  `order` int(11) NOT NULL DEFAULT '100' COMMENT '该公益项目在列表中的排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8 COMMENT='公益项目们';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wx_sns_bindings`
--

DROP TABLE IF EXISTS `wx_sns_bindings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_sns_bindings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `sns_website` varchar(10) DEFAULT NULL,
  `sns_uid` varchar(45) DEFAULT NULL,
  `sns_oauth_token` varchar(100) NOT NULL,
  `sns_oauth_token_secret` varchar(100) DEFAULT NULL,
  `sns_display_name` varchar(100) DEFAULT NULL,
  `token_expire_date` datetime DEFAULT NULL COMMENT 'æ ‡è®°sns_oauth_tokençš„è¿‡æœŸæ—¶é—´',
  `gender` char(1) DEFAULT NULL COMMENT 'mÄÐ£¬fÅ®£¬nullÎ´ÉèÖÃ',
  `province` int(2) DEFAULT NULL COMMENT 'Ê¡·Ý´úÂë',
  `city` int(4) DEFAULT NULL COMMENT '³ÇÊÐ´úÂë',
  `location` varchar(40) DEFAULT NULL COMMENT '¿É¶ÁµÄËùÔÚµØ',
  `description` varchar(200) DEFAULT NULL COMMENT '×ÔÎÒ½éÉÜ',
  `url` varchar(200) DEFAULT NULL COMMENT '¸öÈË²©¿ÍµØÖ·',
  `profile_image_url` varchar(200) DEFAULT NULL COMMENT 'Í·ÏñÍ¼Æ¬µØÖ·',
  `followers_count` int(10) DEFAULT NULL COMMENT '·ÛË¿Êý',
  `friends_count` int(4) DEFAULT NULL COMMENT '¹Ø×¢Êý',
  `statuses_count` int(5) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL COMMENT 'ÕÊºÅ´´½¨Ê±¼ä',
  `verified` bit(1) DEFAULT NULL COMMENT 'ÊÇ·ñÊÇ¼ÓVÈÏÖ¤ÓÃ»§',
  `friends` varchar(20000) DEFAULT NULL COMMENT 'ÓÃ¶ººÅ·Ö¸îµÄ¹Ø×¢idÁÐ±í',
  `friends_md5` varchar(100) DEFAULT NULL COMMENT 'ºÃÓÑÁÐ±íµÄmd5Öµ£¬ÓÃÓÚ¼ò»¯ºÃÓÑÎÞ±ä»¯µÄÇé¿öµÄ´¦Àí¹ý³Ì',
  `last_refresh` datetime DEFAULT NULL COMMENT '×î½üÒ»´Î×ÊÁÏ¸üÐÂÊ±¼ä',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COMMENT='è®°å½•çš„æ˜¯ç”¨æˆ·ç»‘å®šçš„snså¸å·ï¼Œä¸€ä¸ªç”¨æˆ·åŒæ—¶ç»‘';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wx_users`
--

DROP TABLE IF EXISTS `wx_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `display_name` varchar(45) DEFAULT NULL,
  `user_token` varchar(80) DEFAULT NULL COMMENT 'æ”¾åœ¨cookieé‡Œç”¨äºŽä¿æŒç”¨æˆ·ç™»å½•çŠ¶æ€çš„token',
  `email` varchar(100) DEFAULT NULL,
  `passwd` varchar(50) DEFAULT NULL COMMENT 'ç”¨æˆ·é™¤äº†ä»¥snså¸å·ç™»å½•å¤–ï¼Œè¿˜å¯ä»¥ä»¥email+å¯†ç ç™»å½•',
  `regist_time` datetime DEFAULT NULL,
  `last_login_time` datetime DEFAULT NULL,
  `last_login_ip` varchar(20) DEFAULT NULL,
  `selected_project_id` int(4) DEFAULT NULL,
  `follow_weibo` bit(1) DEFAULT NULL,
  `inviter_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=100060 DEFAULT CHARSET=utf8 COMMENT='ç”¨æˆ·è¡¨';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wx_wp_commentmeta`
--

DROP TABLE IF EXISTS `wx_wp_commentmeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_wp_commentmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`meta_id`),
  KEY `comment_id` (`comment_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wx_wp_comments`
--

DROP TABLE IF EXISTS `wx_wp_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_wp_comments` (
  `comment_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_post_ID` bigint(20) unsigned NOT NULL DEFAULT '0',
  `comment_author` tinytext NOT NULL,
  `comment_author_email` varchar(100) NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) NOT NULL DEFAULT '',
  `comment_type` varchar(20) NOT NULL DEFAULT '',
  `comment_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_ID`),
  KEY `comment_approved` (`comment_approved`),
  KEY `comment_post_ID` (`comment_post_ID`),
  KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  KEY `comment_date_gmt` (`comment_date_gmt`),
  KEY `comment_parent` (`comment_parent`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wx_wp_links`
--

DROP TABLE IF EXISTS `wx_wp_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_wp_links` (
  `link_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `link_url` varchar(255) NOT NULL DEFAULT '',
  `link_name` varchar(255) NOT NULL DEFAULT '',
  `link_image` varchar(255) NOT NULL DEFAULT '',
  `link_target` varchar(25) NOT NULL DEFAULT '',
  `link_description` varchar(255) NOT NULL DEFAULT '',
  `link_visible` varchar(20) NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) unsigned NOT NULL DEFAULT '1',
  `link_rating` int(11) NOT NULL DEFAULT '0',
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) NOT NULL DEFAULT '',
  `link_notes` mediumtext NOT NULL,
  `link_rss` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`link_id`),
  KEY `link_visible` (`link_visible`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wx_wp_options`
--

DROP TABLE IF EXISTS `wx_wp_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_wp_options` (
  `option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) NOT NULL DEFAULT '0',
  `option_name` varchar(64) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL,
  `autoload` varchar(20) NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=MyISAM AUTO_INCREMENT=990 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wx_wp_postmeta`
--

DROP TABLE IF EXISTS `wx_wp_postmeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_wp_postmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`meta_id`),
  KEY `post_id` (`post_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=MyISAM AUTO_INCREMENT=151 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wx_wp_posts`
--

DROP TABLE IF EXISTS `wx_wp_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_wp_posts` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext NOT NULL,
  `post_title` text NOT NULL,
  `post_excerpt` text NOT NULL,
  `post_status` varchar(20) NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) NOT NULL DEFAULT 'open',
  `post_password` varchar(20) NOT NULL DEFAULT '',
  `post_name` varchar(200) NOT NULL DEFAULT '',
  `to_ping` text NOT NULL,
  `pinged` text NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` text NOT NULL,
  `post_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `guid` varchar(255) NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `post_name` (`post_name`),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`post_author`)
) ENGINE=MyISAM AUTO_INCREMENT=117 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wx_wp_term_relationships`
--

DROP TABLE IF EXISTS `wx_wp_term_relationships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_wp_term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wx_wp_term_taxonomy`
--

DROP TABLE IF EXISTS `wx_wp_term_taxonomy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_wp_term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) NOT NULL DEFAULT '',
  `description` longtext NOT NULL,
  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wx_wp_terms`
--

DROP TABLE IF EXISTS `wx_wp_terms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_wp_terms` (
  `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(200) NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wx_wp_usermeta`
--

DROP TABLE IF EXISTS `wx_wp_usermeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_wp_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wx_wp_users`
--

DROP TABLE IF EXISTS `wx_wp_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_wp_users` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(64) NOT NULL DEFAULT '',
  `user_nicename` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_url` varchar(100) NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(60) NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-11-06 17:55:58
