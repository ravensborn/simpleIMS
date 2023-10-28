<div>
    <div class="container-xl">


        <div class="row">
            <div class="col">
                <h3>
                    <a href="{{ route('customers.index') }}">Manage Customers</a>
                    &nbsp;/&nbsp;
                    <a href="{{ route('customers.show', $customer->id) }}">{{ $customer->name }}</a>
                    &nbsp;/&nbsp;
                    Edit
                </h3>
            </div>
        </div>

        <div class="row mt-3">
            <div class="card">
                <div class="card-body">

                    <h3>Editing Customer {{ $customer->name }}</h3>
                    <p>Through this form you are able to update the current customer.</p>
                    <hr class="mt-0">

                    <div class="row">

                        <form wire:submit="update">

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="">
                                        <label for="name" class="form-label">
                                            Name
                                            <small class="text-red">*</small>
                                        </label>
                                        <input type="text" id="name" class="form-control" wire:model="form.name">
                                        @error('form.name')
                                        <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mt-3 mt-md-0">
                                        <label for="phone_number" class="form-label">
                                            Phone Number
                                            <small class="text-muted">(optional)</small>
                                        </label>
                                        <input type="tel" id="phone_number" class="form-control"
                                               wire:model="form.phone_number">
                                        @error('form.phone_number')
                                        <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="mt-3">
                                        <label for="email_address" class="form-label">
                                            E-Mail Address
                                            <small class="text-muted">(optional)</small>
                                        </label>
                                        <input type="text" id="email_address" class="form-control"
                                               wire:model="form.email_address">
                                        @error('form.email_address')
                                        <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mt-3">
                                        <label for="address" class="form-label">
                                            Address
                                            <small class="text-muted">(optional)</small>
                                        </label>
                                        <input type="text" id="address" class="form-control" wire:model="form.address">
                                        @error('form.address')
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
                                    Save
                                    <div wire:loading wire:target="update">
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
