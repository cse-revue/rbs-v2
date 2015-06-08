<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrateOldDatabase extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
 
        Schema::create('admin', function($table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('email', 50)->unique();
            $table->string('salt', 6);
            $table->string('password', 100);
            $table->string('phone', 12);
            $table->boolean('super_admin');
        });

        Schema::create('booked_seat', function($table) {
            $table->increments('id');
            $table->string('seat', 6);
            $table->unsignedInteger('booking');
            $table->unsignedInteger('status');
            $table->unsignedInteger('price')->nullable();
            $table->string('guid', 16)->nullable()->unique();
            $table->boolean('collected');
        });

 
        Schema::create('booking', function($table) {
            $table->increments('id');
            $table->unsignedInteger('user');
            $table->boolean('booked_by_admin');
            $table->unsignedInteger('performance');
            $table->string('name', 50);
            $table->string('email', 50);
            $table->text('description');
            $table->text('user_description');
            $table->string('phone_number', 16);
            $table->boolean('pickedup');
            $table->unsignedInteger('discount');
            $table->unsignedInteger('amount_paid');
            $table->dateTime('deadline');
            $table->unsignedInteger('email_sent');
            $table->timestamp('booked_time')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('modified_time')->default("0000-00-00 00:00:00");
        });

        Schema::create('closed_segment', function($table) {
            $table->unsignedInteger('performance');
            $table->unsignedInteger('segment');
        });
 
        Schema::create('paypal_log', function($table) {
            $table->increments('id');
            $table->unsignedInteger('time');
            $table->text('arguments')->nullable();
            $table->text('log')->nullable();
        });
 
        Schema::create('performance', function($table) {
            $table->increments('id');
            $table->unsignedInteger('production');
            $table->date('date');
            $table->string('start_time', 15);
            $table->string('finish_time', 15);
            $table->text('description');
            $table->string('title', 50);
            $table->boolean('is_closed');
            $table->text('closed_message');
            $table->boolean('auto_expire');
            $table->unsignedInteger('pay_window');
            $table->unsignedInteger('expire_time_of_day');
            $table->dateTime('deadline');
        });

 
        Schema::create('price', function($table) {
            $table->increments('id');
            $table->unsignedInteger('performance');
            $table->string('name', 50);
            $table->unsignedInteger('price');
            $table->boolean('admin_only');
        });

 
        Schema::create('production_admin', function($table) {
            $table->integer('admin');
            $table->integer('production');
            $table->boolean('can_manage');
        });
 
        Schema::create('production', function($table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->text('header');
            $table->text('footer');
            $table->string('css', 50);
            $table->boolean('is_closed');
            $table->date('closed_ate');
            $table->string('theatre', 20);
            $table->string('site_location', 60);
            $table->string('bookings_location', 60);
            $table->string('faq_location', 60);
            $table->string('sales_email', 60);
            $table->text('sales_info');
            $table->boolean('accept_sales');
            $table->boolean('accept_dd');
            $table->boolean('accept_paypal');
            $table->string('paypal_account', 50)->nullable();
            $table->text('paypal_info')->nullable();
            $table->text('dd_info')->nullable();
            $table->unsignedInteger('group_tickets_amount');
            $table->boolean('accept_stripe')->nullable();
            $table->string('stripe_publishable_key', 255)->nullable();
            $table->string('stripe_secret_key', 255)->nullable();
            $table->string('stripe_info', 255)->nullable();
        });

 
        Schema::create('session', function($table) {
            $table->increments('id', 32);
            $table->dateTime('last_access')->default("0000-00-00 00:00:00");
            $table->text('data')->nullable();
        });

        Schema::create('user', function($table) {
            $table->unsignedInteger('production');
            $table->string('name', 50);
            $table->string('phone_number', 12);
            $table->boolean('admin');
            $table->string('paymentid', 6);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('admin');
        Schema::drop('booked_seat');
        Schema::drop('booking');
        Schema::drop('closed_segment');
        Schema::drop('paypal_log');
        Schema::drop('performance');
        Schema::drop('price');
        Schema::drop('producion_admin');
        Schema::drop('production');
        Schema::drop('session');
        Schema::table('users', function(Blueprint $table)
        {
            $table->dropColumn('name');
            $table->dropColumn('phone');
            $table->dropColumn('admin');
            $table->dropColumn('paymentid');
        });
    }

}
