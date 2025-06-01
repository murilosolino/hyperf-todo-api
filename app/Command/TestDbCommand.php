<?php

namespace App\Command;

use Hyperf\Command\Command as HyperfCommand;
use Hyperf\DbConnection\Db;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestDbCommand extends HyperfCommand
{
    public function __construct()
    {
        parent::__construct('test:db');
    }

    public function configure()
    {
        $this->setDescription('Testa conexão com o banco de dados');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $result = Db::select('SELECT 1');
            $output->writeln('✅ Conexão com o banco de dados funcionando!');
            return 0;
        } catch (\Throwable $e) {
            $output->writeln('❌ Erro na conexão: ' . $e->getMessage());
            return 1;
        }
    }
}
