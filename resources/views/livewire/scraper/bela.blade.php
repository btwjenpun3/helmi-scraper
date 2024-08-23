<div>
    <div class="card card-body">
        <div class="row">
            <div class="col-md-4">
                <label class="form-label required">Product ID</label>
                <input type="number" class="form-control @error('productId') is-invalid @enderror" wire:model='productId'>
            </div>
            <div class="col-md-4">
                <label class="form-label required">Category ID</label>
                <input type="number" class="form-control @error('categoryId') is-invalid @enderror"
                    wire:model='categoryId'>
            </div>
            <div class="col-md-4">
                <label class="form-label required">Number of Pages</label>
                <input type="number" class="form-control @error('pages') is-invalid @enderror" wire:model='pages'>
            </div>
        </div>
        <div class="d-flex justify-content-end mt-3">
            <button class="btn btn-primary" wire:click='scrape' wire:loading.attr='disabled'>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-spider">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 4v2l5 5" />
                    <path d="M2.5 9.5l1.5 1.5h6" />
                    <path d="M4 19v-2l6 -6" />
                    <path d="M19 4v2l-5 5" />
                    <path d="M21.5 9.5l-1.5 1.5h-6" />
                    <path d="M20 19v-2l-6 -6" />
                    <path d="M12 15m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                    <path d="M12 9m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                </svg>
                Scrape
            </button>
        </div>
    </div>
</div>
