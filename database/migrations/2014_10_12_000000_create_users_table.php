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
        Schema::create('users', function (Blueprint $table) {
            // $table->id();
            $table->char('nip')->primary();
            $table->string('nama');
            // $table->timestamp('email_verified_at')->nullable();
            $table->string('jabatan');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        $password = Hash::make('123456');

        DB::table('users')->insert([
            'nip' => '1234',
            'nama' => 'DONI',
            'jabatan' => 'DIREKTUR',
            'password' => $password
        ]);

        DB::table('users')->insert([
            'nip' => '1235',
            'nama' => 'DONO',
            'jabatan' => 'FINANCE',
            'password' => $password
        ]);

        DB::table('users')->insert([
            'nip' => '1236',
            'nama' => 'DONA',
            'jabatan' => 'STAFF',
            'password' => $password
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
