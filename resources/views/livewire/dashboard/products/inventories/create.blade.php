<div>
    <div class="container-xl">

        <div class="row">
            <div class="col">
                <h3>
                    <a href="{{ route('products.index') }}">Manage Products</a>
                    &nbsp;/&nbsp;
                    <a href="{{ route('products.show', $product->id) }}">{{ $product->number }}</a>
                    &nbsp;/&nbsp;
                    <a href="{{ route('products.inventories.index', ['product' => $product->id]) }}">Inventories</a>
                    &nbsp;/&nbsp;
                    Create
                </h3>
            </div>
        </div>

        <div class="row mt-3">
            <div class="card">
                <div class="card-body">

                    <h3>Create Inventory Item</h3>
                    <p>Through this form you are able to create a new inventory item. please fill in the necessary details are
                        press create.</p>
                    <hr class="mt-0">

                    <div class="row">

                        <form wire:submit="store">

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="">
                                        <label for="cost" class="form-label">
                                            Cost
                                            <small class="text-danger">*</small>
                                        </label>
                                        <input type="text" id="cost" class="form-control" wire:model="form.cost">
                                        @error('form.cost')
                                        <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mt-3 mt-md-0">
                                        <label for="price" class="form-label">
                                            Price
                                            <small class="text-danger">*</small>
                                        </label>
                                        <input type="text" id="price" class="form-control" wire:model="form.price">
                                        @error('form.price')
                                        <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="mt-3">
                                        <label for="quantity" class="form-label">
                                            Quantity
                                            <small class="text-danger">*</small>
                                        </label>
                                        <input type="text" id="quantity" class="form-control" wire:model="form.quantity">
                                        @error('form.quantity')
                                        <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mt-3">
                                        <label for="date" class="form-label">
                                            Date
                                            <small class="text-danger">*</small>
                                        </label>
                                        <input type="date" id="date" class="form-control" wire:model="form.date">
                                        @error('form.date')
                                        <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="mt-3">
                                        <label for="note" class="form-label">
                                            Note
                                            <small class="text-muted">(optional)</small>
                                        </label>
                                        <textarea id="note" cols="30" rows="10" class="form-control"
                                                  wire:model="form.note"></textarea>
                                        @error('form.note')
                                        <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 border-top pt-3">
                                <button class="btn btn-primary" wire:loading.attr="disabled">
                                    <i class="bi bi-check2 me-2"></i>
                                    Create
                                    <div wire:loading wire:target="store">
                                        &nbsp; - Saving...
                                    </div>
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
