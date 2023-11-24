@extends('dashboard.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Approve Vendor</div>

                    <div class="card-body">
                        <form method="POST" action="{{ $vendor->vendor_id }}">
                            @csrf
                            <div class="form-group row">
                                <label for="vendor_name" class="col-md-4 col-form-label text-md-right">Vendor Name</label>

                                <div class="col-md-6">
                                    <input id="vendor_name" type="text" class="form-control" name="vendor_name" value="{{ $vendor->name }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="approval_notes" class="col-md-4 col-form-label text-md-right">Approval Notes</label>

                                <div class="col-md-6">
                                    <textarea id="approval_notes" class="form-control" name="approval_notes" rows="4" placeholder="Enter approval notes here"></textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Approve Vendor</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
