<?php

namespace App\Http\Livewire\DashboardComponents;

use Livewire\Component;
use App\Models\Expenses;
use App\Models\POSession;
use App\Models\PosInvoice;
use App\Models\PurchaseInvoice;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;


class DailyInformation extends Component
{
    public $dailySales , $dailyExpenses , $dailyPurchase ;

    public function render()
    {
        $daily_sales = PosInvoice::whereDate('date', '=', date('Y-m-d'))->sum('total');
        $daily_expenses = Expenses::whereDate('date', '=', date('Y-m-d'))->sum('amount'); 
        $daily_purchases = PurchaseInvoice::whereDate('date', '=', date('Y-m-d'))->sum('total'); 
        $this->dailySales = $daily_sales ; 
        $this->dailyExpenses = $daily_expenses ;
        $this->dailyPurchase = $daily_purchases ;
        return view('livewire.dashboard-components.daily-information');
    }
}
