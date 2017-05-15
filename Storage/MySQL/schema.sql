
DROP TABLE IF EXISTS `bono_module_testimonials`;
CREATE TABLE `bono_module_testimonials` (
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `lang_id` INT NOT NULL,
    `published` varchar(1) NOT NULL,
    `order` INT NOT NULL,
    `author` varchar(100),
    `content` LONGTEXT   
) DEFAULT CHARSET = UTF8;