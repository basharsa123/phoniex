<?php

use App\Models\location;
use App\Models\User;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->enum('status' , ['Pending' , 'Delivered' , 'Canceled' , 'Accepted']);
            $table->foreignIdFor(User::class,"user_id")->constrained()->cascadeOnDelete();
            $table->foreignIdFor(location::class,"location_id")->constrained()->cascadeOnDelete();
            $table->string("total_price");
            $table->double('date_of_deliver');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
