
DROP TABLE IF EXISTS `bono_module_testimonials`;
CREATE TABLE `bono_module_testimonials` (
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `lang_id` INT NOT NULL,
    `author` varchar(100),
    `content` TEXT   
) DEFAULT CHARSET = UTF8;