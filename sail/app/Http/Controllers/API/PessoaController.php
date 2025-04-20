<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PessoaController extends Controller
{
    public function index()
    {
        $pessoas = Pessoa::all();
        return response()->json($pessoas);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:pessoas',
            'cpf' => 'required|string|max:14|unique:pessoas',
            'telefone' => 'required|string|max:15',
            'data_nascimento' => 'required|date',
            'sexo' => 'required|in:M,F',
            'endereco' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $pessoa = Pessoa::create($request->all());
        return response()->json($pessoa, 201);
    }

    public function show($id)
    {
        $pessoa = Pessoa::findOrFail($id);
        return response()->json($pessoa);
    }

    public function update(Request $request, $id)
    {
        $pessoa = Pessoa::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:pessoas,email,' . $id,
            'cpf' => 'required|string|max:14|unique:pessoas,cpf,' . $id,
            'telefone' => 'required|string|max:15',
            'data_nascimento' => 'required|date',
            'sexo' => 'required|in:M,F',
            'endereco' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $pessoa->update($request->all());
        return response()->json($pessoa);
    }

    public function destroy($id)
    {
        $pessoa = Pessoa::findOrFail($id);
        $pessoa->delete();
        return response()->json(null, 204);
    }
}