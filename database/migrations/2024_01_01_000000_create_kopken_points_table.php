<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Enable PostGIS extension if not already enabled
        DB::statement('CREATE EXTENSION IF NOT EXISTS postgis');

        DB::statement('DROP TABLE IF EXISTS kopken_points');

        DB::statement('
            CREATE TABLE kopken_points (
                id          SERIAL PRIMARY KEY,
                nama_outlet VARCHAR(255),
                alamat      TEXT,
                kecamatan   VARCHAR(255),
                kelurahan   VARCHAR(255),
                tipe_outlet VARCHAR(255),
                dine_in     BOOLEAN,
                takeaway    BOOLEAN,
                delivery    BOOLEAN,
                jam_buka    VARCHAR(50),
                jam_tutup   VARCHAR(50),
                rating      NUMERIC(3,1),
                gambar      VARCHAR(255),
                geom        GEOMETRY(Point, 4326)
            )
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kopken_points');
    }
};
