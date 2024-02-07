<div>

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Deposit</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active">Deposit</li>
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
                        </table>
                        <br>

                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-block-helper me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-block-helper me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <div class="row">
                        <form wire:submit.prevent="deposit">
                            @csrf
                            @method('POST')

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="" class="">Jumlah Deposit :</label>
                                        <input type="number" wire:model.lazy="amount" name="amount" class="form-control">
                                        @error('amount')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success btn-sm rounded shadow fw-bold">Deposit</button>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

