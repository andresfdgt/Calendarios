<?php

namespace App\Console\Commands;

use App\Models\Cron;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminated\Console\WithoutOverlapping;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class albaranEntrada extends Command
{

    use WithoutOverlapping;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'albaran:entradas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Albaran entradas';

    private $channel;
    private $run_command = true;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->channel = Log::build([
          'driver' => 'single',
          'path' => storage_path('logs/albaran_entrada.log'),
        ]);
          
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
      try {

          $this->initializeMutex();
          parent::initialize($input, $output);

        } catch (\Throwable $th) {
          Log::stack([$this->channel])->info('Cron already running');
          $this->run_command = false;
        }
        
        
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
      if (!$this->run_command) {
        return 1;
      }

      Log::stack([$this->channel])->info('Cron started');

      try {                
        Cron::entradas();
      } catch (\Throwable $th) {
          Log::stack([$this->channel])->error($th->getMessage()." -> line -> ".$th->getLine());
      }
      
    }
}
