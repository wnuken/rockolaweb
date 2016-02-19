
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- music
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `music`;

CREATE TABLE `music`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `rock_id` VARCHAR(24) NOT NULL,
    `youtube_id` VARCHAR(24) NOT NULL,
    `gender_id` INTEGER NOT NULL,
    `author_id` INTEGER NOT NULL,
    `countplay` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `music_fi_43d98c` (`gender_id`),
    INDEX `music_fi_ea464c` (`author_id`),
    CONSTRAINT `music_fk_43d98c`
        FOREIGN KEY (`gender_id`)
        REFERENCES `genders` (`id`),
    CONSTRAINT `music_fk_ea464c`
        FOREIGN KEY (`author_id`)
        REFERENCES `author` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- author
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `author`;

CREATE TABLE `author`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `nationality` VARCHAR(128) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- genders
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `genders`;

CREATE TABLE `genders`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(128) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- songlist
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `songlist`;

CREATE TABLE `songlist`
(
    `time` DOUBLE NOT NULL,
    `song` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`time`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
