<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // SP: sp_devolver_prestamo
        DB::unprepared("
            DROP PROCEDURE IF EXISTS sp_devolver_prestamo;
            CREATE PROCEDURE sp_devolver_prestamo(IN p_id_presta INT)
            BEGIN
                DECLARE v_id_ejemplar INT;

                SELECT ID_EJEMPLAR INTO v_id_ejemplar
                FROM presta
                WHERE ID_PRESTA = p_id_presta;

                IF v_id_ejemplar IS NOT NULL THEN
                    UPDATE presta
                    SET ESTADO_PRESTA = 0,
                        FECHA_DEVO = NOW(),
                        updated_at = NOW()
                    WHERE ID_PRESTA = p_id_presta;

                    UPDATE ejemplar
                    SET ESTADO_EJEMPLAR = 0,
                        updated_at = NOW()
                    WHERE ID_EJEMPLAR = v_id_ejemplar;
                END IF;
            END
        ");

        // SP: sp_obtener_email_por_prestamo
        DB::unprepared("
            DROP PROCEDURE IF EXISTS sp_obtener_email_por_prestamo;
            CREATE PROCEDURE sp_obtener_email_por_prestamo(IN p_id_presta INT)
            BEGIN
                SELECT u.email
                FROM presta p
                JOIN users u ON u.ID_USUARIO = p.ID_USUARIO
                WHERE p.ID_PRESTA = p_id_presta;
            END
        ");

        // SP: sp_prestamos_con_estado_ejemplar_3
        DB::unprepared("
            DROP PROCEDURE IF EXISTS sp_prestamos_con_estado_ejemplar_3;
            CREATE PROCEDURE sp_prestamos_con_estado_ejemplar_3()
            BEGIN
                SELECT 
                    p.ID_PRESTA,
                    p.ID_EJEMPLAR,
                    p.ID_USUARIO,
                    e.ESTADO_EJEMPLAR
                FROM presta p
                JOIN ejemplar e ON p.ID_EJEMPLAR = e.ID_EJEMPLAR
                WHERE e.ESTADO_EJEMPLAR = 3;
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_devolver_prestamo");
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_obtener_email_por_prestamo");
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_prestamos_con_estado_ejemplar_3");
    }
};
