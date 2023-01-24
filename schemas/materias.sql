USE `asesotec_db`;
CREATE TABLE IF NOT EXISTS `materias_agenda_table` (
    `id` INT,
    `id_usuario` INT,
    `name` varchar(255) NOT NULL,
    `status` enum('active', 'inactive') DEFAULT 'active',
    `created_at` TIMESTAMP DEFAULT NOW(),
    `updated_at` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
   
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COMMENT='almacena materias';


ALTER TABLE `materias_agenda_table`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `materias_agenda_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

  ALTER TABLE `materias_agenda_table`
    CHANGE updated_at  
        updated_at TIMESTAMP NOT NULL
            DEFAULT CURRENT_TIMESTAMP
            ON UPDATE CURRENT_TIMESTAMP;