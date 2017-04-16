<?php namespace Alexis\Botdetector\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlexisBotdetectorVisits extends Migration
{
    public function up()
    {
        Schema::table('alexis_botdetector_visits', function($table)
        {
            $table->boolean('reported')->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('alexis_botdetector_visits', function($table)
        {
            $table->dropColumn('reported');
        });
    }
}
