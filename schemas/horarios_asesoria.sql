USE `asesotec_db`;
CREATE TABLE IF NOT EXISTS `horarios_asesorias_table` (
    `id` INT,
    `id_usuario` INT,
    `id_materia` INT,
    `dia` VARCHAR(20) NOT NULL,
    `horaInicio` TIME,
    `horaFin` TIME,
    `status` enum('active', 'inactive') DEFAULT 'active',
    `created_at` TIMESTAMP DEFAULT NOW(),
    `updated_at` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
   
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='almacena horarios de asesoria';


ALTER TABLE `horarios_asesorias_table`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `horarios_asesorias_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

  ALTER TABLE `horarios_asesorias_table`
    CHANGE updated_at  
        updated_at TIMESTAMP NOT NULL
            DEFAULT CURRENT_TIMESTAMP
            ON UPDATE CURRENT_TIMESTAMP;