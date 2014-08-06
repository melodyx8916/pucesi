CREATE TABLE tbl_image (
    id_image INT(11) NOT NULL AUTO_INCREMENT,
    id_user INT(11) NOT NULL,
    title VARCHAR(120) NOT NULL,
    folder VARCHAR(120) NOT NULL,
    image VARCHAR(120) NOT NULL,
    PRIMARY KEY (id_image)
);