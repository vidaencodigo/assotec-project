USE `asesotec_db`;
CREATE TABLE IF NOT EXISTS `asesorias_table` (
    `id` INT,
    `id_usuario` INT,
    `id_horario_materia` INT,
    `tipo` enum("presencial", "virtual"),
    `salon` VARCHAR(150) NULL,
    `descripcion` TEXT,
    `url_sesion` VARCHAR(255),
    `status` enum('active', 'inactive') DEFAULT 'active',
    `created_at` TIMESTAMP DEFAULT NOW(),
    `updated_at` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
   
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='almacena oferta de asesoria';


ALTER TABLE `asesorias_table`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `asesorias_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

  ALTER TABLE asesorias_table
    CHANGE updated_at  
        updated_at TIMESTAMP NOT NULL
            DEFAULT CURRENT_TIMESTAMP
            ON UPDATE CURRENT_TIMESTAMP;



ALTER TABLE asesorias_table
ADD dia varchar(255);

ALTER TABLE asesorias_table
ADD inicio time;
ALTER TABLE asesorias_table
ADD fin time;