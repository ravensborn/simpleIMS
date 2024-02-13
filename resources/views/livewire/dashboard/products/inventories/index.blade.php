<div>
    <div class="container-xl">

        <div class="row">
            <div class="col">
                <h3>
                    <a href="{{ route('products.index') }}">Manage Products</a>
                    &nbsp;/&nbsp;
                    <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                    /&nbsp;
                    Inventories
                </h3>
            </div>
            <div class="col text-end">
                <a href="{{ route('products.inventories.create', $product->id) }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-2"></i>
                    New Inventory Item
                </a>
            </div>
        </div>

        <div class="row row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Inventory List</h3>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Serial No.</th>
                                <th>Cost</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Default</th>
                                <th>Date</th>
                                <th>Note</th>
                                <th></th>

                            </tr>
                            </thead>
                            <tbody class="table-tbody">
                            @forelse($inventories as $inventory)
                                <tr>
                                    <td>
                                         <span class="text-secondary">
                                             {{ ($inventories->currentpage()-1) * $inventories->perpage() + $loop->index + 1 }}
                                         </span>
                                    </td>
                                    <td>{{ $inventory->number }}</td>
                                    <td> {{ number_format($inventory->cost, 2) }}</td>
                                    <td> {{ number_format($inventory->price, 2) }}</td>
                                    <td> {{ number_format($inventory->quantity) }}</td>
                                    <td>{{ $inventory->id == $product->default_inventory_id ? 'Yes' : '-' }}</td>
                                    <td>{{ $inventory->date->format('Y-m-d')    }}</td>
                                    <td>{{ $inventory->note }}</td>
                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            @if(!$product->isDefaultInventory($inventory->id))
                                                <a wire:click="setInventoryAsDefault({{ $inventory->id }})"
                                                   class="btn">
                                                    Make Default
                                                </a>
                                            @else
                                                <a class="btn disabled" disabled>
                                                    Make Default
                                                </a>
                                            @endif
                                            <div class="dropdown">
                                                <button class="btn dropdown-toggle align-text-top"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" style="">
                                                    <a class="dropdown-item"
                                                       href="{{ route('products.inventories.edit', ['product' => $product->id, 'inventory' => $inventory->id]) }}">
                                                        Edit
                                                    </a>
                                                    <a class="dropdown-item"
                                                       wire:click="triggerDeleteItem({{ $inventory->id }})">
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
                            {{ $inventories->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
