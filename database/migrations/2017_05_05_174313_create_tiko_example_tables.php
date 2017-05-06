<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTikoExampleTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE TABLE opiskelijat(
            nro INT NOT NULL,
            nimi VARCHAR(50) NOT NULL,
            p_aine VARCHAR(50),
            PRIMARY KEY (nro)
            );
        ");

        DB::statement("
            CREATE TABLE kurssit(
            id INT NOT NULL,
            nimi VARCHAR(50) NOT NULL,
            opettaja VARCHAR(50) NOT NULL,
            PRIMARY KEY (id)
            );
        ");

        DB::statement("
            CREATE TABLE suoritukset(
            k_id INT NOT NULL,
            op_nro INT NOT NULL,
            arvosana INT NOT NULL,
            FOREIGN KEY (op_nro) REFERENCES opiskelijat (nro),
            FOREIGN KEY (k_id) REFERENCES kurssit (id)
            );
        ");

        $inserts = "INSERT INTO opiskelijat VALUES (1, 'Maija', 'TKO');
            INSERT INTO opiskelijat VALUES (2, 'Ville', 'TKO');
            INSERT INTO opiskelijat VALUES (3, 'Kalle', 'VT');
            INSERT INTO opiskelijat VALUES (4, 'Liisa', 'VT');
            INSERT INTO kurssit VALUES (1, 'tkp', 'KI');
            INSERT INTO kurssit VALUES (2, 'oope', 'JL');
            INSERT INTO kurssit VALUES (3, 'tiko', 'MJ');
            INSERT INTO suoritukset VALUES (1, 1, 5);
            INSERT INTO suoritukset VALUES (1, 2, 4);
            INSERT INTO suoritukset VALUES (1, 3, 2);
            INSERT INTO suoritukset VALUES (2, 1, 5);
            INSERT INTO suoritukset VALUES (2, 2, 3);
            INSERT INTO suoritukset VALUES (2, 4, 3);
            INSERT INTO suoritukset VALUES (3, 1, 5);
            INSERT INTO suoritukset VALUES (3, 2, 4)";

        $inserts = explode(';', $inserts);

        foreach ($inserts as $insert) {
            DB::statement(DB::raw($insert));
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement(DB::raw("DROP TABLE suoritukset"));
        DB::statement(DB::raw("DROP TABLE opiskelijat"));
        DB::statement(DB::raw("DROP TABLE kurssit"));
    }
}
