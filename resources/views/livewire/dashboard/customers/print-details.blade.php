<div>
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h3>
                            <a href="{{ route('customers.index') }}">Manage Customers</a>
                            &nbsp;/&nbsp;
                            <a href="{{ route('customers.show', $customer->id) }}">{{ $customer->name }}</a>
                            &nbsp;/&nbsp;
                            Print Details
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
                            Print Details
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
                                    <div class="datagrid-title">Orders</div>
                                    <div class="datagrid-content">
                                        <a href="{{ route('customers.orders', $customer->id) }}">{{ number_format($customer->orders->count()) }}</a>
                                    </div>
                                </div>

                                <div class="datagrid-item">
                                    <div class="datagrid-title">Amount Due</div>
                                    <div class="datagrid-content">
                                        ${{ number_format($customer->amount_due, 2) }}
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
