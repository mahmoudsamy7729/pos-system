<div class="row g-gs mb-4" wire:poll.keep-alive.900s>
    <div class="col-lg-2 col-md-4 col-6">
        <div class="card text-white bg-primary">
            <div class="card-header" >Daily Sales</div>
                <div class="card-inner">
                    <h3 class="card-title text-center"><i class="fas fa-money-bill-wave"></i></h3>
                    <h5 class="card-title text-center" >{{$dailySales}} EGP</h5> 
                </div>
            </div>
    </div><!-- .col -->
    <div class="col-lg-2 col-md-4 col-6">
        <div class="card text-white bg-primary">
            <div class="card-header">Daily Expenses</div>
                <div class="card-inner">
                    <h3 class="card-title text-center"><i class="fas fa-money-bill-wave"></i></h3>
                    <h5 class="card-title text-center" >{{$dailyExpenses}} EGP</h5> 
                </div>
            </div>
    </div><!-- .col -->
    <div class="col-lg-2 col-md-4 col-6">
        <div class="card text-white bg-primary">
            <div class="card-header">Daily Purchase</div>
                <div class="card-inner">
                    <h3 class="card-title text-center"><i class="fas fa-money-bill-wave"></i></h3>
                    <h5 class="card-title text-center">{{$dailyPurchase}} EGP</h5> 
                </div>
            </div>
    </div><!-- .col -->
</div>