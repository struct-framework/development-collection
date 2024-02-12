<?php

declare(strict_types=1);

namespace Struct\Development\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use function array_key_exists;
use function file_get_contents;
use function simplexml_load_string;

class LoadCurrencyCommand extends Command
{
    // the command description shown when running "php bin/console list"
    protected static $defaultName = 'load-currency';

    // the command description shown when running "php bin/console list"
    protected static $defaultDescription = 'Load currency list from official database and return as enum';

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $xmlString = file_get_contents('https://www.six-group.com/dam/download/financial-information/data-center/iso-currrency/lists/list-one.xml');
        $xml = simplexml_load_string($xmlString);
        $children = $xml->children();

        $CcyTbl = $children[0];

        $currencies = [];

        foreach ($CcyTbl->children() as $CcyNtry) {
            $CcyNm = null;
            $Ccy = null;
            foreach ($CcyNtry->children() as $CcyNtryChild) {
                if($CcyNtryChild->getName() === 'CcyNm') {
                    $CcyNm = (string) $CcyNtryChild;
                }
                if($CcyNtryChild->getName() === 'Ccy') {
                    $Ccy = (string) $CcyNtryChild;
                }
            }

            if($CcyNm === null || $Ccy === null) {
                continue;
            }

            if(array_key_exists($Ccy, $currencies) === false) {
                $currencies[$Ccy] = $CcyNm;
            }
        }

        foreach ($currencies as $key => $value) {
            $line = 'case ' . $key . ' = ' . "'" . $value . "';";
            $output->writeln($line);
        }

        return 0;
    }
}
