<div>
    <div class="container-xl">


        <div class="row">
            <div class="col">
                <h3>
                    <a href="{{ route('customers.index') }}">Manage Customers</a>
                    &nbsp;/&nbsp;
                    {{ $customer->name }}
                </h3>
            </div>
        </div>

        <div class="row row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $customer->name }}'s details</h3>
                    </div>
                    <div class="card-body">
                        <div class="datagrid">
                            <div class="datagrid-item">
                                <div class="datagrid-title">Name</div>
                                <div class="datagrid-content">{{ $customer->name }}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Phone Number</div>
                                <div class="datagrid-content">{{ $customer->phone_number }}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">E-Mail Address</div>
                                <div class="datagrid-content">{{ $customer->email_address }}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Address</div>
                                <div class="datagrid-content">{{ $customer->address }}</div>
                            </div>


                            <div class="datagrid-item">
                                <div class="datagrid-title">Profile</div>
                                <div class="datagrid-content">
                                    <a href="{{ route('customers.print-details', $customer->id) }}">Print</a>
                                </div>
                            </div>

                            <div class="datagrid-item">
                                <div class="datagrid-title">Orders</div>
                                <div class="datagrid-content">
                                    <a href="{{ route('customers.orders', $customer->id) }}">{{ number_format($customer->orders->count()) }}</a>
                                </div>
                            </div>

                            <div class="datagrid-item">
                                <div class="datagrid-title">Amount Due</div>
                                <div class="datagrid-content">
                                    ${{ number_format($customer->amount_due, 2) }}
                                    @if($customer->amount_due > 0)
                                        /
                                        <a href="" wire:click.prevent="showCustomerPayCard()">Quick Pay</a>
                                    @endif
                                </div>
                            </div>

                            <div class="datagrid-item">
                                <div class="datagrid-title">Profit</div>
                                <div class="datagrid-content" wire:init="getProfit()">
                                    <span wire:loading wire:target="getProfit">
                                       <div class="spinner-border spinner-border-sm text-primary" role="status">
                                          <span class="visually-hidden">Loading...</span>
                                       </div>
                                    </span>
                                    <span wire:loading.remove wire:target="getProfit">
                                         ${{ number_format($customerProfit, 2) }}
                                    </span>

                                </div>
                            </div>

                            @if($customer->note)
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Note</div>
                                    <div class="datagrid-content">
                                        {{ $customer->note }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($customerQuickPayCard)
            <div class="row row-cards mt-1">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">QuickPay</h3>
                        </div>
                        <div class="card-body">

                            <p>
                                Paying through quick pay will distribute the amount on the pending orders, no separate
                                invoice is generated instead you may navigate to each orders page to print it's invoice.
                            </p>
                            <form action="">
                                <div>
                                    <label for="pay_amount" class="form-label">Pay Amount</label>
                                    <input type="text" id="pay_amount" class="form-control" wire:model="payAmount">
                                    @error('payAmount')
                                    <div class="text-red">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    @if($fulfilledOrders)
                                        <hr>
                                        <div class="mb-1">
                                            Affected orders
                                        </div>
                                        @foreach($fulfilledOrders as $item)

                                            <a target="_blank"
                                               href="{{ route('orders.order-payments.invoice', ['order' => $item['order_id'], 'orderPayment' => $item['payment']->id]) }}">
                                                <span class="badge badge-primary mb-1"><i class="bi bi-printer"></i> Invoice - {{ $item['payment']->number }} - ${{ number_format($item['amount'], 2) }}</span>
                                            </a>

                                        @endforeach
                                    @endif
                                    <hr>
                                    <button class="btn btn-primary" wire:click.prevent="payCustomerDueAmount">
                                        Pay
                                        <span wire:loading wire:target="payCustomerDueAmount">
                                        - Saving...
                                    </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
