CREATE TABLE IF NOT EXISTS `Recipes` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `title` VARCHAR(255) NOT NULL,
    `ingredients` TEXT,
    `instructions` TEXT,
    `servings` INT,
    `source` VARCHAR(255),
    `user_id` INT,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `Users`(`id`) ON DELETE CASCADE  -- Assuming Users table has 'id' as primary key
);
