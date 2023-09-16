<div>
    <div class="container-xl">


        <div class="row">
            <div class="col">
                <h3>
                    <a href="{{ route('orders.index') }}">Manage Orders</a>
                    &nbsp;/&nbsp;
                    Create
                </h3>
            </div>
        </div>

        <div class="row mt-3">
            <div class="card">
                <div class="card-body">

                    <h3>Create Order</h3>
                    <p>Through this form you are able to create a new order. please fill in the necessary details are
                        press create.</p>
                    <hr class="mt-0">

                    <div class="row">

                        <form wire:submit="store">
                            <div class="row">
                                <div class="col-12">
                                    <div class="">
                                        <label for="customer_id" class="form-label">
                                            Customer
                                            <small class="text-danger">*</small>
                                            <span wire:loading class="badge bg-warning-lt" wire:target="customerSearchQuery">
                                                Loading Data...
                                            </span>
                                        </label>
                                        @if(!$form->customer_id)
                                            <input type="text" id="customer_id" class="form-control"
                                                   wire:model.live="customerSearchQuery">
                                        @else
                                            <input type="text" id="customer_id" class="form-control"
                                                   wire:model="selectedCustomerString" disabled>
                                        @endif
                                        @error('form.customer_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <div
                                            @style(['overflow-y: scroll; height: 210px;' => ($customerSearchQuery && $suggestedCustomersSelectBox && count($suggestedCustomers))])
                                            @class([ 'dropdown-menu dropdown-menu-demo mt-2' => true, 'show' => ((bool) $customerSearchQuery & $suggestedCustomersSelectBox)])>
                                            @if($suggestedCustomersSelectBox)
                                                @forelse($suggestedCustomers as $customer)
                                                    <a href="#" class="dropdown-item"
                                                       wire:click="selectCustomer({{ $customer['id'] }})">
                                                        <span class="avatar avatar-xs rounded me-2"
                                                              style="background-image: url('{{ asset('images/lighting.png') }}')"></span>
                                                        {{ $customer['name'] }} - {{ $customer['phone_number'] }}
                                                    </a>
                                                @empty
                                                    <a href="" class="dropdown-item">
                                                        No customers found with the provided name.
                                                    </a>
                                                @endforelse
                                            @endif
                                        </div>

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
