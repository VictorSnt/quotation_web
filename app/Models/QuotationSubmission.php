<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationSubmission extends Model
{
    use HasFactory;

    protected $table = 'quotation_submissions';
    protected $primaryKey = 'submission_id';
    public $timestamps = false;

    protected $fillable = [
        'quotation_id',
        'user_id'
    ];

    public function quotationItems()
    {
        return $this->hasMany(
            QuotationSubmissionItem::class, 
            'submission_id', 
            'submission_id'
        );
    }
}
