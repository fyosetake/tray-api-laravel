<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'email'];

    protected $table = 'Vendedores';

    public function vendas()
    {
        return $this->hasMany(Venda::class, 'vendedor_id');
    }
}
