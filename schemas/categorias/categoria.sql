USE `asesotec_db`;
CREATE TABLE IF NOT EXISTS `categorias_table` (
    `id` INT,
    `id_usuario` INT,
    `nombre` varchar(250) NOT NULL,
    `status` enum('active', 'inactive') DEFAULT 'active',
    `created_at` TIMESTAMP DEFAULT NOW(),
    `updated_at` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
   
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='almacena categorias';


ALTER TABLE `categorias_table`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `categorias_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

  ALTER TABLE categorias_table
    CHANGE updated_at  
        updated_at TIMESTAMP NOT NULL
            DEFAULT CURRENT_TIMESTAMP
            ON UPDATE CURRENT_TIMESTAMP;

ALTER TABLE `categorias_table` 
ADD CONSTRAINT `user_categoria_fk_id` 
FOREIGN KEY (`id_usuario`) 
REFERENCES `users_table` (`id`) 
ON DELETE CASCADE ON UPDATE CASCADE; 