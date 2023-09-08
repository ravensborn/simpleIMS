<div>
    <div class="container-xl">


        <div class="row">
            <div class="col">
                <h3>
                    <a href="{{ route('customers.index') }}">Manage Orders</a>
                    &nbsp;/&nbsp;
                    {{ $order->number }}
                </h3>
            </div>
        </div>

        <div class="row row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Order {{ $order->number }} info</h3>
                    </div>
                    <div class="card-body">
                        <div class="datagrid">
                            <div class="datagrid-item">
                                <div class="datagrid-title">Created By</div>
                                <div class="datagrid-content">{{ $order->user->name }}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Created At</div>
                                <div class="datagrid-content">{{ $order->created_at->format('Y-m-d / h:i A') }}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Customer Name</div>
                                <div class="datagrid-content">
                                    <a href="{{ route('customers.show', $order->customer_id) }}">{{ $order->customer->name }}</a>
                                </div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Customer Phone Number</div>
                                <div class="datagrid-content">{{ $order->customer->phone_number }}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Order Items</div>
                                <div class="datagrid-content">{{ number_format($order->orderItems->count()) }}</div>
                            </div>

                            <div class="datagrid-item">
                                <div class="datagrid-title">Order Total</div>
                                <div class="datagrid-content">${{ number_format($order->total, 2) }}</div>
                            </div>

                            <div class="datagrid-item">
                                <div class="datagrid-title">Amount Paid</div>
                                <div class="datagrid-content">${{ number_format($order->paid, 2) }}</div>
                            </div>


                            <div class="datagrid-item">
                                <div class="datagrid-title">Amount Due</div>
                                <div class="datagrid-content">${{ number_format($order->amount_due, 2) }}</div>
                            </div>

                            <div class="datagrid-item">
                                <div class="datagrid-title">Note</div>
                                <div class="datagrid-content">
                                    {{ $order->note }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
