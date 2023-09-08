<div>
    <div class="container-xl">


        <div class="row">
            <div class="col">
                <h3>
                    <a href="{{ route('products.index') }}">Manage Products</a>
                    &nbsp;/&nbsp;
                    Create
                </h3>
            </div>
        </div>

        <div class="row mt-3">
            <div class="card">
                <div class="card-body">

                    <h3>Create Product</h3>
                    <p>Through this form you are able to create a new product. please fill in the necessary details are
                        press create.</p>
                    <hr class="mt-0">

                    <div class="row">

                        <form wire:submit="store">

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="">
                                        <label for="name" class="form-label">
                                            Name
                                            <small class="text-danger">*</small>
                                        </label>
                                        <input type="text" id="name" class="form-control" wire:model="form.name">
                                        @error('form.name')
                                        <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mt-3 mt-md-0">
                                        <label for="image" class="form-label">
                                            Image
                                            <small class="text-muted">(optional)</small>
                                        </label>
                                        <input type="file" id="image" class="form-control"
                                               wire:model="form.image">
                                        @error('form.image')
                                        <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                    @if ($form->image)
                                        <img class="img-thumbnail mt-3 object-fit-cover" style="width: 200px; height: auto;" src="{{ $form->image->temporaryUrl() }}" alt="uploaded image">
                                    @endif
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
