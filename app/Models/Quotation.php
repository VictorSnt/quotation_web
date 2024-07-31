<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $table = 'quotations';
    protected $primaryKey = 'quotation_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'description',
        'created_at',
        'status',
    ];

    protected $casts = [
        'created_at' => 'date',
        'status' => 'boolean',
    ];

    public function items()
    {
        return $this->hasMany(QuotationItem::class, 'quotation_id', 'quotation_id');
    }

    public function __toString()
    {
        return "<Quotation(id={$this->quotation_id} status={$this->status})>";
    }
}
