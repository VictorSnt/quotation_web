<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class QuotationController extends Controller
{
    /**
     * Retorna todas as cotações com seus itens.
     *
     * @return JsonResponse
     */
    public function findAll(): JsonResponse
    {
        $quotations = Quotation::with('items')->get();

        return response()->json($quotations);
    }

    /**
     * Retorna uma cotação específica pelo ID com seus itens.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function findById(int $id): JsonResponse
    {
        try {
            $quotation = Quotation::with('items')->findOrFail($id);

            return response()->json($quotation);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Quotation not found'], 404);
        }
    }
}
