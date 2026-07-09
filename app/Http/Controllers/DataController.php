<?php
namespace App\Http\Controllers;

use App\Events\DataInserted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function index()
    {
        return view('data.index');
    }

    public function store(Request $request)
    {
        $id = DB::table('items')->insertGetId([
            'name'       => $request->name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $item = DB::table('items')
            ->where('id', $id)
            ->first();

        broadcast(new DataInserted($item));

        return response()->json(['success' => true]);
    }

    public function show()
    {
        $items = DB::table('items')
            ->orderBy('id', 'desc')
            ->get();

        return view('data.view', compact('items'));
    }
}
