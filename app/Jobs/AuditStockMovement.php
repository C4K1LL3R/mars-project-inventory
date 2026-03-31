<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class AuditStockMovement implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $details;

    /**
     * O CONSTRUTOR É OBRIGATÓRIO PARA RECEBER OS DADOS
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    public function handle(): void
    {
        // Verifica se os detalhes existem para evitar erro de "Undefined index"
        if (!$this->details) {
            Log::error('AUDITORIA: Job disparado sem detalhes.');
            return;
        }

        Log::info('AUDITORIA DE STOCK:', $this->details);

        $stock = $this->details['current_stock'] ?? 0;
        $name = $this->details['product_name'] ?? 'Produto Desconhecido';

        if ($stock <= 0) {
            Log::emergency("RUPTURA TOTAL: {$name} esgotou em Marte!");
        } elseif ($stock < 5) {
            Log::warning("ALERTA: O produto {$name} está com stock crítico!");
        }
    }
}