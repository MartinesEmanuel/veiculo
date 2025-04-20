<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('revisoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('veiculo_id')->constrained()->onDelete('cascade');
            $table->date('data_revisao');
            $table->decimal('km_atual', 10, 2);
            $table->text('descricao');
            $table->decimal('valor', 10, 2);
            $table->string('oficina');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('revisoes');
    }
};