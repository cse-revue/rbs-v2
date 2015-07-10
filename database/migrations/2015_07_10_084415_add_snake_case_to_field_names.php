<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSnakeCaseToFieldNames extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('productions', function($table)
		{
			$table->renameColumn('isclosed', 'is_closed');
			$table->renameColumn('closedate', 'close_date');
			$table->renameColumn('groupticketsamount', 'group_tickets_amount');
			$table->text('group_tickets_message');
			$table->renameColumn('sitelocation', 'site_location');
			$table->renameColumn('faqlocation', 'faq_location');
			$table->renameColumn('acceptsales', 'accept_sales');
			$table->renameColumn('salesinfo', 'sales_info');
			$table->renameColumn('acceptdd', 'accept_dd');
			$table->renameColumn('ddinfo', 'dd_info');
			$table->renameColumn('acceptpaypal', 'accept_paypal');
			$table->renameColumn('paypalaccount', 'paypal_account');
			$table->renameColumn('paypalinfo', 'paypal_info');
			$table->renameColumn('acceptstripe', 'accept_stripe');
			$table->renameColumn('stripepublishablekey', 'stripe_publishable_key');
			$table->renameColumn('stripesecretkey', 'stripe_secret_key');
			$table->renameColumn('stripeinfo', 'stripe_info');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('productions', function($table)
		{
			$table->renameColumn('is_closed', 'isclosed');
			$table->renameColumn('close_date', 'closedate');
			$table->renameColumn('group_tickets_amount', 'groupticketsamount');
			$table->dropColumn('group_tickets_message');
			$table->renameColumn('site_location', 'sitelocation');
			$table->renameColumn('faq_location', 'faqlocation');
			$table->renameColumn('accept_sales', 'acceptsales');
			$table->renameColumn('sales_info', 'salesinfo');
			$table->renameColumn('accept_dd', 'acceptdd');
			$table->renameColumn('dd_info', 'ddinfo');
			$table->renameColumn('accept_paypal', 'acceptpaypal');
			$table->renameColumn('paypal_account', 'paypalaccount');
			$table->renameColumn('paypal_info', 'paypalinfo');
			$table->renameColumn('accept_stripe', 'acceptstripe');
			$table->renameColumn('stripe_publishable_key', 'stripepublishablekey');
			$table->renameColumn('stripe_secret_key', 'stripesecretkey');
			$table->renameColumn('stripe_info', 'stripeinfo');
		});
	}

}
