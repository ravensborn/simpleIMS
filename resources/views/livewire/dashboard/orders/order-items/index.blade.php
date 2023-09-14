<div>
    <div class="container-xl">

        <div class="row">
            <div class="col">
                <h3>
                    <a href="{{ route('orders.index') }}">Manage Orders</a>
                    &nbsp;/&nbsp;
                    {{ $order->number }}
                    &nbsp;/&nbsp;
                    Items
                </h3>
            </div>
        </div>

        <div class="row row-cards">

            <div class="col-12 col-md-7">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Item List</h3>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Product</th>
                                <th>Inventory</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody class="table-tbody">
                            @forelse($orderItems as $item)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        <span style=" display: inline-block; max-width: 10rem;">
                                            {{ $item->product->name }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ $item->inventory->number }}
                                    </td>

                                    <td>${{ number_format($item->price, 2) }}</td>
                                    <td>{{ number_format($item->quantity) }}</td>
                                    <td>${{ number_format($item->price * $item->quantity, 2) }}</td>

                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <a class="btn" href="#"
                                               wire:click="triggerDeleteOrderItem({{ $item->id }})">
                                                Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">No items at the moment.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card mt-2">
                    <div class="card-header">
                        <h3 class="card-title">Payment List</h3>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Serial No.</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody class="table-tbody">
                            @forelse($orderPayments as $item)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $item->number }}
                                    </td>
                                    <td>
                                        ${{ number_format($item->amount, 2) }}
                                    </td>
                                    <td>
                                        {{ $item->created_at->format('Y-m-d / h:i A') }}
                                    </td>
                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <a class="btn btn-icon"
                                               href="{{ route('orders.order-payments.invoice', ['order' => $order_id, 'orderPayment' => $item->id]) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="icon icon-tabler icon-tabler-printer" width="24" height="24"
                                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                     fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path
                                                        d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
                                                    <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                                                    <path
                                                        d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path>
                                                </svg>
                                            </a>
                                            <a class="btn" href="#"
                                               wire:click="triggerDeleteOrderPayment({{ $item->id }})">
                                                Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">No items at the moment.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-5">

                <div class="accordion">

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#item-order-accordion">
                                New Order Item
                            </button>
                        </h2>
                        <div id="item-order-accordion" class="accordion-collapse collapse" wire:ignore.self>
                            <div class="accordion-body pt-0">
                                <div class="card-body">
                                    <form wire:submit="storeOrderItem">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="">
                                                    <label for="product_id" class="form-label">
                                                        Product
                                                        <small class="text-danger">*</small>
                                                        @if((bool) $productSearchQuery & $suggestedProductsSelectBox)
                                                            <span class="badge bg-green-lt">Searching...</span>
                                                        @endif
                                                    </label>
                                                    @if(!$orderItemForm->product_id)
                                                        <input type="text" id="product_id" class="form-control"
                                                               wire:model.live="productSearchQuery">
                                                    @else
                                                        <div class="input-group">
                                                <span class="input-group-text">
                                                     <img style="width: 32px; height: 32px;"
                                                          class="img-fluid object-cover"
                                                          src="{{ $this->orderItemForm->product->getCover('preview') }}"
                                                          alt="">
                                                </span>
                                                            <input type="text" id="product_id" class="form-control"
                                                                   wire:model="selectedProductString" disabled>
                                                            <button class="btn" style="width: 70px;"
                                                                    wire:click.prevent="resetNewOrderItemForm()">
                                                                Reset
                                                            </button>
                                                        </div>
                                                    @endif
                                                    @error('orderItemForm.product_id')
                                                    <div class="text-danger">{{ $message }}</div> @enderror

                                                    <div @class(['dropdown-menu dropdown-menu-demo' => true, 'show' => ((bool) $productSearchQuery & $suggestedProductsSelectBox)])>
                                                        @if($suggestedProductsSelectBox)
                                                            @forelse($suggestedProducts as $product)
                                                                <a href="#" class="dropdown-item"
                                                                   wire:click="selectProduct({{ $product['id'] }})">
                                                        <span class="avatar avatar-xs rounded me-2"
                                                              style="background-image: url('{{ $product['image'] }}')"></span>
                                                                    @if($product['code'])
                                                                        {{ $product['code'] . ' / ' . $product['name'] }}
                                                                    @else
                                                                        {{ $product['name'] }}
                                                                    @endif
                                                                </a>
                                                            @empty
                                                                <a href="" class="dropdown-item">
                                                                    No products found with the provided name.
                                                                </a>
                                                            @endforelse
                                                        @endif
                                                    </div>

                                                </div>
                                            </div>
                                            @if($orderItemForm->product_id)
                                                <div class="col-6">
                                                    <div class="mt-3">
                                                        <label for="inventory_id" class="form-label">Inventory <small
                                                                class="text-danger">*</small></label>
                                                        <select class="form-control"
                                                                wire:model.live="orderItemForm.inventory_id"
                                                                wire:change="inventoryUpdated"
                                                                id="inventory_id">
                                                            <option value="0"> -- Select an option --</option>
                                                            @foreach($inventories as $inventory)
                                                                <option value="{{ $inventory->id }}">
                                                                    {{ $inventory->number . ' / ' . $inventory->quantity . ' / $' . $inventory->cost }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('orderItemForm.inventory_id')
                                                        <div class="text-danger">{{ $message }}</div> @enderror
                                                    </div>
                                                </div>
                                            @endif

                                            @if($orderItemForm->inventory_id)

                                                <div class="col-4">
                                                    <div class="mt-3">
                                                        <label for="price" class="form-label">
                                                            Price ($)
                                                            <small class="text-danger">*</small>
                                                        </label>
                                                        <input type="text" id="price" class="form-control"
                                                               wire:model="orderItemForm.price">
                                                        @error('orderItemForm.price')
                                                        <div class="text-danger">{{ $message }}</div> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-2">
                                                    <div class="mt-3">
                                                        <label for="quantity" class="form-label">
                                                            QTY.
                                                            <small class="text-danger">*</small>
                                                        </label>
                                                        <input type="text" id="quantity" class="form-control"
                                                               wire:model="orderItemForm.quantity">
                                                        @error('orderItemForm.quantity')
                                                        <div class="text-danger">{{ $message }}</div> @enderror
                                                    </div>
                                                </div>

                                            @endif

                                            <div class="mt-3 border-top pt-3">
                                                <button
                                                    @class([ 'btn btn-primary' => true, 'disabled' => !$orderItemForm->inventory_id]) wire:target="storeOrderItem"
                                                    wire:loading.attr="disabled">
                                                    <i class="bi bi-plus me-2"></i>
                                                    Add
                                                    <div wire:loading wire:target="storeOrderItem">
                                                        &nbsp; - Saving...
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#payment-item-accordion">
                                New Payment
                            </button>
                        </h2>
                        <div id="payment-item-accordion" class="accordion-collapse collapse" wire:ignore.self>
                            <div class="accordion-body pt-0">
                                <div class="card-body">
                                    <form wire:submit="storePayment">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="">
                                                    <label for="amount" class="form-label">
                                                        Amount
                                                        <small class="text-danger">*</small>
                                                    </label>
                                                    <input type="text" id="amount" class="form-control"
                                                           wire:model="orderPaymentForm.amount">
                                                    @error('orderPaymentForm.amount')
                                                    <div class="text-danger">{{ $message }}</div> @enderror
                                                </div>
                                            </div>

                                            <div class="mt-3 border-top pt-3">
                                                <button @class([ 'btn btn-primary' => true]) wire:target="storePayment"
                                                        wire:loading.attr="disabled">
                                                    <i class="bi bi-plus me-2"></i>
                                                    Add
                                                    <div wire:loading wire:target="storePayment">
                                                        &nbsp; - Saving...
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card mt-2">
                    <div class="card-header">
                        <h3 class="card-title">Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="datagrid" style=" !important; grid-template-columns: auto auto auto auto;">
                            <div class="datagrid-item">
                                <div class="datagrid-title">Customer</div>
                                <div class="datagrid-content"><a href="{{ route('customers.show', $order->customer_id) }}">{{ $order->customer->name }}</a></div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Total</div>
                                <div class="datagrid-content">${{ number_format($order->total, 2) }}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Paid</div>
                                <div class="datagrid-content">${{ number_format($order->paid, 2) }}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Amount Due</div>
                                <div class="datagrid-content">
                                    ${{ number_format($order->amount_due, 2) }}</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>

    </div>
</div>
