<div>
    <div class="card">
        <div class="table-responsive">
            <table class="table table-vcenter table-hover table-bordered card-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="w-1">Product</th>
                        <th class="w-10">Description</th>
                        <th class="w-1">Price</th>
                        <th class="w-1">Category</th>
                        <th class="w-1">Sub Category</th>
                        <th class="w-1">SKU</th>
                        <th class="w-1">Warranty</th>
                        <th class="w-1">Dimensions</th>
                        <th class="w-1">Weights</th>
                        <th class="w-1">Type</th>
                        <th class="w-1">Made In</th>
                        <th class="w-1">KBKI</th>
                        <th class="w-1">TKDN</th>
                        <th class="w-1">BMP</th>
                        <th class="w-1">TKDN BMP</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                        <tr>
                            <td>{{ $d->id }}</td>
                            <td>{{ $d->name }}</td>
                            <td>
                                <button class="btn btn-link">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path
                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                    </svg>
                                    Show
                                </button>
                            </td>
                            <td>{{ $d->price }}</td>
                            <td>{{ $d->category }}</td>
                            <td>{{ $d->subcategory }}</td>
                            <td>{{ $d->sku }}</td>
                            <td>{{ $d->warranty }}</td>
                            <td>{{ $d->dimensions }}</td>
                            <td>{{ $d->weights }}</td>
                            <td>{{ $d->product }}</td>
                            <td>{{ $d->made_in }}</td>
                            <td>{{ $d->kbki }}</td>
                            <td>{{ $d->tkdn }}</td>
                            <td>{{ $d->bmp }}</td>
                            <td>{{ $d->tkdn_bmp }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="m-3">
            {{ $data->links() }}
        </div>
    </div>
</div>
