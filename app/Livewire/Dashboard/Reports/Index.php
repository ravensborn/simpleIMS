<?php

namespace App\Livewire\Dashboard\Reports;


use App\Models\Order;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, LivewireAlert;


    public function render()
    {

        return view('livewire.dashboard.reports.index')->extends('layouts.base')->section('content');
    }

}
