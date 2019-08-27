
DROP TABLE IF EXISTS `bono_module_testimonials`;
CREATE TABLE `bono_module_testimonials` (
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `published` varchar(1) NOT NULL,
    `order` INT NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = UTF8;

DROP TABLE IF EXISTS `bono_module_testimonials_translations`;
CREATE TABLE `bono_module_testimonials_translations` (
    `id` INT NOT NULL,
    `lang_id` INT NOT NULL,
    `author` varchar(100),
    `content` LONGTEXT,

    FOREIGN KEY (id) REFERENCES bono_module_testimonials(id) ON DELETE CASCADE,
    FOREIGN KEY (lang_id) REFERENCES bono_module_cms_languages(id) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = UTF8;
