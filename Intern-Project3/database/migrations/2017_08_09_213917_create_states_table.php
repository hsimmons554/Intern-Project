<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->increments('id');
            $table->string('state_name');
            $table->string('state_abbreviation');
            $table->timestamps();
        });

        // Insert 12 states into table
        DB::table('states')->insert(
          array(
              'state_name' => 'Louisiana',
              'state_abbreviation' => 'LA',
              'created_at' => DB::raw('CURRENT_TIMESTAMP')
              )
            );
        DB::table('states')->insert(
          array(
            'state_name' => 'Texas',
            'state_abbreviation' => 'TX',
            'created_at' => DB::raw('CURRENT_TIMESTAMP')
          )
        );
        DB::table('states')->insert(
          array(
              'state_name' => 'California',
              'state_abbreviation' => 'CA',
              'created_at' => DB::raw('CURRENT_TIMESTAMP')
              )
            );
        DB::table('states')->insert(
          array(
            'state_name' => 'Mississippi',
            'state_abbreviation' => 'MS',
            'created_at' => DB::raw('CURRENT_TIMESTAMP')
          )
        );
        DB::table('states')->insert(
          array(
              'state_name' => 'Main',
              'state_abbreviation' => 'ME',
              'created_at' => DB::raw('CURRENT_TIMESTAMP')
              )
            );
        DB::table('states')->insert(
          array(
            'state_name' => 'Missouri',
            'state_abbreviation' => 'MO',
            'created_at' => DB::raw('CURRENT_TIMESTAMP')
          )
        );
        DB::table('states')->insert(
          array(
              'state_name' => 'Arkansas',
              'state_abbreviation' => 'AR',
              'created_at' => DB::raw('CURRENT_TIMESTAMP')
              )
            );
        DB::table('states')->insert(
          array(
            'state_name' => 'New Jersey',
            'state_abbreviation' => 'NJ',
            'created_at' => DB::raw('CURRENT_TIMESTAMP')
          )
        );
        DB::table('states')->insert(
          array(
              'state_name' => 'New York',
              'state_abbreviation' => 'NY',
              'created_at' => DB::raw('CURRENT_TIMESTAMP')
              )
            );
        DB::table('states')->insert(
          array(
            'state_name' => 'Ohio',
            'state_abbreviation' => 'OH',
            'created_at' => DB::raw('CURRENT_TIMESTAMP')
          )
        );
        DB::table('states')->insert(
          array(
              'state_name' => 'Pennsylvania',
              'state_abbreviation' => 'PA',
              'created_at' => DB::raw('CURRENT_TIMESTAMP')
              )
            );
        DB::table('states')->insert(
          array(
            'state_name' => 'Utah',
            'state_abbreviation' => 'UT',
            'created_at' => DB::raw('CURRENT_TIMESTAMP')
          )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states');
    }
}
