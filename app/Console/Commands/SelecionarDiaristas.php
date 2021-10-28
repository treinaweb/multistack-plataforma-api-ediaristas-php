<?php

namespace App\Console\Commands;

use App\Actions\Diaria\EscolheDiarista\SelecionaAutomaticamente;
use Illuminate\Console\Command;

class SelecionarDiaristas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'diarias:selecionar:diaristas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica as diárias com mais de 24 horas e seleciona o diarista mais apropriado';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        private SelecionaAutomaticamente $selecionaAutomaticamente
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->selecionaAutomaticamente->executar();

        return 0;
    }
}
