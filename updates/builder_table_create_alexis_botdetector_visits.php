<?php namespace Alexis\Botdetector\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateAlexisBotdetectorVisits extends Migration
{
    public function up()
    {
        Schema::create('alexis_botdetector_visits', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('bot_owner', 255)->nullable();
            $table->string('bot_description', 255)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('alexis_botdetector_visits');
    }
}
