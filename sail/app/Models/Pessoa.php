<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 'email', 'cpf', 'telefone', 'data_nascimento', 'sexo', 'endereco'
    ];

    protected $casts = [
        'data_nascimento' => 'date',
    ];

    public function veiculos()
    {
        return $this->hasMany(Veiculo::class);
    }
}