USE `asesotec_db`;
CREATE TABLE IF NOT EXISTS `alumno_detalle` (
    `id` INT,
    `id_usuario` INT UNIQUE,
    `semestre` VARCHAR(255) NOT NULL,
    `carrera` VARCHAR(255) NOT NULL,
    `status` enum('active', 'inactive') DEFAULT 'active',
    `created_at` TIMESTAMP DEFAULT NOW(),
    `updated_at` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
   
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='almacena detalles alumno';


ALTER TABLE `alumno_detalle`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `alumno_detalle`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

  ALTER TABLE `alumno_detalle`
    CHANGE updated_at  
        updated_at TIMESTAMP NOT NULL
            DEFAULT CURRENT_TIMESTAMP
            ON UPDATE CURRENT_TIMESTAMP;


ALTER TABLE `alumno_detalle` ADD CONSTRAINT `detalle_fk_alumno_id` FOREIGN KEY (`id_usuario`) REFERENCES `users_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE; 