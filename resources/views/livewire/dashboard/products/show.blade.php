<div>
    <div class="container-xl">


        <div class="row">
            <div class="col">
                <h3>
                    <a href="{{ route('products.index') }}">Manage Products</a>
                    &nbsp;/&nbsp;
                    {{ $product->number }}
                </h3>
            </div>
        </div>

        <div class="row row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Product {{ $product->number }} info</h3>
                    </div>
                    <div class="card-body">
                        <div class="datagrid">
                            <div class="datagrid-item">
                                <div class="datagrid-title">Product</div>
                                <div class="datagrid-content">{{ $product->name }}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Number</div>
                                <div class="datagrid-content">{{ $product->number }}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Available Inventory</div>
                                <div class="datagrid-content">{{ number_format($product->available_inventory) }}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Times Sold</div>
                                <div class="datagrid-content">{{ number_format($product->times_sold) }}</div>
                            </div>

                            <div class="datagrid-item">
                                <div class="datagrid-title">Image</div>
                                <div class="datagrid-content">
                                    <div class="d-flex align-items-center">
                                        @if($product->getFirstMedia('image'))
                                            <a href="{{ $product->getFirstMedia('image')?->getUrl() }}">
                                                <span class="avatar me-2 rounded" style="background-image: url('{{ $product->getFirstMedia('image')?->getUrl('preview') ?? '' }}')"></span>
                                            </a>
                                        @else
                                            <span class="avatar me-2 rounded" style="background-image: url('{{ asset('images/cardboard-box.png')}}')"></span>
                                        @endif

                                    </div>
                                </div>
                            </div>

                            <div class="datagrid-item">
                                <div class="datagrid-title">Inventories</div>
                                <div class="datagrid-content">
                                    <a href="{{ route('products.inventories.index', $product->id) }}">Manage</a>
                                </div>
                            </div>

                            <div class="datagrid-item">
                                <div class="datagrid-title">Note</div>
                                <div class="datagrid-content">
                                    {{ $product->note }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
