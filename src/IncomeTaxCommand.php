<?php

namespace App;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class IncomeTaxCommand extends Command
{
    const TAX_BRACKETS = [
        50000000 => 0.05,
        250000000 => 0.15,
        500000000 => 0.25,
        PHP_INT_MAX => 0.30,
    ];

    protected function configure()
    {
        $this->setName('app:incomeTax')
            ->setDescription('Calculate income Tax.')
            ->addArgument('income');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Income tax : ' . $this->calculateTax($input->getArgument('income')));
    }

    public function calculateTax($income)
    {
        $taxTotal = 0;
        $bracketMin = 0;
        foreach (self::TAX_BRACKETS as $bracketMax => $taxRate) {
            if ($income > $bracketMax) {
                //Current bracket is exceeded
                $taxTotal += ($bracketMax - $bracketMin) * $taxRate;

                $bracketMin = $bracketMax;
            } else {
                //Current bracket is the highest for this income
                $taxTotal += ($income - $bracketMin) * $taxRate;
                break;
            }
        }
        return $taxTotal;
    }
}
