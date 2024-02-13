<div>
    <div class="container-xl d-flex flex-column justify-content-center">

        <p class="empty-title">{{ config('env.APP_NAME') }} Control Panel</p>
        <p class="empty-subtitle text-muted">
            The main dashboard for managing products, customers, and orders.
        </p>

        @if(auth()->user()->hasPermissionTo('can view home cards'))
            <hr>
            <div wire:loading wire:target="loadCards">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div class="row" wire:init="loadCards">
                @foreach($cards as $card)
                    <div class="col-md-3 col-6 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body  d-flex justify-content-between">
                                <div>
                                    <i class="bi bi-clipboard-data"></i>
                                    {{ $card['title'] }}
                                </div>
                                <div>
                                    {{ $card['data'] }}
                                </div>
                            </div>

                        </div>
                    </div>

                @endforeach
            </div>
        @endif

    </div>

</div>
