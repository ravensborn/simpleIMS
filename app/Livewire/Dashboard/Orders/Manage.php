<?php

namespace App\Livewire\Dashboard\Orders;

use App\Livewire\Forms\OrderItemForm;
use App\Livewire\Forms\OrderPaymentForm;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Manage extends Component
{
    use WithPagination, LivewireAlert;

    protected $listeners = [
        'deleteOrderItem',
        'deleteOrderPayment',
    ];

    public $order;
    public $order_id;
    public Collection $orderItems;
    public Collection $orderPayments;
    public Collection $inventories;


    public OrderItemForm $orderItemForm;
    public OrderPaymentForm $orderPaymentForm;
    public array $suggestedProducts = [];
    public bool $suggestedProductsSelectBox = false;
    public string $productSearchQuery = '';
    public string $selectedProductString = '';
    public int $itemIdToBeDeleted = 0;

    public bool $createOrderItemAccordion = false;

    public function storePayment(): void
    {
        if(((int) $this->orderPaymentForm->amount + $this->order->paid) > $this->order->total) {
            $this->alert('error', 'Amount cannot be larger than order total.');
        } else {
            $this->orderPaymentForm->order_id = $this->order_id;
            $this->orderPaymentForm->store();
            $this->orderPaymentForm->amount = '';
            $this->loadOrderPayments();
            $this->alert('success', 'Successfully added new payment.');
        }
    }

    public function loadOrderPayments(): void
    {
        $this->orderPayments = $this->order->orderPayments;
        $this->order->syncPayments();
    }

    public function resetNewOrderItemForm(): void
    {
        $this->inventories = collect();
        $this->suggestedProducts = [];
        $this->suggestedProductsSelectBox = false;
        $this->productSearchQuery = '';
        $this->selectedProductString = '';
        $this->orderItemForm->resetInputs();
    }

    public function updatedProductSearchQuery(): void
    {

        $this->resetValidation();

        if ($this->productSearchQuery) {

            if($this->productSearchQuery == 'd.') {

                $suggestedProducts = Product::orderBy('name')->get();
            } else {

//            $this->suggestedProducts = Product::where('available_inventory', '>', 0)
                $suggestedProducts = Product::where(function ($q) {
                    $q->where('name', 'LIKE', '%' . $this->productSearchQuery . '%')
                        ->orWhere('code', 'LIKE', '%' . $this->productSearchQuery . '%')
                        ->orWhere('number', $this->productSearchQuery);
                })->limit(5)->get();
            }

            $this->suggestedProducts = $suggestedProducts->map(function ($product) {
                $product['image'] = $product->getCover('preview');
                return $product;
            })->toArray();

        } else {

            $this->suggestedProducts = [];
        }

        $this->suggestedProductsSelectBox = true;
    }

    public function selectProduct($productId): void
    {
        $product = Product::find($productId);
        $this->orderItemForm->product = $product;
        $this->orderItemForm->product_id = $product->id;
        $this->selectedProductString = $product->name;
        $this->suggestedProductsSelectBox = false;
        $this->loadProductInventories();
    }

    public function loadProductInventories(): void
    {
        $this->inventories = Inventory::where('product_id', $this->orderItemForm->product_id)
//            ->where('quantity', '!=', 0)
            ->get();

        if ($this->orderItemForm->product->default_inventory_id) {

            $defaultInventory = $this->inventories->find($this->orderItemForm->product->default_inventory_id);

            if ($defaultInventory) {
                $this->orderItemForm->inventory = $defaultInventory;
                $this->orderItemForm->inventory_id = $defaultInventory->id;
                $this->orderItemForm->price = $defaultInventory->price;
                $this->orderItemForm->quantity = 1;
            }
        }
    }

    public function inventoryUpdated(): void
    {
        $inventory = Inventory::find($this->orderItemForm->inventory_id);

        if ($inventory) {
            $this->orderItemForm->inventory = $inventory;
            $this->orderItemForm->price = $inventory->price;
            $this->orderItemForm->quantity = 1;
        }
    }

    private function ensureCostLessThanPriceRule($cost, $price): bool
    {
        return $cost < $price;
    }

    private function ensureInventoryQuantityAvailability($inventoryQuantity, $requestedQuantity): bool
    {
        return ($inventoryQuantity - $requestedQuantity) >= 0;
    }

    public function storeOrderItem(): bool
    {
        if(!$this->ensureCostLessThanPriceRule($this->orderItemForm->inventory->cost, $this->orderItemForm->price)) {
            $this->alert('error', 'Price must be more than the product cost price.');
            return false;
        }

        if(!$this->ensureInventoryQuantityAvailability($this->orderItemForm->inventory->quantity, $this->orderItemForm->quantity)) {
            $this->alert('error', 'Inventory not available for the requested amount.');
            return false;
        }

        $this->orderItemForm->order_id = $this->order->id;
        $this->orderItemForm->store();
        $this->resetNewOrderItemForm();

        $this->loadOrder();
        $this->alert('success', 'Item successfully added.');

        return true;
    }

    public function loadOrder(): void
    {
        $this->order = Order::find($this->order_id);
        $this->loadOrderItems();
        $this->loadOrderPayments();
    }
    public function loadOrderItems(): void
    {
        $this->orderItems = $this->order->orderItems;
        $this->order->syncTotal();
    }

    #[Computed]
    public function getTotal()
    {
        return $this->orderItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });
    }

    public function mount($order): void
    {
        $this->order_id = $order;
        $this->loadOrder();
    }

    public function triggerDeleteOrderPayment($item): void
    {
        $this->confirm('Are you sure that you want to delete this item?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => 'Cancel',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'deleteOrderPayment'
        ]);

        $this->itemIdToBeDeleted = $item;
    }

    public function triggerDeleteOrderItem($item): void
    {
        $this->confirm('Are you sure that you want to delete this item?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => 'Cancel',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'deleteOrderItem'
        ]);

        $this->itemIdToBeDeleted = $item;
    }

    public function deleteOrderPayment(): void
    {

        $orderPayment = $this->orderPayments->find($this->itemIdToBeDeleted);

        if($orderPayment) {

            $orderPayment->delete();

            $this->alert('success', 'Item successfully deleted.', [
                'position' => 'top-end',
                'timer' => 5000,
                'toast' => true,
            ]);
        }
        $this->loadOrder();
    }
    public function deleteOrderItem(): void
    {

        $this->resetNewOrderItemForm();

        $orderItem = $this->order->orderItems->find($this->itemIdToBeDeleted);

        if ($orderItem) {

            //If there were payments made, we don't allow item deleting,

            if(!$this->orderPayments->count()) {

                //Return the stocks only if the product and inventory still exists.

                if ($orderItem->inventory_id && $orderItem->product_id) {

                    $inventory = Inventory::find($orderItem->inventory_id);
                    $inventory->increment('quantity', $orderItem->quantity);

                    $product = Product::find($orderItem->product_id);
                    $product->syncInventories();
                    $product->decrement('times_sold');
                }

                $orderItem->delete();

                $this->alert('success', 'Item successfully deleted.', [
                    'position' => 'top-end',
                    'timer' => 5000,
                    'toast' => true,
                ]);

                $this->loadOrder();

            } else {

                $this->alert('error', 'Cannot delete an item while order has payments.', [
                    'position' => 'top-end',
                    'timer' => 5000,
                    'toast' => true,
                ]);

            }
        }
    }

    public function render()
    {

        return view('livewire.dashboard.orders.order-items.index')->extends('layouts.base')->section('content');
    }

}
