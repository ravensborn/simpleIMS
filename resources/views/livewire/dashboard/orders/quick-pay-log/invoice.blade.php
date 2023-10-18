<div>
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h3>
                            <a href="{{ route('customers.index') }}">Manage Customers</a>
                            &nbsp;/&nbsp;
                            <a href="{{ route('customers.show', $customer->id) }}">
                                {{ $customer->name }}
                            </a>
                            &nbsp;/&nbsp;
                            QuickPay
                            &nbsp;/&nbsp;
                            {{ $log->number }}

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
                            <div class="col-6">
                                <p class="h3">{{ config('env.INVOICE_COMPANY_NAME') }}</p>
                                <address>
                                    {{ config('env.INVOICE_COMPANY_EMAIL') }}<br>
                                    {{ config('env.INVOICE_COMPANY_PHONE') }}<br>
                                    {{ config('env.INVOICE_COMPANY_ADDRESS') }}
                                </address>
                            </div>
                            <div class="col-6 text-end">
                                <h2>{{ $this->log->number }}</h2>
                                <div>{{ $this->log->created_at->format('Y-m-d / h:i A') }}</div>
                            </div>
                            <div class="col-12 my-5">
                                <div>
                                    <p class="h3"> {{ $customer->name }}</p>
                                    <address>
                                        @if($customer->email)
                                            {{ $customer->email }}<br>
                                        @endif
                                        {{ $customer->phone_number  }}<br>
                                        {{ $customer->address }}

                                    </address>
                                </div>
                            </div>
                        </div>
                        <table class="table table-transparent table-responsive">
                            <thead>
                            <tr>
                                <th class="text-center" style="width: 1%"></th>
                                <th>Order Number</th>
                                <th class="text-end" style="width: 1%">Paid</th>
                            </tr>
                            </thead>
                            @foreach($log->orders as $order)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>
                                        <p class="text-primary fst-italic strong mb-1">{{ $order->order->number }}</p>
                                    </td>


                                    <td class="text-end text-primary fst-italic" style="white-space: nowrap;">
                                        ${{ number_format($order->payment->amount, 2) }}
                                    </td>


                                </tr>
                            @endforeach

                            <tr>
                                <td colspan="2" class="font-weight-bold text-uppercase text-end">Amount Due</td>
                                <td class="font-weight-bold text-end" style="white-space: nowrap;">
                                    <span class="fw-bold">
                                        ${{ $log->amount_due_before_payment }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="font-weight-bold text-uppercase text-end">Amount Paid</td>
                                <td class="font-weight-bold text-end" style="white-space: nowrap;">
                                    <span class="fw-bold">
                                        ${{ $log->amount_paid }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="font-weight-bold text-uppercase text-end">Customer Amt. Due</td>
                                <td class="font-weight-bold text-end" style="white-space: nowrap;">
                                    <span class="fw-bold">
                                        ${{ $log->remaining }}
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
