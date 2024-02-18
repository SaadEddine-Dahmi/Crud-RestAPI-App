<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    use HasFactory;


    protected $fillable = [
        "ref_titre",
        "valeur",
        "lang",
        'status'
    ];
    protected $attributes = [
        'status' => 'active', // Set the default value to 'active' 
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->status = 'active'; // Set the 'status' attribute to 'active' in the constructor
    }
}
