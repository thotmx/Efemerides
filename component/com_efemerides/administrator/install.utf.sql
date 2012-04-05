DROP TABLE IF EXISTS `#__efemerides`;

CREATE TABLE `#__efemerides` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(500),
  `historicdate` date NOT NULL DEFAULT '2008-01-04',
  `description` text NOT NULL,
  `alias` varchar(255) NOT NULL,
  `published` int(1) NOT NULL default '0' COMMENT 'Core field',
  `ordering` int(11) NOT NULL default '0' COMMENT 'Core field',
  `access` int(11) NOT NULL default '0' COMMENT 'Core field',
  PRIMARY KEY  (`id`),
  KEY `idx_alias` (`alias`),
  KEY `idx_published_access` (`published`,`access`)
) ENGINE=MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

INSERT INTO `#__efemerides` (`historicdate`,`title`, `description`) VALUES (DATE('2008-01-04'),'Titulo','Fecha memorable'),
(DATE('2008-05-01'),'Fecha1', '<p><strong>Otra</strong> fecha importante</p><img src="images/stories/articles.jpg" border="0" />'),
(DATE('2008-05-06'),'Fecha2', 'Otra fecha mas importante'), (NOW(),'Fecha 3','Hecho de ejemplo');
