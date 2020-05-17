
CREATE TABLE IF NOT EXISTS `young1377588`.`account` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(255) NULL DEFAULT NULL,
  `last_name` VARCHAR(255) NULL DEFAULT NULL,
  `email` VARCHAR(255) NULL DEFAULT NULL,
  `username` VARCHAR(255) NULL DEFAULT NULL,
  `password` VARCHAR(255) NULL DEFAULT NULL,
  `birth_date` DATE NULL DEFAULT NULL,
  `street` VARCHAR(255) NULL DEFAULT NULL,
  `postcode` INT(11) NULL DEFAULT NULL,
  `city` VARCHAR(255) NULL DEFAULT NULL,
  `country` VARCHAR(255) NULL DEFAULT NULL,
  `premium` TINYINT(1) NULL DEFAULT NULL,
  `type` VARCHAR(20) NULL DEFAULT NULL,
  `profile_path` VARCHAR(50) NULL DEFAULT NULL,
  `phone` VARCHAR(25) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `young1377588`.`worker`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `young1377588`.`worker` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `maximum_distance` INT(11) NULL DEFAULT NULL,
  `id_account` INT(11) NULL DEFAULT NULL,
  `star` DOUBLE NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `id_account` (`id_account` ASC),
  CONSTRAINT `worker_ibfk_1`
    FOREIGN KEY (`id_account`)
    REFERENCES `young1377588`.`account` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `young1377588`.`day`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `young1377588`.`day` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `young1377588`.`availability`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `young1377588`.`availability` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_worker` INT(11) NULL DEFAULT NULL,
  `id_day` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `id_worker` (`id_worker` ASC),
  INDEX `id_day` (`id_day` ASC),
  CONSTRAINT `availability_ibfk_1`
    FOREIGN KEY (`id_worker`)
    REFERENCES `young1377588`.`worker` (`id`),
  CONSTRAINT `availability_ibfk_2`
    FOREIGN KEY (`id_day`)
    REFERENCES `young1377588`.`day` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `young1377588`.`message`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `young1377588`.`message` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_work` INT(11) NOT NULL,
  `id_sender` INT(11) NOT NULL,
  `content` VARCHAR(255) NULL DEFAULT NULL,
  `sendtime` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isRead` INT(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `young1377588`.`notification`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `young1377588`.`notification` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_sender` INT(11) NULL DEFAULT NULL,
  `id_receiver` INT(11) NULL DEFAULT NULL,
  `content` VARCHAR(255) NULL DEFAULT NULL,
  `sendtime` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `id_sender` (`id_sender` ASC),
  INDEX `id_receiver` (`id_receiver` ASC),
  CONSTRAINT `notification_ibfk_1`
    FOREIGN KEY (`id_sender`)
    REFERENCES `young1377588`.`account` (`id`),
  CONSTRAINT `notification_ibfk_2`
    FOREIGN KEY (`id_receiver`)
    REFERENCES `young1377588`.`account` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `young1377588`.`refused_worker`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `young1377588`.`refused_worker` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_work` INT(11) NOT NULL,
  `id_worker` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `young1377588`.`requester`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `young1377588`.`requester` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_account` INT(11) NULL DEFAULT NULL,
  `premium` TINYINT(1) NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  INDEX `id_account` (`id_account` ASC),
  CONSTRAINT `requester_ibfk_1`
    FOREIGN KEY (`id_account`)
    REFERENCES `young1377588`.`account` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `young1377588`.`type_work`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `young1377588`.`type_work` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `young1377588`.`woker_Typer_work`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `young1377588`.`woker_Typer_work` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_worker` INT(11) NULL DEFAULT NULL,
  `id_type_work` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `id_worker` (`id_worker` ASC),
  INDEX `id_type_work` (`id_type_work` ASC),
  CONSTRAINT `woker_Typer_work_ibfk_1`
    FOREIGN KEY (`id_worker`)
    REFERENCES `young1377588`.`worker` (`id`),
  CONSTRAINT `woker_Typer_work_ibfk_2`
    FOREIGN KEY (`id_type_work`)
    REFERENCES `young1377588`.`type_work` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `young1377588`.`work`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `young1377588`.`work` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NULL DEFAULT NULL,
  `id_type` INT(11) NULL DEFAULT NULL,
  `description` TEXT NULL DEFAULT NULL,
  `id_requester` INT(11) NULL DEFAULT NULL,
  `id_worker` INT(11) NULL DEFAULT NULL,
  `min_age_worker` INT(11) NULL DEFAULT NULL,
  `date_start` DATE NULL DEFAULT NULL,
  `time_start` TIME NULL DEFAULT NULL,
  `time_end` TIME NULL DEFAULT NULL,
  `place` VARCHAR(255) NULL DEFAULT NULL,
  `statut_progress` VARCHAR(50) NULL DEFAULT NULL,
  `paid` TINYINT(1) NULL DEFAULT '0',
  `cancelled` TINYINT(1) NULL DEFAULT '0',
  `finish` TINYINT(4) NULL DEFAULT NULL,
  `price` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `id_type` (`id_type` ASC),
  INDEX `id_requester` (`id_requester` ASC),
  INDEX `id_worker` (`id_worker` ASC),
  CONSTRAINT `work_ibfk_1`
    FOREIGN KEY (`id_type`)
    REFERENCES `young1377588`.`type_work` (`id`),
  CONSTRAINT `work_ibfk_2`
    FOREIGN KEY (`id_requester`)
    REFERENCES `young1377588`.`requester` (`id`),
  CONSTRAINT `work_ibfk_3`
    FOREIGN KEY (`id_worker`)
    REFERENCES `young1377588`.`worker` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


