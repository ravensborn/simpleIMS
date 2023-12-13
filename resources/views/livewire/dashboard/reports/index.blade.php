<div>
    <div class="container-xl">


        <div class="row">
            <div class="col">
                <h3>Reports</h3>
            </div>
            <div class="col text-end">

            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <p>
                           Report section is under development, coming soon.
                        </p>
                    </div>
                </div>
            </div>
        </div>

{{--        <div class="row row-cards">--}}
{{--            <div class="col-12">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">--}}
{{--                        <h3 class="card-title">Report List</h3>--}}
{{--                    </div>--}}
{{--                    <div class="list-group list-group-flush">--}}
{{--                        <div class="list-group-item">--}}
{{--                            <div class="row align-items-center">--}}
{{--                                <div class="col-auto">--}}
{{--                                    <input wire:model.live="enableOrdersByProfitCard" id="orders-sorted-by-profit-checkbox"--}}
{{--                                           type="checkbox" class="form-check-input">--}}
{{--                                </div>--}}

{{--                                <label for="orders-sorted-by-profit-checkbox" class="col text-truncate">--}}
{{--                                    Generate Order Profit--}}
{{--                                    <div class="d-block text-secondary text-truncate mt-n1">List of orders sorted by--}}
{{--                                        profit.--}}
{{--                                    </div>--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        @if($enableOrdersByProfitCard)--}}
{{--            <div class="row row-cards" wire:init="loadOrdersByProfitCard">--}}
{{--                <div class="col-12">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-header">--}}
{{--                            <h3 class="card-title">Order List</h3>--}}
{{--                        </div>--}}
{{--                        <div class="card-body border-bottom py-3">--}}
{{--                            <div class="d-flex">--}}

{{--                                <div>--}}
{{--                                    <label for="search" class="form-label">Search</label>--}}
{{--                                    <input type="search" id="search" class="form-control form-control-rounded"--}}
{{--                                           wire:model.live="search" placeholder="Filter table...">--}}
{{--                                </div>--}}

{{--                            </div>--}}
{{--                        </div>--}}


{{--                        <div class="table-responsive">--}}
{{--                            <table class="table table-vcenter card-table">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th>No.</th>--}}
{{--                                    <th>Name</th>--}}

{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody class="table-tbody">--}}
{{--                                @forelse($ordersByProfit as $order)--}}
{{--                                    <tr>--}}
{{--                                        <td>--}}
{{--                                             <span class="text-secondary">--}}
{{--                                                 {{ ($ordersByProfit->currentpage()-1) * $ordersByProfit->perpage() + $loop->index + 1 }}--}}
{{--                                             </span>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            {{ $order->name }}--}}
{{--                                        </td>--}}


{{--                                    </tr>--}}
{{--                                @empty--}}
{{--                                    <tr>--}}
{{--                                        <td colspan="1">No items at the moment.</td>--}}
{{--                                    </tr>--}}
{{--                                @endforelse--}}
{{--                                </tbody>--}}
{{--                            </table>--}}

{{--                        </div>--}}

{{--                        <div class="card-footer d-flex align-items-center mt-3">--}}
{{--                            <div>--}}
{{--                                {{ $ordersByProfit->links() }}--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}

    </div>
</div>
