USE `asesotec_db`;
CREATE TABLE IF NOT EXISTS `comentarios_table` (
    `id` INT,
    `id_asesoria` INT,
    `id_usuario` INT,
    `user_maestro` varchar(255) NOT NULL,
    `califica` enum("0", "1") NOT NULL,
    `status` enum('pending','active', 'inactive') DEFAULT 'pending',
    `created_at` TIMESTAMP DEFAULT NOW(),
    `updated_at` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
   
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COMMENT='almacena calificaion de asesoria';


ALTER TABLE `comentarios_table`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `comentarios_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

  ALTER TABLE `comentarios_table`
    CHANGE updated_at  
        updated_at TIMESTAMP NOT NULL
            DEFAULT CURRENT_TIMESTAMP
            ON UPDATE CURRENT_TIMESTAMP;