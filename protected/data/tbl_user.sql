CREATE TABLE tbl_user (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `codigo_verificacion` varchar(128) NOT NULL,
  `activo` tinyint(0) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_user`)
)
