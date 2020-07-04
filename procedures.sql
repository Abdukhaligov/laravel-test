DELIMITER $$
CREATE
    DEFINER = `root`@`127.0.0.1` PROCEDURE `delete_product`(IN `parametrId` BIGINT UNSIGNED)
    NO SQL
BEGIN
    DELETE
    FROM `products`
    WHERE `products`.`id` = parametrId;
END$$
DELIMITER ;

DELIMITER $$
CREATE
    DEFINER = `root`@`127.0.0.1` PROCEDURE `clear_user_roles`(IN `parameterId` BIGINT)
    NO SQL
BEGIN
    DELETE
    FROM `user_role`
    WHERE `user_role`.`user_id` = parameterId;
END$$
DELIMITER ;

DELIMITER $$
CREATE
    DEFINER = `root`@`127.0.0.1` PROCEDURE `delete_user`(IN `parametrId` BIGINT)
    NO SQL
BEGIN
    DELETE
    FROM `users`
    WHERE `users`.`id` = parametrId;
END$$
DELIMITER ;

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
    DEFINER = `root`@`127.0.0.1` PROCEDURE `get_companies_by_position`(IN `parameterId` BIGINT)
    NO SQL
BEGIN
    SELECT DISTINCT `companies`.`name`
    FROM `companies`
             INNER JOIN `company_position`
                        ON `companies`.`id` = `company_position`.`company_id`
    WHERE `company_position`.`position_id` = parameterId;
END$$
DELIMITER ;

DELIMITER $$
CREATE
    DEFINER = `root`@`127.0.0.1` PROCEDURE `get_company_by_id`(IN `parameterId` BIGINT)
    NO SQL
BEGIN
    SELECT `companies`.`name`
    FROM `companies`
    WHERE `companies`.`id` = parameterId
    LIMIT 1;
END$$
DELIMITER ;

DELIMITER $$
CREATE
    DEFINER = `root`@`127.0.0.1` PROCEDURE `get_media`(IN `parameterModel` VARCHAR(255),
                                                       IN `parameterModelId` BIGINT UNSIGNED,
                                                       IN `parameterCollection` VARCHAR(255))
    NO SQL
BEGIN
    SELECT `media`.`id`,
           `media`.`name`,
           `media`.`file_name` AS path,
           `media`.`mime_type`,
           `media`.`size`,
           `media`.`order_column`,
           `media`.`created_at`
    FROM `media`
    WHERE `media`.`model_type`
              COLLATE utf8mb4_general_ci = parameterModel
      AND `media`.`model_id` = parameterModelId
      AND `media`.`collection_name`
              COLLATE utf8mb4_general_ci = parameterCollection
    ORDER BY ID DESC;
END$$
DELIMITER ;

DELIMITER $$
CREATE
    DEFINER = `root`@`127.0.0.1` PROCEDURE `get_media_order_column`(IN `parameterModel` VARCHAR(255), IN `parameterId` BIGINT UNSIGNED)
    NO SQL
BEGIN
    SELECT `media`.`order_column`
    FROM `media`
    WHERE `media`.`model_type`
              COLLATE utf8mb4_general_ci = parameterModel
      AND `media`.`model_id` = parameterId
    ORDER BY ID DESC
    LIMIT 1;
END$$
DELIMITER ;

DELIMITER $$
CREATE
    DEFINER = `root`@`127.0.0.1` PROCEDURE `get_position_by_id`(IN `parameterId` INT)
    NO SQL
BEGIN
    SELECT `positions`.`name`
    FROM `positions`
    WHERE `positions`.`id` = parameterId
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
    DEFINER = `root`@`127.0.0.1` PROCEDURE `get_positions_by_company`(IN `parameterId` BIGINT)
    NO SQL
BEGIN
    SELECT DISTINCT `positions`.`name`
    FROM `positions`
             INNER JOIN `company_position`
                        ON `positions`.`id` = `company_position`.`position_id`
    WHERE `company_position`.`company_id` = parameterId;
END$$
DELIMITER ;

DELIMITER $$
CREATE
    DEFINER = `root`@`127.0.0.1` PROCEDURE `get_products`()
    NO SQL
BEGIN
    SELECT `products`.*,
           `users`.`name` AS `user`
    FROM `products`
             LEFT JOIN `users`
                       ON `users`.`id` = `products`.`user_id`
    ORDER BY `id` DESC;
END$$
DELIMITER ;

DELIMITER $$
CREATE
    DEFINER = `root`@`127.0.0.1` PROCEDURE `get_roles`()
    NO SQL
BEGIN
    SELECT `roles`.`id`,
           `roles`.`name`
    FROM `roles`;
END$$
DELIMITER ;

DELIMITER $$
CREATE
    DEFINER = `root`@`127.0.0.1` PROCEDURE `get_user_by_id`(IN `parameterId` BIGINT)
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
    WHERE `users`.`id` = parameterId
    LIMIT 1;
END$$
DELIMITER ;

DELIMITER $$
CREATE
    DEFINER = `root`@`127.0.0.1` PROCEDURE `get_user_roles`(IN `parameterUserId` BIGINT)
    NO SQL
BEGIN
    SELECT DISTINCT `roles`.`name`, `roles`.`id`
    FROM `roles`
             INNER JOIN `user_role`
                        ON `roles`.`id` = `user_role`.`role_id`
    WHERE `user_role`.`user_id` = parameterUserId;
END$$
DELIMITER ;

DELIMITER $$
CREATE
    DEFINER = `root`@`127.0.0.1` PROCEDURE `get_users`()
    NO SQL
