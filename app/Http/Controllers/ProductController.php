<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $products = Product::all();

            if($products->isEmpty()){
                return response()->json(['message' => 'Nenhum produto cadastrado.',], 404);
            }

            return response()->json([
                'data' => $products,
                'message' => 'Lista de produtos carregada com sucesso.',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao carregar os produtos.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $product = Product::create($request->all());

            return response()->json([
                'message' => 'Produto criado com sucesso.',
                'data' => $product,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao criar o produto.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $product = Product::findOrFail($id);

            return response()->json([
                'data' => $product,
                'message' => 'Produto encontrado.',
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Produto não encontrado.',
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao buscar o produto.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $product = Product::findOrFail($id);
            $product->update($request->all());

            return response()->json([
                'message' => 'Produto atualizado com sucesso.',
                'data' => $product,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Produto não encontrado.',
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao atualizar o produto.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();

            return response()->json([
                'message' => 'Produto removido com sucesso.',
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Produto não encontrado.',
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao remover o produto.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
