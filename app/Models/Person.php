<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gender;

class Person extends Model
{
    use HasFactory;

    protected $table 	= 'people';

    protected $guarded  = ['id'];

    protected $fillable = [
        'name', 'detail'
    ];

    protected $primaryKey = 'id';

    public function Gender()
	{
		return $this->hasMany(Gender::class,'gender_id','id');
	}
}
