<?php

use App\Models\Professor;
use App\Models\Room;
use App\Models\Subject;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Room::class);
            $table->foreignIdFor(Professor::class)->nullable();
            $table->foreignIdFor(Subject::class)->nullable();
            $table->string('remarks')->nullable();
            $table->datetime('date_from');
            $table->datetime('date_to');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
};
