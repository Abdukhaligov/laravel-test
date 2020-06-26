DELIMITER $$
CREATE
    DEFINER = `root`@`127.0.0.1` PROCEDURE `get_companies`()
    NO SQL
BEGIN
    SELECT `companies`.`id`,
           `companies`.`name`
    FROM `companies`;
END$$
DELIMITER ;

DELIMITER $$
CREATE
    DEFINER = `root`@`127.0.0.1` PROCEDURE `get_company_by_id`(IN `cID` BIGINT)
    NO SQL
BEGIN
    SELECT `companies`.`name`
    FROM `companies`
    WHERE `companies`.`id` = cID
    LIMIT 1;
END$$
DELIMITER ;

DELIMITER $$
CREATE
    DEFINER = `root`@`127.0.0.1` PROCEDURE `get_positions`()
    NO SQL
BEGIN
    SELECT `positions`.`id`,
           `positions`.`name`
    FROM `positions`;
END$$
DELIMITER ;

DELIMITER $$
CREATE
    DEFINER = `root`@`127.0.0.1` PROCEDURE `get_position_by_id`(IN `pID` INT)
    NO SQL
BEGIN
    SELECT `positions`.`name`
    FROM `positions`
    WHERE `positions`.`id` = pID
    LIMIT 1;
END$$
DELIMITER ;

DELIMITER $$
CREATE
    DEFINER = `root`@`127.0.0.1` PROCEDURE `get_positions_by_company`(IN `cID` BIGINT)
    NO SQL
BEGIN
    SELECT DISTINCT `positions`.`name`
    FROM `positions`
             INNER JOIN `company_position`
                        ON `positions`.`id` = `company_position`.`position_id`
    WHERE `company_position`.`company_id` = cID;
END$$
DELIMITER ;

DELIMITER $$
CREATE
    DEFINER = `root`@`127.0.0.1` PROCEDURE `get_companies_by_position`(IN `pID` BIGINT)
    NO SQL
BEGIN
    SELECT DISTINCT `companies`.`name`
    FROM `companies`
             INNER JOIN `company_position`
                        ON `companies`.`id` = `company_position`.`company_id`
    WHERE `company_position`.`position_id` = pID;
END$$
DELIMITER ;

DELIMITER $$
CREATE
    DEFINER = `root`@`127.0.0.1` PROCEDURE `get_users`()
    NO SQL
BEGIN
    SELECT `users`.`email`,
           `users`.`name`,
           `companies`.`name` AS `company`,
           `positions`.`name` AS `position`
    FROM `users`
             LEFT JOIN `companies`
                       ON `companies`.`id` = `users`.`company_id`
             LEFT JOIN `positions`
                       ON `positions`.`id` = `users`.`position_id`;
END$$
DELIMITER ;

DELIMITER $$
CREATE
    DEFINER = `root`@`127.0.0.1` PROCEDURE `get_user_by_id`(IN `uID` BIGINT)
    NO SQL
BEGIN
    SELECT `users`.`email`,
           `users`.`name`,
           `companies`.`name` AS `company`,
           `positions`.`name` AS `position`
    FROM `users`
             LEFT JOIN `companies`
                       ON `companies`.`id` = `users`.`company_id`
             LEFT JOIN `positions`
                       ON `positions`.`id` = `users`.`position_id`
    WHERE `users`.`id` = uID
    LIMIT 1;
END$$
DELIMITER ;

DELIMITER $$
CREATE
    DEFINER = `root`@`127.0.0.1` PROCEDURE `insert_user`(IN `rName` VARCHAR(255), IN `rEmail` VARCHAR(255),
                                                         IN `rPassword` VARCHAR(255), IN `rCompanyID` BIGINT UNSIGNED,
                                                         IN `rPositionID` BIGINT UNSIGNED, IN `rCreated` TIMESTAMP,
                                                         IN `rUpdated` TIMESTAMP)
    NO SQL
BEGIN
    INSERT INTO `users`
    (`name`,
     `email`,
     `password`,
     `company_id`,
     `position_id`,
     `created_at`,
     `updated_at`)
    VALUES (rName,
            rEmail,
            rPassword,
            rCompanyID,
            rPositionID,
            rCreated,
            rUpdated);
    SELECT `users`.*,
           LAST_INSERT_ID() AS id
    FROM `users`
    WHERE `users`.`id` = id
    LIMIT 1;
END$$
DELIMITER ;

DELIMITER $$
CREATE
    DEFINER = `root`@`127.0.0.1` PROCEDURE `update_user`(IN `uID` BIGINT, IN `rName` VARCHAR(255),
                                                         IN `rCompanyID` BIGINT, IN `rPositionID` BIGINT)
    NO SQL
BEGIN
    UPDATE `users`
    SET `name`        = rName,
        `company_id`  = rCompanyID,
        `position_id` = rPositionID
    WHERE `users`.`id` = uID;
END$$
DELIMITER ;

DELIMITER $$
CREATE
    DEFINER = `root`@`127.0.0.1` PROCEDURE `is_user_admin`(IN `uID` BIGINT)
    NO SQL
BEGIN
    SELECT `users`.`admin`
    FROM `users`
    WHERE `users`.`id` = uID
    LIMIT 1;
END$$
DELIMITER ;

