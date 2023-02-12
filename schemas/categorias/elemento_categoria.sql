USE `asesotec_db`;
CREATE TABLE IF NOT EXISTS `elemento_categoria_table` (
    `id` INT,
    `id_categoria` INT,
    `id_elemento` INT,
    `created_at` TIMESTAMP DEFAULT NOW(),
    `updated_at` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
   
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='almacena elementos en categoria';


ALTER TABLE `elemento_categoria_table`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `elemento_categoria_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

  ALTER TABLE elemento_categoria_table
    CHANGE updated_at  
        updated_at TIMESTAMP NOT NULL
            DEFAULT CURRENT_TIMESTAMP
            ON UPDATE CURRENT_TIMESTAMP;


ALTER TABLE `elemento_categoria_table` 
ADD CONSTRAINT `categoria_fk_id` 
FOREIGN KEY (`id_categoria`) 
REFERENCES `categorias_table` (`id`) 
ON DELETE CASCADE ON UPDATE CASCADE; 

ALTER TABLE `elemento_categoria_table` 
ADD CONSTRAINT `video_fk_id` 
FOREIGN KEY (`id_elemento`) 
REFERENCES `videos_table` (`id`) 
ON DELETE CASCADE ON UPDATE CASCADE; 