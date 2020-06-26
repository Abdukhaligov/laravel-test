DELIMITER $$
CREATE
    DEFINER = `root`@`127.0.0.1` PROCEDURE `get_companies`()
    NO SQL
BEGIN
    SELECT `companies`.`name`
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
    WHERE `companies`.`id` = cID;
END$$
DELIMITER ;

DELIMITER $$
CREATE
    DEFINER = `root`@`127.0.0.1` PROCEDURE `get_positions`()
    NO SQL
BEGIN
    SELECT `positions`.`name`
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
    WHERE `positions`.`id` = pID;
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
    WHERE `users`.`id` = uID;
END$$
DELIMITER ;

