DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `twitter` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_twitter` (`twitter`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--
INSERT INTO `user` VALUES (1,'dollyaswin','827ccb0eea8a706c4c34a16891f84e7b','dollyaswin');
