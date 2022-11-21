<?php

namespace App\Http\Controllers\Produto;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PaginationController;


class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function seach(Request $request, PaginationController $PaginationController)
    {

        if ($request->limit) {
            $limit = $request->limit;
        } else {
            $limit = 2;
        }
        if ($request->titulo == "") {
            return response()->json([
                "Produtos" => 204
            ], 400);
        }
        if ($request->titulo) {

            $seach = '%' . $request->titulo . '%';
            try {
                $produto = DB::table('produtos')
                    ->select('id', 'nome', 'descricao', 'tensao', 'marca')
                    ->where("nome", "LIKE", $seach)
                    ->get();
                if (count($produto) == 0) {
                    return response()->json([
                        "Produtos" => 204
                    ], 400);
                }
                return response()->json([
                    "Produtos" => $produto
                ], 200);
            } catch (\Throwable $erro) {
                return response()->json([
                    "status" => $erro
                ], 500);
            }
        }
        try {
            return response()->json(
                $PaginationController->produto($limit),
                200
            );
        } catch (\Throwable $erro) {
            return response()->json([
                "status" => $erro
            ], 500);
        }
    }


    public function index(Request $request, PaginationController $PaginationController)
    {

        if ($request->limit) {
            $limit = $request->limit;
        } else {
            $limit = 2;
        }
        if ($request->titulo) {

            $seach = '%' . $request->titulo . '%';
            try {
                $produto = DB::table('produtos')
                    ->select('id', 'nome', 'descricao', 'tensao', 'marca')
                    ->where("nome", "LIKE", $seach)
                    ->get();
                if (count($produto) == 0) {
                    return response()->json([
                        "Produtos" => 204
                    ], 400);
                }
                return response()->json([
                    "Produtos" => $produto
                ], 200);
            } catch (\Throwable $erro) {
                return response()->json([
                    "status" => $erro
                ], 500);
            }
        }
        try {
            return response()->json(
                $PaginationController->produto($limit),
                200
            );
        } catch (\Throwable $erro) {
            return response()->json([
                "status" => $erro
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $produto = new Produto();
            $produto->nome = $request->produto['nome'];
            $produto->descricao =  $request->produto['descricao'];
            $produto->tensao =  $request->produto['tensao'];
            $produto->marca =  $request->produto['marca'];
            $produto->save();
            return response()->json([
                "status" => "produto cadastrado com sucesso",
                "produto" => $produto
            ], 200);
        } catch (\Throwable $erro) {
            return response()->json([
                "status" => "erro",
                "produto" => $erro
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        $produto = Produto::find($request->id);
        try {
            $produto->id;
            return $produto;
        } catch (\Throwable $th) {
            return response()->json([
                "status" => 'Produto não encontrado'
            ], 204);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        try {
            $produto = Produto::find($request->id);
            $produto->nome = $request->nome;
            $produto->descricao = $request->descricao;
            $produto->tensao = $request->tensao;
            $produto->marca = $request->marca;
            $produto->save();
            return response()->json([
                "status" => "Produto editado com sucesso",
                "cargo" => $produto
            ], 200);
        } catch (\Throwable $erro) {
            return response()->json([
                "error" => "erro desconhecido"
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $produto = Produto::find($request->id);
        try {
            $produto->delete();
            return response()->json([
                "status" => 'Produto deletado com sucesso',
                "produto" => $produto
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => 'produto não encontrado'
            ], 204);
        }
    }
}
