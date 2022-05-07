<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignData extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'html',
        'sender',
        'subject',
        'design_html'
    ];
}