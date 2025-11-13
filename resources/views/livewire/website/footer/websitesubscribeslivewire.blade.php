<div class="container mt-5 col-12 col-md-8">
    <div class="card text-center border-0 shadow-sm">
       <div class="card-body col-12 col-md-5 mx-auto">
          <h3 class="card-title mb-3">Free E-mail Job Alerts</h3>
          <div>
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Thank you!</strong> {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
            @endif
        </div>
          <form class="row" wire:submit.prevent="submit">
             <div class="col-md-9 mt-2">
                <label for="email" class="visually-hidden">Enter Your Email</label>
                <input wire:model="email" wire:keyup.enter="emailvalidate" type="text" class="form-control" name="email" id="email" placeholder="Enter Your Email">
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
             </div>
             <div class="col-md-3 mt-2">
                <button  wire:loading.attr="disabled" type="submit" class="btn btn-outline-primary mb-3">
                    <span wire:loading.class="d-lg-none">Subscribe</span>
                    <span wire:loading class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                </button>
             </div>
          </form>
       </div>
    </div>
  </div>