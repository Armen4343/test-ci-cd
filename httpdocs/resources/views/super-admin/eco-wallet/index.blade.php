@extends('layouts.super-admin.master')

@section('super-admin')
    <style>
        .edit-div{
            height: 1.7rem !important;
            width: 1.7rem !important;
            line-height: 1.7rem !important;
            top: 50%;
            left: 0;
            margin-top: -0.675rem;
            margin-right: 0.675rem;
            display: inline-block;
            position: relative;
            font-size: 1.05rem;
            border: 0;
            box-shadow: none;
            text-align: center;
            text-indent: 0 !important;
            content: "+";
            font-family: Poppins, Helvetica, sans-serif;
            background-color: #e4e6ef;
            border-radius: 0.475rem;
        }

        .edit-button-color{
            color: #ff0066 !important
        }
    </style>
    @if(session("success"))
        <div class="alert alert-success" role="alert">
            {{session("success")}}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card p-3">
        <div class="card-header align-items-center">
            <h3 class="fw-bolder m-0">Eco Wallet</h3>
        </div>
    </div>
    <div class="card-body p3">
        <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded" id="eco_wallet_table">
            <thead>
            <tr>
                <th></th>
                <th scope="col">Items</th>
                <th>CO2(Kgs)</th>
                <th>H2O(L)</th>
                <th scope="col">Date Of Creation</th>
                <th scope="col">Vendor</th>
                <th scope="col">Source</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr>
                    <td>
                        <div class="edit-div edit-button-color">
                            <a class="edit-button-color"  href="{{route('super.admin.eco-wallet.edit',$item->id)}}">+</a>
                        </div>
                    </td>
                    <th scope="row">{{$item->name}}</th>
                    <td class=" col-1" data-type="co2_avg" data-id="{{$item->id}}">{{$item->co2_avg}}</td>
                    <td class=" col-1" data-type="h2o_avg" data-id="{{$item->id}}">{{$item->h2o_avg}}</td>
                    <td>{{ date("d-m-Y", strtotime($item->created_at)) }}</td>
                    <td>{{$item->user->name}}</td>
                    <td class="source" id="source-{{$item->id}}">{{($item->co2_avg !=  null || $item->h2o_avg != null) ?( !$item->calculate_owner ? "created in openai" : "error openai") : ''}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @push('super-admin-scripts')
        <script type="text/javascript">
            $(document).ready(function () {
                var table = $('#eco_wallet_table').DataTable({
                    "dom":
                        "<'row'" +
                        "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                        "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                        ">" +

                        "<'table-responsive'tr>" +

                        "<'row'" +
                        "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                        "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                        ">"
                });
            });

        </script>
    @endpush
@endsection
