<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revisao extends Model
{
    use HasFactory;
    
    protected $table = 'revisoes';

    protected $fillable = [
        'veiculo_id', 'data_revisao', 'km_atual', 'descricao', 'valor', 'oficina'
    ];

    protected $casts = [
        'data_revisao' => 'date',
        'km_atual' => 'float',
        'valor' => 'float',
    ];

    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }
}