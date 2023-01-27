USE `asesotec_db`;
CREATE TABLE IF NOT EXISTS `sesorias_table` (
    `id` INT,
    `id_usuario` INT,
    `id_horario_materia` INT,
    `tipo` enum("presencial", "virtual"),
    `salon` VARCHAR(150) NULL,
    `descripcion` TEXT NOT NULL, 
    `status` enum('active', 'inactive') DEFAULT 'active',
    `created_at` TIMESTAMP DEFAULT NOW(),
    `updated_at` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
   
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='almacena oferta de asesoria';


ALTER TABLE `sesorias_table`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `sesorias_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

  ALTER TABLE `sesorias_table`
    CHANGE updated_at  
        updated_at TIMESTAMP NOT NULL
            DEFAULT CURRENT_TIMESTAMP
            ON UPDATE CURRENT_TIMESTAMP;