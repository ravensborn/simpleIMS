<div>
    <div class="container-xl">


        <div class="row">
            <div class="col">
                <h3>Manage Products</h3>
            </div>
            <div class="col text-end">
                <a href="{{ route('products.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-2"></i>
                    New Product
                </a>
            </div>
        </div>

        <div class="row row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Product List</h3>
                    </div>

                    <div class="card-body border-bottom py-3">
                        <div class="d-flex">

                            <div>
                                <label for="search" class="form-label">Search</label>
                                <input type="search" id="search" class="form-control form-control-rounded"
                                       wire:model.live="search"
                                       placeholder="Filter table...">
                            </div>

                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Product</th>
                                <th>AV. Inventory</th>
                                <th>Default Inventory</th>
                                <th>Times Sold</th>
                                <th>Note</th>
                                <th>Created At</th>
                                <th></th>

                            </tr>
                            </thead>
                            <tbody class="table-tbody">
                            @forelse($products as $product)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        <a href="{{ route('products.show', $product->id) }}" class="text-reset">
                                            <div class="d-flex py-1 align-items-center">
                                                <div class="avatar me-2"
                                                      style="flex: 0 0 32px; height: 32px; background-size: 32px 32px; background-image: url('{{ $product->getFirstMedia('image')?->getUrl('preview') ?? asset('images/cardboard-box.png') }}')">
                                                </div>
                                                <div class="flex-fill">
                                                    <div class="font-weight-medium">{{ $product->name }}</div>
                                                    <div class="text-secondary">{{ $product->number }}</div>
                                                    <div class="text-secondary">{{ $product->code }}</div>
                                                </div>
                                            </div>
                                        </a>
                                    </td>

                                    <td class="text-center">{{ number_format($product->available_inventory) }}</td>
                                    <td class="text-center">{{ number_format($product->getDefaultInventoryQuantity()) }}</td>
                                    <td class="text-center">{{ number_format($product->times_sold) }}</td>
                                    <td>{{ $product->note }}</td>
                                    <td>{{ $product->created_at->format('Y-m-d / h:i A') }}</td>
                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <a href="{{ route('products.inventories.index', $product->id) }}"
                                               class="btn">
                                                Inventory
                                            </a>
                                            <div class="dropdown">
                                                <button class="btn dropdown-toggle align-text-top"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" style="">
                                                    <a class="dropdown-item"
                                                       href="{{ route('products.show', $product->id) }}">
                                                        Details
                                                    </a>
                                                    <a class="dropdown-item"
                                                       href="{{ route('products.edit', $product->id) }}">
                                                        Edit
                                                    </a>
                                                    <a class="dropdown-item"
                                                       wire:click="triggerDeleteItem({{ $product->id }})">
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
                            {{ $products->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
