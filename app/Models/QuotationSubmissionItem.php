<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationSubmissionItem extends Model
{
    use HasFactory;

    protected $table = 'quotation_submission_items';
    protected $primaryKey = 'submission_item_id';
    public $timestamps = false;

    protected $fillable = [
        'submission_id',
        'item_name',
        'qtitem',
        'item_brand',
        'item_price',
        'item_brand2',
        'item_price2'
    ];

    public function submission()
    {
        return $this->belongsTo(QuotationSubmission::class, 'submission_id', 'submission_id');
    }
}

