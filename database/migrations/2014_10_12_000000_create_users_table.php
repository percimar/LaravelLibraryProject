<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('member');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
        ['name' => 'Admin', 'email' => 'admin@admin.com', 'password' => Hash::make('adminadmin'), 'role' => 'admin']);
        DB::table('users')->insert([
            ['name' => 'Aahmad', 'email' => 'aahmad@aahmad.com', 'password' => Hash::make('asifasif')],
            ['name' => 'Asmar', 'email' => 'asmar@asmar.com', 'password' => Hash::make('asmarasmar')],
            ['name' => 'Mahmoud', 'email' => 'mahmoud@mahmoud.com', 'password' => Hash::make('selimselim')],
            ['name' => 'Omar', 'email' => 'omar@omar.com', 'password' => Hash::make('omaromar')]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
