hg<?php

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
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->string('number');
                $table->string('name');
                $table->string('slug')->unique();
                $table->text('description')->nullable();
                $table->string('image')->nullable();
                $table->float('price')->default(0);
                $table->float('compare_price')->nullable();
                $table->unsignedSmallInteger('quantity')->default(0);
                $table->json('options')->nullable();
                $table->float('rating')->default(0);
                $table->boolean('featured')->default(0);
                $table->enum('status', ['active', 'draft', 'inactive'])->default('active');
                $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
                $table->foreignId('store_id')->constrained('stores')->cascadeOnDelete();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('products');
        }
    };
