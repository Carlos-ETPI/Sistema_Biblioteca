<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoredProceduresSeeder extends Seeder
{
    public function run()
    {
        // Primero borramos el procedimiento si ya existe
        DB::unprepared('DROP PROCEDURE IF EXISTS get_ejemplares_disponibles');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_despachar_varios_ejemplares');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_libros_prestados_por_usuario');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_prestar_ejemplar');
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_usuarios_con_prestamos');
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_devolver_prestamo");
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_obtener_email_por_prestamo");
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_prestamos_con_estado_ejemplar_3");

        // Ahora creamos el procedimiento sin DELIMITER
        DB::unprepared('
            CREATE PROCEDURE get_ejemplares_disponibles()
            BEGIN
                SELECT 
                    e.ID_EJEMPLAR,
                    t.NOMBRE_TITULO,
                    c.NOM_CATEGORIA,
                    c.DESCRIPCION_CATEGORIA,
                    GROUP_CONCAT(CONCAT(a.NOM_AUTOR, " ", a.APE_AUTOR) SEPARATOR ", ") AS AUTORES
                FROM EJEMPLAR e
                JOIN TITULO t ON e.ID_TITULO = t.ID_TITULO
                JOIN TITULOAUTOR ta ON t.ID_TITULO = ta.ID_TITULO
                JOIN AUTOR a ON ta.ID_AUTOR = a.ID_AUTOR
                JOIN CATEGORIA c ON c.ID_CATEGORIA = t.ID_CATEGORIA
                LEFT JOIN PRESTA p ON e.ID_EJEMPLAR = p.ID_EJEMPLAR AND p.ESTADO_PRESTA = 1
                WHERE p.ID_PRESTA IS NULL
                    AND e.ESTADO_EJEMPLAR = 1
                GROUP BY e.ID_EJEMPLAR, t.NOMBRE_TITULO, c.NOM_CATEGORIA, c.DESCRIPCION_CATEGORIA;
            END
        ');

        DB::unprepared("
    CREATE PROCEDURE sp_despachar_varios_ejemplares (
        IN p_ids_ejemplares TEXT
    )
    BEGIN
        DECLARE v_id INT;
        DECLARE done INT DEFAULT FALSE;

        DECLARE ejemplar_cursor CURSOR FOR 
            SELECT CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(p_ids_ejemplares, ',', numbers.n), ',', -1) AS UNSIGNED) AS id
            FROM (
                SELECT 1 AS n UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5
                UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL SELECT 10
            ) AS numbers
            WHERE numbers.n <= LENGTH(p_ids_ejemplares) - LENGTH(REPLACE(p_ids_ejemplares, ',', '')) + 1;

        DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

        OPEN ejemplar_cursor;

        read_loop: LOOP
            FETCH ejemplar_cursor INTO v_id;
            IF done THEN
                LEAVE read_loop;
            END IF;

            UPDATE EEMPLAR
            SET ESTADO_EJEMPLAR = 3, updated_at = NOW()
            WHERE ID_EJEMPLAR = v_id;

            UPDATE PRESTA
            SET ESTADO_PRESTA = 2, updated_at = NOW()
            WHERE ID_EJEMPLAR = v_id AND ESTADO_PRESTA = 1;

        END LOOP;

        CLOSE ejemplar_cursor;
    END
");


        DB::unprepared('
            CREATE PROCEDURE sp_libros_prestados_por_usuario(
                IN p_id_usuario INT
            )
            BEGIN
                SELECT 
                    t.ID_TITULO,
                    t.NOMBRE_TITULO,
                    p.FECHA_PRESTA,
                    p.FECHA_DEVO,
                    e.ID_EJEMPLAR
                FROM PRESTA p
                INNER JOIN EJEMPLAR e ON e.ID_EJEMPLAR = p.ID_EJEMPLAR
                INNER JOIN TITULO t ON t.ID_TITULO = e.ID_TITULO
                WHERE p.ID_USUARIO = p_id_usuario
                  AND p.ESTADO_PRESTA = 1
                ORDER BY p.FECHA_PRESTA;
            END
        ');

        DB::unprepared('
            CREATE PROCEDURE sp_prestar_ejemplar (
                IN p_id_ejemplar INT,
                IN p_id_usuario INT,
                IN p_dias_prestamo INT
            )
            BEGIN
                DECLARE v_existente INT DEFAULT 0;
                DECLARE v_id_costo_presta INT;

                -- Verificar si el ejemplar ya está prestado
                SELECT COUNT(*) INTO v_existente
                FROM PRESTA
                WHERE ID_EJEMPLAR = p_id_ejemplar
                  AND ESTADO_PRESTA = 1;

                IF v_existente > 0 THEN
                    SIGNAL SQLSTATE \'45000\'
                    SET MESSAGE_TEXT = \'El ejemplar ya está prestado\';
                ELSE
                    -- Insertar un nuevo costo de préstamo con valores por defecto
                    INSERT INTO COSTO_PRESTA (
                      COSTO_PRESTA,
                      MORA_PRESTA,
                      ESTADO_CANCELADO,
                      MONTO_CANCELADO,
                      created_at,
                      updated_at
                    ) VALUES (
                      0, 0, 0, 0, NOW(), NOW()
                    );

                    -- Obtener el ID recién insertado
                    SET v_id_costo_presta = LAST_INSERT_ID();

                    -- Insertar en la tabla presta
                    INSERT INTO PRESTA (
                      ID_EJEMPLAR,
                      ID_USUARIO,
                      ID_COSTO_PRESTA,
                      ESTADO_PRESTA,
                      FECHA_PRESTA,
                      FECHA_DEVO,
                      created_at,
                      updated_at
                    ) VALUES (
                      p_id_ejemplar,
                      p_id_usuario,
                      v_id_costo_presta,
                      1,
                      CURDATE(),
                      DATE_ADD(CURDATE(), INTERVAL p_dias_prestamo DAY),
                      NOW(),
                      NOW()
                    );

                    -- Actualizar el estado del ejemplar a no disponible
                    UPDATE EJEMPLAR
                    SET ESTADO_EJEMPLAR = 0
                    WHERE ID_EJEMPLAR = p_id_ejemplar;
                END IF;
            END
        ');

        DB::unprepared('
            CREATE PROCEDURE sp_usuarios_con_prestamos()
            BEGIN
                SELECT 
                    us.id AS ID_USUARIO,
                    p.DUI_PERSONA,
                    p.NOMBRE_PERSONA,
                    p.APELLIDO_PERSONA,
                    COUNT(pr.ID_PRESTA) AS total_prestamos,
                    GROUP_CONCAT(pr.ID_EJEMPLAR) AS ejemplares_prestados
                FROM USUARIO u
                INNER JOIN PERSONA p ON p.ID_PERSONA = u.ID_PERSONA
                INNER JOIN users us ON us.id = u.ID_USUARIO
                INNER JOIN PRESTA pr ON pr.ID_USUARIO = us.id
                WHERE pr.ESTADO_PRESTA = 1
                GROUP BY us.id, p.DUI_PERSONA, p.NOMBRE_PERSONA, p.APELLIDO_PERSONA;
            END
        ');

        DB::unprepared("
            DROP PROCEDURE IF EXISTS sp_devolver_prestamo;
            CREATE PROCEDURE sp_devolver_prestamo(IN p_id_presta INT)
            BEGIN
                DECLARE v_id_ejemplar INT;

                SELECT ID_EJEMPLAR INTO v_id_ejemplar
                FROM PRESTA
                WHERE ID_PRESTA = p_id_presta;

                IF v_id_ejemplar IS NOT NULL THEN
                    UPDATE PRESTA
                    SET ESTADO_PRESTA = 0,
                        FECHA_DEVO = NOW(),
                        updated_at = NOW()
                    WHERE ID_PRESTA = p_id_presta;

                    UPDATE EJEMPLAR
                    SET ESTADO_EJEMPLAR = 0,
                        updated_at = NOW()
                    WHERE ID_EJEMPLAR = v_id_ejemplar;
                END IF;
            END
        ");

         DB::unprepared("
            DROP PROCEDURE IF EXISTS sp_obtener_email_por_prestamo;
            CREATE PROCEDURE sp_obtener_email_por_prestamo(IN p_id_presta INT)
            BEGIN
                SELECT u.email
                FROM PRESTA p
                JOIN users u ON u.ID_USUARIO = p.ID_USUARIO
                WHERE p.ID_PRESTA = p_id_presta;
            END
        ");

        DB::unprepared("
            DROP PROCEDURE IF EXISTS sp_prestamos_con_estado_ejemplar_3;
            CREATE PROCEDURE sp_prestamos_con_estado_ejemplar_3()
            BEGIN
                SELECT 
                    p.ID_PRESTA,
                    p.ID_EJEMPLAR,
                    p.ID_USUARIO,
                    e.ESTADO_EJEMPLAR
                FROM PRESTA p
                JOIN EJEMPLAR e ON p.ID_EJEMPLAR = e.ID_EJEMPLAR
                WHERE e.ESTADO_EJEMPLAR = 3;
            END
        ");

    }
}
