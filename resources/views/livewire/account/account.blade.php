<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Account</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active">Account</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <table width="100%">
                        <tr>
                            <td width="150px">Name</td>
                            <td width="10px">:</td>
                            <td>{{ $wallet->user->name }}</td>
                        </tr>
                        <tr>
                            <td width="150px">Wallet Number</td>
                            <td width="10px">:</td>
                            <td>{{ $wallet->account_number }}</td>
                        </tr>
                        <tr>
                            <td width="150px">Balance</td>
                            <td width="10px">:</td>
                            <td><b>Rp. {{ number_format($wallet->balance, 2) }}</b></td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
