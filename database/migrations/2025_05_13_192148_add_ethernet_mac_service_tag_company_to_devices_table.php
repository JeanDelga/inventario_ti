<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('devices', function (Blueprint $table) {
            $table->string('ethernet_mac_address')->nullable()->after('mac_address');
            $table->string('service_tag')->nullable()->after('serial_number');
            $table->string('company')->nullable()->after('mac_address');
        });
    }

    public function down(): void
    {
        Schema::table('devices', function (Blueprint $table) {
            $table->dropColumn(['ethernet_mac_address', 'service_tag', 'company']);
        });
    }
};
