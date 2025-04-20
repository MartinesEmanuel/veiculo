<?php

use App\Http\Controllers\API\PessoaController;
use App\Http\Controllers\API\VeiculoController;
use App\Http\Controllers\API\RevisaoController;
use App\Http\Controllers\API\RelatorioController;
use Illuminate\Support\Facades\Route;

// Rotas de Pessoa
Route::apiResource('pessoas', PessoaController::class);

// Rotas de Veículo
Route::apiResource('veiculos', VeiculoController::class);
Route::get('pessoa/{id}/veiculos', [VeiculoController::class, 'veiculosPorPessoa']);

// Rotas de Revisão
Route::apiResource('revisoes', RevisaoController::class);
Route::get('veiculo/{id}/revisoes', [RevisaoController::class, 'revisoesPorVeiculo']);

// Rotas de Relatórios
Route::get('relatorios/veiculos', [RelatorioController::class, 'todosVeiculos']);
Route::get('relatorios/veiculos-por-pessoa', [RelatorioController::class, 'veiculosPorPessoa']);
Route::get('relatorios/veiculos-por-sexo', [RelatorioController::class, 'veiculosPorSexo']);
// Adicione as outras rotas de relatório conforme você implementar