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
                        <h3 class="card-title">Customer {{ $customer->name }} info</h3>
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
                                <div class="datagrid-content">{{ number_format($customer->orders->count()) }}</div>
                            </div>

                            <div class="datagrid-item">
                                <div class="datagrid-title">Amount Due</div>
                                <div class="datagrid-content">${{ number_format(123, 2) }}</div>
                            </div>

                            <div class="datagrid-item">
                                <div class="datagrid-title">Note</div>
                                <div class="datagrid-content">
                                    {{ $customer->note }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
