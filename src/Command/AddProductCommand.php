<?php

namespace App\Command;

use App\Entity\Products;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'product:import',
    description: 'Add product records',
)]
class AddProductCommand extends Command
{
    public function _construct(){
       parent::_construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('name', InputArgument::OPTIONAL, 'Products',50)
            ->addArgument('price', InputArgument::OPTIONAL, 'Products')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $name = $input->getArgument('name');

        if ($name) {
            $io->note(sprintf('You passed an argument: %s', $name));
        }

        $filedata = file_get_contents('./public/product.json');
        $details = json_decode($filedata);
        $curl = curl_init();
           foreach ($details as $key => $value) {
            // dd($value->name);
              curl_setopt_array($curl, array(
              CURLOPT_URL => 'http://localhost:8000/api/products',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS =>'{
              "category": ["'.$value->categoryName.'"],
              "name": "'.$value->name.'",
              "price": '.$value->price.'
            }',
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;

            }

        if ($input->getOption('option1')) {
            // ...
        }

        $io->success('All Products is saved in product table');

        return Command::SUCCESS;
    }
}
