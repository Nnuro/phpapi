<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWholesalerProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wholesaler_products', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('batch_number', 191);
			$table->decimal('price', 19, 8)->default(0.00000000);
			$table->dateTime('expiry_date');
			$table->string('expiry_status', 191);
			$table->string('type', 191);
			$table->integer('status')->nullable()->default(1);
			$table->timestamps();
			$table->softDeletes();
			$table->integer('wholesaler_id');
			$table->bigInteger('products_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('wholesaler_products');
	}

}
