<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendas extends Model
{
    use HasFactory;

    protected $fillable = ['vendedor_id', 'valor', 'data', 'comissao'];

    protected $table = 'Vendas';

    public function vendedor()
    {
        return $this->belongsTo(Vendedores::class, 'vendedor_id');
    }

    public static function rules()
    {
        return [
            'vendedor_id' => 'required',
            'valor' => 'required|numeric',
            'data' => 'required|date',
        ];
    }
}
