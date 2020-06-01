<?php

namespace App\Http\Controllers;

use App\carts;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Throwable;
use function Symfony\Component\VarDumper\Dumper\esc;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return carts[]|Collection
     */
    public function index()
    {

        return carts::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        if (!empty($request->input('product_id'))) {
            $res = DB::select("SELECT * FROM products WHERE id = " . $request->input('product_id'));
            if ($res) {
                DB::table('carts')->insert([
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString(),
                    'quantity' => 1,
                    'product_id' => $request->input('product_id')
                ]);
                return response()->json([
                    "quantity" => 1,
                    "product" => $res[0]

                ])->setStatusCode('200');
            } else {

                return response()->json([
                    "errorInfo" => [
                        "42000",
                        1064,
                        "unknow id"
                    ]
                ])->setStatusCode('404');
            }
        } else {
            return response()->json([
                "errorInfo" => [
                    "42000",
                    1064,
                    "Erreur de syntaxe près de '' à la ligne 1"
                ]])->setStatusCode('422');
        }


    }


    public function destroy(carts $cart)
    {

        try {
            $cart->delete();
                return response()->json([
                    null
                ])->setStatusCode('200');
        } catch (Exception $e) {
            return response()->json([
                    $e
            ])->setStatusCode('404');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return JsonResponse|object
     */
    public function delete()
    {
        DB::table('carts')->delete();
        return response()->json([
            null
        ])->setStatusCode('200');
    }
}
