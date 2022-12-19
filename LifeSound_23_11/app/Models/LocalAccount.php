<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalAccount extends Model
{
    use HasFactory;
    protected $table = 'local_accounts';
    protected $primaryKey = 'id_local';
    protected $fillable = ['name_local','local_account','id_province','id_district','id_ward','id_street','email_account','phone_account','id_account'];
    public $timestamps = false;
}
