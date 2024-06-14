@extends('layouts.super-admin.master')

@section('super-admin')
    <style>
        .preview-img {
            position: relative;
        }

        .preview-img i {
            position: absolute;
            right: 5px;
            font-size: 20px;
            color: #ff0066;
            cursor: pointer;
        }
    </style>
    <div class="card mb-3">
        <div class="card-header align-items-center">
            <h3 class="fw-bolder m-0">Prodotti Listati</h3>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('super.admin.eco-wallet.update',$data->id) }}" method="post" enctype="multipart/form-data"
                  id="editItemForm">
                @csrf
                @method("PUT")
                <div class="col-md-12 mt-3 mb-5">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="fw-bold fs-6 mb-2">CO2</label>
                            <div>
                                <input type="number" step="any" class="form-control" name="co2_avg" value="{{ $data?->co2_avg ?? '' }}"
                                       id="co2">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold fs-6 mb-2">H2O</label>
                            <div>
                                <input type="number" step="any" class="form-control" name="h2o_avg" value="{{ $data?->h2o_avg ?? '' }}"
                                       id="h2o">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-dark rounded-0" id="addCategory-btn">
                            Salva
                            <div class="spinner-border" role="status" id="loader-save" style="display:none;">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @push("super-admin-scripts")
    @endpush

@endsection
