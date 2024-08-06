<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('users')->insert([
            'id' => Str::orderedUuid(),
            'name' => 'Admin',
            'email' => 'admin@botika.online',
            'password' => password_hash('admin1234', PASSWORD_DEFAULT),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('users')->where('email', 'admin@botika.online')->delete();
    }
};
