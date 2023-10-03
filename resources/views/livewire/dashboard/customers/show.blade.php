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
                                    <a class="btn btn-icon" href="{{ route('customers.print-details', $customer->id) }}"
                                       target="_blank"
                                       onclick="window.open(this.href, '_blank', 'width=500,height=500'); return false;">
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
                                <div class="datagrid-title">
                                    Revenue
                                </div>
                                <div class="datagrid-content" wire:init="getProfit()">

                                     <span wire:loading wire:target="getProfit">
                                       <div class="spinner-border spinner-border-sm text-primary" role="status">
                                          <span class="visually-hidden">Loading...</span>
                                       </div>
                                    </span>

                                    <span wire:loading.remove wire:target="getProfit">

                                         @if($showProfit)
                                            <span>${{ number_format($customerProfit, 2) }}</span>
                                        @else
                                            <a href="#" wire:click.prevent="showCustomerProfit()">
                                                Show
                                            </a>
                                        @endif

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
                                <hr>
                                <div>
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

        @if($quickPayLogs->count())
            <div class="row row-cards mt-1">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                <tr>
                                    <th>Series</th>
                                    <th>Date</th>
                                    <th>Amount Due</th>
                                    <th>Total Paid</th>
                                    <th class="w-1"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($quickPayLogs as $log)

                                    <tr>
                                        <td>{{ $log->number }}</td>
                                        <td>{{ $log->created_at->format('Y-m-d h:i A') }}</td>
                                        <td class="text-secondary">
                                            ${{ $log->amount_due_before_payment }}
                                        </td>
                                        <td class="text-secondary">
                                            ${{ $log->amount_paid }}
                                        </td>
                                        <td>
                                            <a class="btn btn-icon"
                                               href="{{ route('orders.quick-pay-logs.invoice', $log->id) }}"
                                               target="_blank"
                                               onclick="window.open(this.href, '_blank', 'width=500,height=500'); return false;">
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
                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            There are no items at the moment.
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>

                            <div class="mt-3">
                                {{ $quickPayLogs->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
