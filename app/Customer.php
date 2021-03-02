<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $guarded = ['id'];

    protected $casts = [];

    protected $fillable = ['customer_id', 'customer_type', 'title', 'english_name', 'local_name', 'gender', 'birth_date', 'prefered_language', 'nationality', 'national_id', 'age', 'country', 'city', 'address', 'dial_code', 'mobile_number', 'email', 'receive_notifications', 'office_number', 'total_spent', 'total_points', 'notes', 'moftah_club'];
}
