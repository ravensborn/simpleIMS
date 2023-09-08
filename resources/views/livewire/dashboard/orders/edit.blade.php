<div>
    <div class="container-xl">


        <div class="row">
            <div class="col">
                <h3>
                    <a href="{{ route('orders.index') }}">Manage Orders</a>
                    &nbsp;/&nbsp;
                    {{ $order->number }}
                    &nbsp;/&nbsp;
                    Edit
                </h3>
            </div>
        </div>

        <div class="row mt-3">
            <div class="card">
                <div class="card-body">

                    <h3>Editing order {{ $order->number }}</h3>
                    <p>Through this form you are able to update the current order.</p>
                    <hr class="mt-0">

                    <div class="row">

                        <form wire:submit="update">

                            <div class="row">
                                <div class="col-12">
                                    <div class="">
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