BEGIN
    SELECT `users`.`id`,
           `users`.`email`,
           `users`.`name`,
           `users`.`company_id`,
           `companies`.`name` AS `company`,
           `users`.`position_id`,
           `positions`.`name` AS `position`,
           `users`.`updated_at`,
           `users`.`created_at`
    FROM `users`
             LEFT JOIN `companies`
                       ON `companies`.`id` = `users`.`company_id`
             LEFT JOIN `positions`
                       ON `positions`.`id` = `users`.`position_id`;
END$$
DELIMITER ;

DELIMITER $$
CREATE
    DEFINER = `root`@`127.0.0.1` PROCEDURE `insert_media`(IN `parameterModel` VARCHAR(255), IN `parameterId` BIGINT,
                                                          IN `parameterCollection` VARCHAR(255),
                                                          IN `parameterName` VARCHAR(255),
                                                          IN `parameterFileName` VARCHAR(255),
                                                          IN `parameterMimeType` VARCHAR(255),
                                                          IN `parameterDisk` VARCHAR(255), IN `parameterSize` BIGINT,
                                                          IN `parameterOrder` INT, IN `parameterCreatedAt` TIMESTAMP,
                                                          IN `parameterUpdatedAt` TIMESTAMP)
    NO SQL
BEGIN
    INSERT INTO `media`
    (`model_type`, `model_id`, `collection_name`,
     `name`, `file_name`, `mime_type`, `disk`, `size`,
     `manipulations`, `custom_properties`, `responsive_images`,
     `order_column`, `created_at`, `updated_at`)
    VALUES (parameterModel, parameterId, parameterCollection,
            parameterName, parameterFileName, parameterMimeType,
            parameterDisk, parameterSize, '[]', '[]', '[]',
            parameterSize, parameterCreatedAt, parameterUpdatedAt);
    SELECT LAST_INSERT_ID() AS id
    LIMIT 1;
END$$
DELIMITER ;

DELIMITER $$
CREATE
    DEFINER = `root`@`127.0.0.1` PROCEDURE `insert_product`(IN `parameterName` VARCHAR(255),
                                                            IN `parameterCategory` VARCHAR(255),
                                                            IN `parameterPrice` INT,
                                                            IN `parameterUserId` BIGINT UNSIGNED,
                                                            IN `parameterCreated` TIMESTAMP,
                                                            IN `parameterUpdated` TIMESTAMP)
    NO SQL
BEGIN
    INSERT INTO `products`
    (`name`, `category`, `price`,
     `user_id`, `created_at`, `updated_at`)
    VALUES (parameterName, parameterCategory, parameterPrice,
            parameterUserId, parameterCreated, parameterUpdated);
END$$
DELIMITER ;

DELIMITER $$
CREATE
    DEFINER = `root`@`127.0.0.1` PROCEDURE `insert_user`(IN `parameterName` VARCHAR(255),
                                                         IN `parameterEmail` VARCHAR(255),
                                                         IN `parameterPassword` VARCHAR(255),
                                                         IN `parameterCompanyId` BIGINT UNSIGNED,
                                                         IN `parameterPositionId` BIGINT UNSIGNED,
                                                         IN `parameterCreated` TIMESTAMP,
                                                         IN `parameterUpdated` TIMESTAMP)
    NO SQL
BEGIN
    INSERT INTO `users`
    (`name`, `email`, `password`,
     `company_id`, `position_id`,
     `created_at`, `updated_at`)
    VALUES (parameterName, parameterEmail, parameterPassword,
            parameterCompanyId, parameterPositionId,
            parameterCreated, parameterUpdated);
    SELECT `users`.*
    FROM `users`
    WHERE `users`.`id` = LAST_INSERT_ID()
    LIMIT 1;
END$$
DELIMITER ;

DELIMITER $$
CREATE
    DEFINER = `root`@`127.0.0.1` PROCEDURE `insert_user_role`(IN `parameterUserId` BIGINT, IN `parameterRoleId` BIGINT)
    NO SQL
BEGIN
    INSERT INTO `user_role`
        (`user_id`, `role_id`)
    VALUES (parameterUserId, parameterRoleId);
END$$
DELIMITER ;

DELIMITER $$
CREATE
    DEFINER = `root`@`127.0.0.1` PROCEDURE `update_product`(IN `parameterId` BIGINT UNSIGNED,
                                                            IN `parametName` VARCHAR(255),
                                                            IN `parametCategory` VARCHAR(255), IN `parametPrice` INT,
                                                            IN `parametUpdatedAt` TIMESTAMP)
    NO SQL
BEGIN
    UPDATE `products`
    SET `name`       = parametName,
        `category`   = parametCategory,
        `price`      = parametPrice,
        `updated_at` = parametUpdatedAt
    WHERE `products`.`id` = parameterId;
END$$
DELIMITER ;

DELIMITER $$
CREATE
    DEFINER = `root`@`127.0.0.1` PROCEDURE `update_user`(IN `parameterId` BIGINT, IN `parameterName` VARCHAR(255),
                                                         IN `parameterCompanyID` BIGINT,
                                                         IN `parameterPositionID` BIGINT,
                                                         IN `parameterUpdatedAt` TIMESTAMP)
    NO SQL
BEGIN
    UPDATE `users`
    SET `name`        = parameterName,
        `company_id`  = parameterCompanyID,
        `position_id` = parameterPositionID,
        `updated_at`  = parameterUpdatedAt
    WHERE `users`.`id` = parameterId;
END$$
DELIMITER ;
