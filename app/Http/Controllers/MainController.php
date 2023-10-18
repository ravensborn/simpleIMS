<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderPayment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;

class MainController extends Controller
{

    private function importCustomers()
    {

        $legacy = \App\Models\LegacyModels\Customer::all();

        echo 'Importing Customers..' . '<br>';
        $importCount = 0;
        Customer::unguard();
        foreach ($legacy as $c) {
            $importCount++;
            Customer::create([
                'id' => $c->id,
                'name' => $c->name,
                'phone_number' => (strlen($c->phone) == 10) ? $c->phone : '07500000000',
                'email_address' => null,
                'address' => (strlen($c->address) > 3) ? $c->address : null,
                'note' => null,
            ]);
        }
        Customer::reguard();
        echo 'done importing ' . $importCount . ' customers...' . '<br>';
    }

    private function importProducts()
    {

        $legacy = \App\Models\LegacyModels\Product::all();

        echo 'Importing Products..' . '<br>';
        $importCount = 0;
        Product::unguard();
        foreach ($legacy as $i) {
            $importCount++;

            $product = Product::create([
                'id' => $i->id,
                'number' => Product::generateNumber(),
                'code' => $i->code,
                'name' => $i->name,
                'note' => null,
                'created_at' => $i->created_at
            ]);

           if($i->quantity) {
               $inventory = Inventory::create([
                   'number' => Inventory::generateNumber(),
                   'product_id' => $product->id,
                   'cost' => $i->original_cost,
                   'price' => $i->cost,
                   'quantity' => $i->quantity,
               ]);

               $product->syncInventories();
               $product->update([
                   'default_inventory_id' => $inventory->id,
               ]);
           }

        }
        Product::reguard();
        echo 'done importing ' . $importCount . ' customers...' . '<br>';
    }
    private function importOrders()
    {
        echo 'Importing Orders..' . '<br>';
        $product = Product::create([
            'number' => Product::generateNumber(),
            'name' => 'Legacy System',
            'available_inventory' => 0,
            'times_sold' => 0,
            'default_inventory_id' => null,
        ]);

        $inventory = Inventory::create([
            'number' => Inventory::generateNumber(),
            'product_id' => $product->id,
            'cost' => 0,
            'price' => 0,
            'quantity' => 1,
        ]);

        $importCount = 0;

       foreach (\App\Models\LegacyModels\Customer::all() as $legacyCustomer) {

           $invoices = \App\Models\LegacyModels\Invoice::where('customer_id', $legacyCustomer->id)->orderBy('created_at', 'desc')->get();

           if($invoices->count() <= 0) {
               continue;
           }

           $total = 0;
           $paid = 0;

           foreach ($invoices as $i) {

               $legacyOrders = \App\Models\LegacyModels\Order::where('invoice_id', $i->id)->get();

               $importCount++;

               $invoiceTotal = $legacyOrders->sum(function ($collection) {
                   return $collection->cost * $collection->quantity;
               });

               $total += ($invoiceTotal - $i->discount);

               $paid += $i->payment;
           }

           $legacyPayments = \App\Models\LegacyModels\Payment::where('customer_id', $legacyCustomer->id);

           $paid += $legacyPayments->sum('amount');

           if(($total - $paid) < 0) {
               continue;
           }

           $orderArray = [
               'number' => Order::generateNumber(),
               'user_id' => auth()->user()->id,
               'customer_id' => $legacyCustomer->id,
               'total' => $total,
               'paid' => $paid,
               'created_at' => $invoices->first()->created_at,
           ];

           $order = Order::create($orderArray);

           if($paid > 0) {
               OrderPayment::create([
                   'number' => OrderPayment::generateNumber(),
                   'order_id' => $order->id,
                   'amount' => $paid,
                   'created_at'=> $invoices->first()->created_at,
               ]);
           }

           OrderItem::create([
               'order_id' => $order->id,
               'product_id' => $product->id,
               'inventory_id' => $inventory->id,
               'product' => $product,
               'inventory' => $inventory,
               'quantity' => 1,
               'price' => $total,
               'created_at'=> $invoices->first()->created_at,
           ]);

           $order->syncTotal();
           $order->syncPayments();
    }

        echo 'done importing ' . $importCount . ' orders...' . '<br>';
    }

    public function createUser() {
        \App\Models\User::factory()->create([
            'name' => 'Yad',
            'email' => 'yad@example.com',
        ]);
    }

    public function migrate()
    {

        \Artisan::call('migrate:fresh');
        echo 'Cleared database...' . '<br>';

        $this->importCustomers();
        $this->importProducts();
        $this->createUser();
        $this->importOrders();



    }
}
