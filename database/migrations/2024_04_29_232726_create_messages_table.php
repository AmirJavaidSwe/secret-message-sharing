<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recipient_id')->nullable()->comment('another user of the system, to share message with');
            $table->unsignedBigInteger('created_by')->nullable()->comment('message sender id');
            $table->text('message')->nullable();
            $table->string('slug')->nullable();
            $table->text('decrypt_key')->nullable();
            $table->boolean('read_once')->default(false);
            $table->dateTime('auto_delete_at')->nullable();
            $table->dateTime('read_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message');
    }
};
