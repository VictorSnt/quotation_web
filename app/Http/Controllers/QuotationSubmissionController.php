<?php

namespace App\Http\Controllers;

use App\Models\QuotationSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuotationSubmissionController extends Controller
{
    /**
     * Retrieve all quotation submissions.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function findAll()
    {
        $submissions = QuotationSubmission::all();
        return response()->json($submissions);
    }

    /**
     * Store a new quotation submission.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'quotation_id' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 400);
        }

        $submission = QuotationSubmission::create($request->all());

        return response()->json($submission, 201);
    }
}
