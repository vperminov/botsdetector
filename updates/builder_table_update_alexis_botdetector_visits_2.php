<?php namespace Alexis\Botdetector\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlexisBotdetectorVisits2 extends Migration
{
    public function up()
    {
        Schema::table('alexis_botdetector_visits', function($table)
        {
            $table->string('page_url', 255)->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('alexis_botdetector_visits', function($table)
        {
            $table->dropColumn('page_url');
        });
    }
}
