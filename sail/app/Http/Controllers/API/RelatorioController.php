<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pessoa;
use App\Models\Revisao;
use App\Models\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    // Veículos
    public function todosVeiculos()
    {
        $veiculos = Veiculo::with('pessoa')->get();
        return response()->json($veiculos);
    }

    public function veiculosPorPessoa()
    {
        $veiculos = DB::table('veiculos')
            ->join('pessoas', 'veiculos.pessoa_id', '=', 'pessoas.id')
            ->select('pessoas.nome', 'pessoas.id', DB::raw('count(veiculos.id) as total_veiculos'))
            ->groupBy('pessoas.id', 'pessoas.nome')
            ->orderBy('pessoas.nome')
            ->get();
        
        return response()->json($veiculos);
    }

    public function veiculosPorSexo()
    {
        $veiculos = DB::table('veiculos')
            ->join('pessoas', 'veiculos.pessoa_id', '=', 'pessoas.id')
            ->select('pessoas.sexo', DB::raw('count(veiculos.id) as total_veiculos'))
            ->groupBy('pessoas.sexo')
            ->get();
        
        return response()->json($veiculos);
    }

    // Adicione os outros métodos de relatório conforme necessário
}