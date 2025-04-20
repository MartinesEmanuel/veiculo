<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VeiculoController extends Controller
{
    public function index()
    {
        $veiculos = Veiculo::with('pessoa')->get();
        return response()->json($veiculos);
    }

    public function veiculosPorPessoa($pessoaId)
    {
        $veiculos = Veiculo::where('pessoa_id', $pessoaId)->get();
        return response()->json($veiculos);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pessoa_id' => 'required|exists:pessoas,id',
            'placa' => 'required|string|max:8|unique:veiculos',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'ano_fabricacao' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'ano_modelo' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'cor' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $veiculo = Veiculo::create($request->all());
        return response()->json($veiculo, 201);
    }

    public function show($id)
    {
        $veiculo = Veiculo::with('pessoa')->findOrFail($id);
        return response()->json($veiculo);
    }

    public function update(Request $request, $id)
    {
        $veiculo = Veiculo::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'pessoa_id' => 'required|exists:pessoas,id',
            'placa' => 'required|string|max:8|unique:veiculos,placa,' . $id,
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'ano_fabricacao' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'ano_modelo' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'cor' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $veiculo->update($request->all());
        return response()->json($veiculo);
    }

    public function destroy($id)
    {
        $veiculo = Veiculo::findOrFail($id);
        $veiculo->delete();
        return response()->json(null, 204);
    }
}