<div>
    <div class="container-xl">


        <div class="row">
            <div class="col">
                <h3>
                    <a href="{{ route('customers.index') }}">Manage Customers</a>
                    &nbsp;/&nbsp;
                    <a href="{{ route('customers.show', $customer->id) }}">{{ $customer->name }}</a>
                    &nbsp;/&nbsp;
                    Orders
                </h3>
            </div>
        </div>

        <div class="row row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $customer->name }}'s Order List</h3>
                    </div>
                    <div class="card-body border-bottom py-3">
                        <div class="d-flex">

                            <div>
                                <label for="search" class="form-label">Search</label>
                                <input type="search" id="search" class="form-control form-control-rounded" wire:model.live="search" placeholder="Filter table...">
                            </div>

                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Serial No.</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Paid</th>
                                <th>Amount Due</th>
                                <th>Status</th>
                                <th>Note</th>
                                <th>Created At</th>
                                <th></th>

                            </tr>
                            </thead>
                            <tbody class="table-tbody">
                            @forelse($orders as $order)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $order->number }}
                                    </td>
                                    <td class="text-center">{{ number_format($order->orderItems->count()) }}</td>
                                    <td class="text-center">${{ number_format($order->total, 2) }}</td>
                                    <td class="text-center">${{ number_format($order->paid, 2) }}</td>
                                    <td class="text-center">${{ number_format($order->amount_due, 2) }}</td>
                                    <td>
                                        <div class="badge {{ $order->getBadgeColorByStatus()  }}">{{ ucfirst($order->status) }}</div>
                                    </td>
                                    <td>{{ $order->note }}</td>
                                    <td>{{ $order->created_at->format('Y-m-d / h:i A') }}</td>
                                    <td>
                                        <div class="btn-list flex-nowrap">

                                            <a class="btn btn-icon" href="{{ route('orders.invoice', $order->id) }}"
                                               target="_blank"
                                               onclick="window.open(this.href, '_blank', 'width=500,height=500'); return false;">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
                                                    <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                                                    <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path>
                                                </svg>
                                            </a>
                                            <a class="btn" href="{{ route('orders.manage.index', $order->id) }}">
                                                Manage
                                            </a>
                                            <div class="dropdown">
                                                <button class="btn dropdown-toggle align-text-top"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" style="">
                                                    <a class="dropdown-item"
                                                       href="{{ route('orders.show', $order->id) }}">
                                                        Details
                                                    </a>
                                                    <a class="dropdown-item"
                                                       href="{{ route('orders.edit', $order->id) }}">
                                                        Edit
                                                    </a>
                                                    <a class="dropdown-item"
                                                       wire:click="triggerDeleteItem({{ $order->id }})">
                                                        Delete
                                                    </a>
                                                </div>
                                            </div>
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

                    <div class="card-footer d-flex align-items-center mt-3">
                        <div>
                            {{ $orders->links() }}
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>
