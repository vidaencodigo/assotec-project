USE `asesotec_db`;
CREATE TABLE IF NOT EXISTS `videos_table` (
    `id` INT,
    `id_usuario` INT,
    `titulo` VARCHAR(255) NOT NULL,
    `descripcion` TEXT,
    `url` VARCHAR(255),
    `status` enum('active', 'inactive') DEFAULT 'active',
    `created_at` TIMESTAMP DEFAULT NOW(),
    `updated_at` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
   
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='almacena calificaion de asesoria';


ALTER TABLE `videos_table`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `videos_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

  ALTER TABLE `videos_table`
    CHANGE updated_at  
        updated_at TIMESTAMP NOT NULL
            DEFAULT CURRENT_TIMESTAMP
            ON UPDATE CURRENT_TIMESTAMP;