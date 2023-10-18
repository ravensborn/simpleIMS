<div>
    <div class="container-xl">


        <div class="row">
            <div class="col">
                <h3>Manage Customers</h3>
            </div>
            <div class="col text-end">
                <a href="{{ route('customers.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-2"></i>
                    New Customer
                </a>
            </div>
        </div>

        <div class="row row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Customer List</h3>
                    </div>
                    <div class="card-body border-bottom py-3">
                        <div class="d-flex">

                            <div>
                                <label for="search" class="form-label">Search</label>
                                <input type="search" id="search" class="form-control form-control-rounded"
                                       wire:model.live="search" placeholder="Filter table...">
                            </div>

                        </div>
                    </div>


                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Amount Due</th>
                                <th>Address</th>
                                <th>Note</th>
                                <th>Created At</th>
                                <th></th>

                            </tr>
                            </thead>
                            <tbody class="table-tbody">
                            @forelse($customers as $customer)
                                <tr>
                                    <td>
                                         <span class="text-secondary">
                                             {{ ($customers->currentpage()-1) * $customers->perpage() + $loop->index + 1 }}
                                         </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('customers.show', $customer->id) }}">
                                            {{ $customer->name }}
                                        </a>
                                    </td>
                                    <td>{{ $customer->phone_number }}</td>
                                    <td>
                                        ${{ number_format($customer->amount_due, 2) }}
                                    </td>
                                    <td>{{ $customer->address }}</td>
                                    <td>{{ $customer->note }}</td>
                                    <td>{{ $customer->created_at->format('Y-m-d / h:i A') }}</td>
                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <a class="btn" href="{{ route('customers.orders', $customer->id) }}">
                                                Orders
                                            </a>
                                            <div class="dropdown">
                                                <button class="btn dropdown-toggle align-text-top"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" style="">
                                                    <a class="dropdown-item"
                                                       href="{{ route('customers.show', $customer->id) }}">
                                                        Details
                                                    </a>
                                                    <a class="dropdown-item"
                                                       href="{{ route('customers.edit', $customer->id) }}">
                                                        Edit
                                                    </a>
                                                    <a class="dropdown-item"
                                                       wire:click="triggerDeleteItem({{ $customer->id }})">
                                                        Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">No items at the moment.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                    </div>

                    <div class="card-footer d-flex align-items-center mt-3">
                        <div>
                            {{ $customers->links() }}
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>
