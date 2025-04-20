<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'pessoa_id', 'placa', 'marca', 'modelo', 'ano_fabricacao', 'ano_modelo', 'cor'
    ];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }

    public function revisoes()
    {
        return $this->hasMany(Revisao::class);
    }
}