<?php
namespace App\Charts;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class TransactionsChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($totalIncome, $totalExpenses)
    {
        return $this->chart->barChart()
            ->setTitle('Total Income vs Total Expenses')
            ->setSubtitle('Overview of financial status')
            ->addData('Income', [$totalIncome, 0])
            ->addData('Expenses', [0, $totalExpenses])
            ->setXAxis(['Income', 'Expenses'])
            ->setColors(['#28a745', '#dc3545'])
            ->setWidth(880)
            ->setHeight(400)
            ->setGrid()
            ->setDataLabels(true)
            ->setToolbar(true) 
            ->setStacked(true);  

    }
}