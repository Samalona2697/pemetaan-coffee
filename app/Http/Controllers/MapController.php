<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class MapController extends Controller
{
    public function index()
    {
        $kopikenangan = DB::select("
            SELECT 
                nama_outlet as nama, 
                alamat, 
                kecamatan, 
                kelurahan, 
                tipe_outlet, 
                dine_in, 
                takeaway, 
                delivery, 
                jam_buka,
                jam_tutup,
                rating,
                gambar,
                lat,
                lng
            FROM kopken_points
        ");
        $fore = DB::select("
            SELECT 
                nama_outlet as nama,
                alamat,
                kecamatan,
                kelurahan,
                tipe_outlet,
                dine_in,
                takeaway,
                delivery,
                jam_buka,
                jam_tutup,
                rating,
                gambar,
                lat,
                lng
            FROM fore_points
        ");
        return view('map', compact('kopikenangan', 'fore'));
    }

    public function nearest(Request $request)
    {
        $lat = $request->lat;
        $lng = $request->lng;

        $kopken = DB::select("
            SELECT 
                nama_outlet as nama,
                alamat,
                kecamatan,
                kelurahan,
                tipe_outlet,
                dine_in,
                takeaway,
                delivery,
                jam_buka,
                jam_tutup,
                rating,
                gambar,
                lat,
                lng,
                (6371000 * acos(
                    cos(radians(?)) * cos(radians(lat)) *
                    cos(radians(lng) - radians(?)) +
                    sin(radians(?)) * sin(radians(lat))
                )) as jarak
            FROM kopken_points
            ORDER BY jarak ASC
            LIMIT 10
        ", [$lat, $lng, $lat]);

        $fore = DB::select("
            SELECT 
                nama_outlet as nama,
                alamat,
                kecamatan,
                kelurahan,
                tipe_outlet,
                dine_in,
                takeaway,
                delivery,
                jam_buka,
                jam_tutup,
                rating,
                gambar,
                lat,
                lng,
                (6371000 * acos(
                    cos(radians(?)) * cos(radians(lat)) *
                    cos(radians(lng) - radians(?)) +
                    sin(radians(?)) * sin(radians(lat))
                )) as jarak
            FROM fore_points
            ORDER BY jarak ASC
            LIMIT 10
        ", [$lat, $lng, $lat]);

        return response()->json([
            'kopken' => $kopken,
            'fore' => $fore
        ]);
    }
}
