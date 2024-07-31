<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationSubmission extends Model
{
    use HasFactory;

    protected $table = 'quotation_submissions';
    protected $primaryKey = 'quotation_submission_id';
    public $timestamps = false;

    protected $fillable = [
        'quotation_id',
        'user_id'
    ];

    public function quotationItems()
    {
        return $this->hasMany(
            QuotationSubmissionItem::class, 
            'quotation_submission_id', 
            'quotation_submission_id'
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}