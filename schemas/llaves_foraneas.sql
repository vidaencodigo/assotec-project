USE `asesotec_db`;

/*
-- para la tabla materias
ALTER TABLE `materias_agenda_table` ADD CONSTRAINT `usuario_id` FOREIGN KEY (`id_usuario`) REFERENCES `users_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


-- para la agenda

ALTER TABLE `horarios_asesorias_table` ADD CONSTRAINT `usuario` FOREIGN KEY (`id_usuario`) REFERENCES `users_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `horarios_asesorias_table` ADD CONSTRAINT `materia` FOREIGN KEY (`id_materia`) REFERENCES `materias_agenda_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `comentarios_table` ADD CONSTRAINT `usuario_asesoria` FOREIGN KEY (`id_usuario`) REFERENCES `users_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `comentarios_table` ADD CONSTRAINT `asesoria` FOREIGN KEY (`id_asesoria`) REFERENCES `agenda_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
*/


-- COMENTARIOS


