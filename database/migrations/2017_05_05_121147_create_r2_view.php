<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateR2View extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW R2View AS
         SELECT course_id, 
         MIN(sessions.end-created_at) as fastest, 
         MAX(sessions.end-created_at) as slowest, 
         AVG(sessions.end-created_at) as average 
         FROM sessions 
         GROUP BY course_id");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW R2View");
    }
}
