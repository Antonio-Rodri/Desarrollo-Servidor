<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\FrutasFactory;

#[UseFactory(FrutasFactory::class)]
class Fruta extends Model
{
    use HasFactory;
    protected $table = 'frutas';
}
