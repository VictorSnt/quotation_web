<?php

namespace App\Http\Controllers;

use App\Models\QuotationSubmissionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuotationSubmissionItemController extends Controller
{
    /**
     * Retrieve all quotation submission items.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function findAll()
    {
        $items = QuotationSubmissionItem::all();
        return response()->json($items);
    }

    /**
     * Store a new quotation submission item.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        // Validação do array de itens
        $validator = Validator::make($request->all(), [
            'items' => 'required|array',
            'items.*.submission_id' => 'required|integer|exists:quotation_submissions,submission_id',
            'items.*.item_name' => 'required|string|max:80',
            'items.*.qtitem' => 'required|numeric',
            'items.*.item_brand' => 'nullable|string|max:80',
            'items.*.item_price' => 'nullable|numeric',
            'items.*.item_brand2' => 'nullable|string|max:80',
            'items.*.item_price2' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 400);
        }

        // Inserir todos os itens em massa
        $itemsData = $request->items;
        QuotationSubmissionItem::insert($itemsData);

        return response()->json(['message' => 'Items created successfully'], 201);
    }
}
