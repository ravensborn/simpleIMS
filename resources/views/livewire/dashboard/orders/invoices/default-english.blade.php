<div>
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h3>
                            <a href="{{ route('orders.index') }}">Manage Orders</a>
                            &nbsp;/&nbsp;
                            <a href="{{ route('orders.manage.index', $order->id) }}">
                                {{ $order->number }}
                            </a>
                            &nbsp;/&nbsp;
                            Invoice
                        </h3>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <button type="button" class="btn btn-primary" onclick="javascript:window.print();">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path
                                    d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"/>
                                <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"/>
                                <path
                                    d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"/>
                            </svg>
                            Print Invoice
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="card card-lg">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 text-start">
                                <div>
                                    <p class="h2">{{ config('env.INVOICE_COMPANY_NAME') }}</p>
                                    <address>
                                        <span class="fw-bold">E-Mail:</span> {{ config('env.INVOICE_COMPANY_EMAIL') }}
                                        <br>
                                        <span
                                            class="fw-bold">Phone No.:</span> {{ config('env.INVOICE_COMPANY_PHONE') }}
                                        <br>
                                        <span
                                            class="fw-bold">Address:</span> {{ config('env.INVOICE_COMPANY_ADDRESS') }}
                                    </address>
                                </div>
                            </div>
                            <div class="col-4 text-center">
                                <div>
                                    <p class="h2">{{ $customer->name }}</p>
                                    <address>
                                        <span class="fw-bold">E-Mail:</span> {{ $customer->email_address ?? '' }}
                                        <br>
                                        <span class="fw-bold">Phone No.:</span> {{ $customer->phone_number ?? '' }}
                                        <br>
                                        <span class="fw-bold">Address:</span> {{ $customer->address ?? '' }}
                                    </address>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <img src="{{ asset(config('env.LOGO_ASSET_PATH')) }}"
                                     class="mb-2"
                                     style="width: 42px; height: auto;"
                                     alt="Invoice Logo">
                                <p class="fw-bold mb-0">{{ $this->order->number }}</p>
                                <div>{{ $this->order->created_at->format('Y-m-d / h:i A') }}</div>
                            </div>

                        </div>
                        <table class="table table-transparent table-responsive">
                            <thead>
                            <tr>
                                <th class="text-center" style="width: 1%"></th>
                                <th>Product</th>
                                <th class="text-center" style="width: 1%">Qnt</th>
                                <th class="text-center" style="width: 1%">Price</th>
                                <th class="text-center" style="width: 1%">Total</th>
                            </tr>
                            </thead>
                            @foreach($order->orderItems as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>
                                        <p class="strong mb-1">{{ $item->product->name }}</p>
                                        <div class="text-muted">{{ $item->inventory->number }}</div>
                                    </td>
                                    <td class="text-center">
                                        {{ number_format($item->quantity) }}
                                    </td>
                                    <td class="text-end">${{ number_format($item->price, 2) }}</td>
                                    <td class="text-end">${{ number_format(($item->price * $item->quantity), 2) }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" class="font-weight-bold text-uppercase text-end">Total</td>
                                <td class="font-weight-bold text-end" style="white-space: nowrap;">
                                    <span class="fw-bold">${{ number_format($order->total, 2) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="font-weight-bold text-uppercase text-end">Paid</td>
                                <td class="font-weight-bold text-end" style="white-space: nowrap;">
                                    <span class="fw-bold">${{ number_format($order->paid, 2) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="font-weight-bold text-uppercase text-end">Remaining</td>
                                <td class="font-weight-bold text-end" style="white-space: nowrap;">
                                    <span class="fw-bold">
                                        ${{ number_format($order->amount_due, 2) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="font-weight-bold text-uppercase text-end">Customer Amt. Due</td>
                                <td class="font-weight-bold text-end" style="white-space: nowrap;">
                                    <span class="fw-bold">
                                        ${{ number_format($customer->amount_due, 2) }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                        <p class="text-muted text-center mt-5">Thank you for doing business with us. We look
                            forward to working with
                            you again!</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
