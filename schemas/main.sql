CREATE DATABASE IF NOT EXISTS `asesotec_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;

USE `asesotec_db`;
CREATE TABLE IF NOT EXISTS `users_table` (
    `id` INT,
    `user` varchar(255) NOT NULL,
    `name` varchar(255) NOT NULL,
    `last_name` varchar(255) NOT NULL,
    `mail` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `user_type` enum('administrador','usuario', 'maestro', 'alumno') DEFAULT 'alumno',
    `profile_image` longblob,
    `status` enum('active', 'inactive') DEFAULT 'active',
    `created_at` TIMESTAMP DEFAULT NOW(),
    `updated_at` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE(user),
    UNIQUE(mail)
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COMMENT='almacena usuarios';



-- LLAVES PRIMARIAS

ALTER TABLE `users_table`
  ADD PRIMARY KEY (`id`);



-- AUTO INCREMENTOS

ALTER TABLE `users_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;


-- Arregla el campo de cambio de fecha automatico 
-- a la hora de actualizar
ALTER TABLE `users_table`
    CHANGE updated_at  
        updated_at TIMESTAMP NOT NULL
            DEFAULT CURRENT_TIMESTAMP
            ON UPDATE CURRENT_TIMESTAMP;

/* AGREGAR EN SQL */
ALTER TABLE `users_table`
  `semestre` VARCHAR(255) NOT NULL;
  ALTER TABLE `users_table`
  `carrera` VARCHAR(255) NOT NULL;


