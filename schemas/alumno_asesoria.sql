USE `asesotec_db`;
CREATE TABLE IF NOT EXISTS `alumno_asesoria` (
    `id` INT,
    `id_usuario` INT,
    `id_asesoria` INT,
    `status` enum('active', 'inactive') DEFAULT 'active',
    `created_at` TIMESTAMP DEFAULT NOW(),
    `updated_at` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
   
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='almacena asesoria inscrita';


ALTER TABLE `alumno_asesoria`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `alumno_asesoria`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

  ALTER TABLE asesorias_table
    CHANGE updated_at  
        updated_at TIMESTAMP NOT NULL
            DEFAULT CURRENT_TIMESTAMP
            ON UPDATE CURRENT_TIMESTAMP;



