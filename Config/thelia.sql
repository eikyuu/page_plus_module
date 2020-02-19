
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- page_plus
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `page_plus`;

CREATE TABLE `page_plus`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- page_plus_product
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `page_plus_product`;

CREATE TABLE `page_plus_product`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `product_id` INTEGER,
    `page_plus_id` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `page_plus_product_FI_1` (`page_plus_id`),
    INDEX `page_plus_product_FI_2` (`product_id`),
    CONSTRAINT `page_plus_product_FK_1`
        FOREIGN KEY (`page_plus_id`)
        REFERENCES `page_plus` (`id`)
        ON UPDATE RESTRICT
        ON DELETE CASCADE,
    CONSTRAINT `page_plus_product_FK_2`
        FOREIGN KEY (`product_id`)
        REFERENCES `product` (`id`)
        ON UPDATE RESTRICT
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- page_plus_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `page_plus_i18n`;

CREATE TABLE `page_plus_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) DEFAULT 'en_US' NOT NULL,
    `title` VARCHAR(255),
    `description` LONGTEXT,
    `image` VARCHAR(255),
    `alt` VARCHAR(255),
    PRIMARY KEY (`id`,`locale`),
    CONSTRAINT `page_plus_i18n_FK_1`
        FOREIGN KEY (`id`)
        REFERENCES `page_plus` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
