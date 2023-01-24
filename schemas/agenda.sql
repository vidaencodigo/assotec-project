USE `asesotec_db`;
CREATE TABLE IF NOT EXISTS `agenda_table` (
    `id` INT,
    `id_usuario` INT,
    `id_materia` INT,
    `dias` enum("lunes", "martes", "miercoles", "jueves", "viernes", "sabado", "domimngo"),
    `hora_inicio` TIME NOT NULL,
    `duracion` INT NOT NULL,
    `hora_fin` TIME NOT NULL,
    `estado` enum('disponible', 'tomada') DEFAULT 'disponible',
    `status` enum('active', 'inactive') DEFAULT 'active',
    `created_at` TIMESTAMP DEFAULT NOW(),
    `updated_at` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
   
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COMMENT='almacena materias';


ALTER TABLE `agenda_table`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `agenda_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

  ALTER TABLE `agenda_table`
    CHANGE updated_at  
        updated_at TIMESTAMP NOT NULL
            DEFAULT CURRENT_TIMESTAMP
            ON UPDATE CURRENT_TIMESTAMP;