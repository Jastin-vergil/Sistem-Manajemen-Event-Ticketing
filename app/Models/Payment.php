<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'participant_name',
        'participant_email',
        'ticket_name',
        'total_payment',
        'proof_file',
        'status'
    ];
}