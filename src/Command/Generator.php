<?php

namespace App\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Service\Generator as GeneratorService;

class Generator extends Command
{
    protected static $defaultName = 'app:generate';

    private $generator;

    public function __construct(GeneratorService $generator)
    {
        $this->generator = $generator;
        parent::__construct();
    }

    public function configure()
    {
        $this->setDescription('Generates output using serializer')
            ->setHelp('valid options are {fromJson|json|xml}')
            ->addArgument('format', InputArgument::REQUIRED, 'output format');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $format = $input->getArgument('format');
        $text = $this->generate($format, $output);
    }

    public function generate(string $format, OutputInterface $output)
    {
        $text = 'error';
        switch($format) {
            case 'fromJson':
                $text = $this->generator->fromJson();
                $output->writeln(print_r($text, true));
                break;
            case 'json':
                $text = $this->generator->json();
                $output->writeln($text);
                break;
            case 'xml':
                $text = $this->generator->xml();
                $output->writeln($text);
                break;
            default:
                throw new \Exception('Invalid format provided');
        }
    }
}
