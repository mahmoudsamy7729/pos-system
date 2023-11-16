<div class="row g-gs mb-4">
    <div class="col-lg-6">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <div class="card-head">
                    <h6 class="title">Sales Report ({{date('Y')}})</h6>
                </div>
                <div class="nk-ck2">
                    <canvas class="line-chart" id="filledLineChart"></canvas>
                </div>
            </div>
        </div><!-- .card-preview -->
    </div>
    <div class="col-lg-6">
        <div class="card card-bordered h-100">
            <div class="card-inner">
                <div class="card-title-group">
                    <div class="card-title">
                        <h6 class="title">{{date('F Y')}}</h6>
                    </div>
                </div>
                <div class="traffic-channel">
                    <div class="traffic-channel-doughnut-ck">
                        <canvas class="analytics-doughnut" id="MonthlyInfo"></canvas>
                    </div>
                </div><!-- .traffic-channel -->
            </div>
        </div><!-- .card -->
    </div><!-- .col -->
</div>
