<div class="row g-gs mb-4">
    <div class="col-lg-2 col-md-4 col-6">
        <div class="card card-bordered card-shadow">
            <a href="{{route('pos.show')}}" class="card-inner">
                <h3 class="card-title text-center text-success">
                    <i class="fas fa-desktop"></i>
                </h3>
                <p class="card-text text-center" style="color: var(--bs-light-text-emphasis)">
                    {{__('pos')}}
                </p>
            </a>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-6">
        <div class="card card-bordered card-shadow">
            <a href="{{route('sales.add.form.show')}}" class="card-inner">
                <h3 class="card-title text-center text-primary">
                    <i class="fas fa-file-invoice"></i>
                </h3>
                <p class="card-text text-center" style="color: var(--bs-light-text-emphasis)">
                    {{__('make_invoice')}}
                </p>
            </a>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-6">
        <div class="card card-bordered card-shadow">
            <a href="{{route('pos.sessions.show')}}" class="card-inner">
                <h3 class="card-title text-center " style="color: #6528F7">
                    <em class="icon ni ni-dot-box-fill"></em>
                </h3>
                <p class="card-text text-center" style="color: var(--bs-light-text-emphasis)">
                    {{__('sessions')}}
                </p>
            </a>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-6">
        <div class="card card-bordered card-shadow">
            <a href="{{route('sales.show')}}" class="card-inner">
                <h3 class="card-title text-center" style="color: #75C2F6">
                    <i class="fas fa-file-invoice"></i>
                </h3>
                <p class="card-text text-center" style="color: var(--bs-light-text-emphasis)">
                    {{__('invoices')}}
                </p>
            </a>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-6">
        <div class="card card-bordered card-shadow">
            <a href="{{route('customers.show')}}" class="card-inner">
                <h3 class="card-title text-center text-success">
                    <i class="fas fa-user"></i>                                            </h3>
                <p class="card-text text-center" style="color: var(--bs-light-text-emphasis)">
                    {{__('customers')}}
                </p>
            </a>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-6">
        <div class="card card-bordered card-shadow">
            <a href="{{route('customers.add.form.show')}}" class="card-inner">
                <h3 class="card-title text-center" style="color: #164B60">
                    <i class="fas fa-user-plus"></i>
                </h3>
                <p class="card-text text-center" style="color: var(--bs-light-text-emphasis)">
                    {{__('new customer')}}
                </p>
            </a>
        </div>
    </div><!-- .col -->
</div>