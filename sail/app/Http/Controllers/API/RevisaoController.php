<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Revisao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RevisaoController extends Controller
{
    public function index()
    {
        $revisoes = Revisao::with('veiculo.pessoa')->get();
        return response()->json($revisoes);
    }

    public function revisoesPorVeiculo($veiculoId)
    {
        $revisoes = Revisao::where('veiculo_id', $veiculoId)
            ->orderBy('data_revisao', 'desc')
            ->get();
        return response()->json($revisoes);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'veiculo_id' => 'required|exists:veiculos,id',
            'data_revisao' => 'required|date',
            'km_atual' => 'required|numeric|min:0',
            'descricao' => 'required|string',
            'valor' => 'required|numeric|min:0',
            'oficina' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $revisao = Revisao::create($request->all());
        return response()->json($revisao, 201);
    }

    public function show($id)
    {
        $revisao = Revisao::with('veiculo.pessoa')->findOrFail($id);
        return response()->json($revisao);
    }

    public function update(Request $request, $id)
    {
        $revisao = Revisao::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'veiculo_id' => 'required|exists:veiculos,id',
            'data_revisao' => 'required|date',
            'km_atual' => 'required|numeric|min:0',
            'descricao' => 'required|string',
            'valor' => 'required|numeric|min:0',
            'oficina' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $revisao->update($request->all());
        return response()->json($revisao);
    }

    public function destroy($id)
    {
        $revisao = Revisao::findOrFail($id);
        $revisao->delete();
        return response()->json(null, 204);
    }
}