<div class="row">
    <div class="col-md-3">
        <div class="card mb-4 mb-xl-0 border-0 shadow-sm">
            <div class="card-body d-flex w-100 justify-content-between">
                <div class="col">
                    <h5 class="card-title text-muted mb-0">Total Penjualan</h5>
                    <span class="h4 font-weight-bold mb-0">5</span>
                </div>
                <div class="icon icon-shape bg-success text-white rounded-circle">
                    <i class="feather-shopping-cart"></i>
                </div>

            </div>
            <div class="card-footer">
                <a href="<?php echo base_url('admin/transaction'); ?>" class="mb-0 text-muted text-sm">
                    <span class="text-nowrap">Lihat Data</span>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card mb-4 mb-xl-0 border-0 shadow-sm">
            <div class="card-body d-flex w-100 justify-content-between">
                <div class="col">
                    <h5 class="card-title text-muted mb-0">Pembelian</h5>
                    <span class="h4 font-weight-bold mb-0">5</span>
                </div>
                <div class="icon icon-shape bg-danger text-white rounded-circle">
                    <i class="feather-download"></i>
                </div>
            </div>
            <div class="card-footer">
                <a href="" class="mb-0 text-muted text-sm">
                    <span class="text-nowrap">Lihat Data</span>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card  mb-4 mb-xl-0 border-0 shadow-sm">
            <div class="card-body d-flex w-100 justify-content-between">

                <div class="col">
                    <h5 class="card-title text-muted mb-0">Penjualan</h5>
                    <span class="h4 font-weight-bold mb-0">5</span>
                </div>

                <div class="icon icon-shape bg-warning text-white rounded-circle">
                    <i class="feather-upload"></i>
                </div>

            </div>
            <div class="card-footer">
                <a href="" class="mb-0 text-muted text-sm">
                    <span class="text-nowrap">Lihat Data</span>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card mb-4 mb-xl-0 border-0 shadow-sm">
            <div class="card-body d-flex w-100 justify-content-between">

                <div class="col">
                    <h5 class="card-title text-muted mb-0">Profit</h5>
                    <span class="h4 font-weight-bold mb-0">5</span>
                </div>

                <div class="icon icon-shape bg-info text-white rounded-circle">
                    <i class="feather-pie-chart"></i>
                </div>


            </div>
            <div class="card-footer">
                <a href="" class="mb-0 text-muted text-sm">
                    <span class="text-nowrap">Lihat Data</span>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card my-3 shadow-sm">
    <div class="card-header bg-white">
        Data Penjualan Per Bulan
    </div>
    <div class="card-body">
        <canvas id="myChart" width="400" height="100"></canvas>
    </div>
</div>