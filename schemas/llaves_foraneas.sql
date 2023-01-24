USE `asesotec_db`;


-- para la tabla materias
ALTER TABLE `materias_agenda_table` ADD CONSTRAINT `usuario_id` FOREIGN KEY (`id_usuario`) REFERENCES `users_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


-- para la agenda

ALTER TABLE `agenda_table` ADD CONSTRAINT `usuario_id` FOREIGN KEY (`id_usuario`) REFERENCES `users_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `agenda_table` ADD CONSTRAINT `materia_id` FOREIGN KEY (`id_materia`) REFERENCES `materias_agenda_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;