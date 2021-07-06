<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SecondMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 

        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 50)->unique();
            $table->string('description',250)->nullable(); 
            $table->string('image_url',250)->nullable();
        });

        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('created_user', 50);
            $table->string('updated_user', 50);
            $table->string('name', 50)->unique();
            $table->string('city_code', 50)->nullable();
            $table->string('adress', 250)->nullable();
            $table->string('latutude', 20)->nullable();
            $table->string('langitude', 20)->nullable();
            $table->string('remark', 250)->nullable();
            $table->string('image_url', 250)->nullable();
            $table->foreignId('category_id')->nullable()->constrained('product_categories');
        });
 

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('created_user', 50);
            $table->string('updated_user', 50);
            $table->string('name', 50);
            $table->float('price')->default(0);
            $table->string('display_name', 50);
            $table->foreignId('category_id')->nullable()->constrained('product_categories'); 
            $table->longText('tags')->nullable();
            $table->string('image_url', 250)->nullable();
            $table->string('description', 250)->nullable();
        });

        Schema::create('product_suppliers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('created_user', 50);
            $table->string('updated_user', 50);
            $table->foreignId('product_id')->nullable()->constrained('products');
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers');
            $table->foreignId('category_id')->nullable()->constrained('product_categories');

            $table->string('image_url', 250)->nullable();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
