@extends('layouts.super-admin.master')

@section('super-admin')
    <div class="card mb-3">
        <div class="card-header align-items-center">
            <h3 class="fw-bolder m-0">Gestisci Prodotti</h3>
        </div>
        <div class="card-body">
            <table id="items" class="table table-striped border rounded gy-5 gs-7">
                <thead>
                <tr class="fw-bolder fs-6 text-gray-800 px-7">
                    <th>Dettagli</th>
                    <th class="min-w-100px">Immagine</th>
                    <th>Nome</th>
                    <th class="min-w-100px">Categoria</th>
                    <th class="min-w-100px">SottoCategoria</th> 
                    <th class="min-w-200px">Descrizione</th>
                    <th>H2O</th>
                    <th>CO2</th>
                    <th>Allergeni</th>
                    <th>Status</th>
                    <th>Sconto</th>
                    <th>Prezzo</th>
                    <th>Data Offerta</th>
                    <th>Quantita'</th>
                    <th>Promo</th>
                    <th>Giorni Offerta</th>
                    <th>Tempi promozionali</th>
                    <th>Data Scadenza</th>
                    <th>Inventario</th>
                    <th>Data Creazione</th>
                    <th>Azione</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td></td>
                        <td>
                            <!--<a href="{{ asset(($item->image) ? $item->image : 'images/no-image.png') }}" data-fancybox="group" data-caption="{{ $item->name }}">
								<img src="{{ asset(($item->image) ? $item->image : 'images/no-image.png') }}" class="img rounded-1 shadow" style="width:100px; height:60px; object-fit:cover;box-shadow: 0 5px 15px 0 rgba(105, 103, 103, 0.5);" />
							</a> -->
                            <a href="#staticBackdrop" data-bs-toggle="modal" onclick="addActiveClass({{$item->id}})">


                                <img src="{{ asset(($item->image) ? $item->image : 'images/no-image.png') }}"
                                     class="img rounded-1 shadow"
                                     style="width:100px; height:60px; object-fit:cover;box-shadow: 0 5px 15px 0 rgba(105, 103, 103, 0.5);"/>


                            </a>
                        </td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->category->title }}</td>
                        <td>{{ $item->cuisine->title ?? ''}}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->h2o_avg ?? 0 }}</td>
                        <td>{{ $item->co2_avg ?? 0 }}</td>
                        <td>{{ $item->alergen_info}}</td>
                        <td>{{ ($item->menu_status) ? 'Pubblicato' : 'Non Pubblicato' }}</td>
                        <td>{{ $item->discount."%" }}</td>
                        @php
                            $salePrice=0;

                            $totalPrice=$item->price - (($item->discount/ 100) * $item->price);
                            $salePrice=$totalPrice;

                        @endphp
                        <td>{{ number_format((float)$salePrice, 2, ',', '') }}</td>
                        <td style="white-space: nowrap; text-align:center">
                            @php
                                $arrDateRange = explode("-", $item->date_range);
                            @endphp
                            {{ date("d-m-Y", strtotime(trim($arrDateRange[0]))) }}
                            <br>-<br> {{ date("d-m-Y", strtotime(trim($arrDateRange[1]))) }}
                        </td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->promo }}</td>
                        <td>{{ $item->promo_days }}</td>
                        <td>{{ $item->time_range }}</td>
                        <td>
                            @if($item->expire_date!="")
                                {{ date("d-m-Y", strtotime($item->expire_date)) }}
                            @endif
                        </td>
                        <td>{{ $item->availability }}</td>
                        <td>{{ date("d-m-Y H:i:s", strtotime($item->created_at)) }}</td>
                        <td class="">
                            <div class="dropdown-center">
                                <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v  fs-4"></i>
                                </button>

                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{route('items.edit',$item->id)}}">Gestisci</a></li>
                                    <form action="{{route('items.destroy',$item->id)}}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <li>
                                            <button class="dropdown-item deleteBtn1">Cancella</button>
                                        </li>
                                    </form>

                                </ul>
                            </div>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body p-5 py-0">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">

                        <div class="carousel-inner">
                            @php
                                $sr = 0;
                            @endphp
                            @foreach($items as $item)
                                @php
                                    $salePrice=0;

                                    $totalPrice=$item->price - (($item->discount/ 100) * $item->price);
                                    $salePrice=$totalPrice + (($item->tax/ 100) * $totalPrice);

                                @endphp
                                <div class="carousel-item {{ ($sr == 0) ? 'active' : '' }} carousel-item-{{$item->id}}">
                                    <div class="py-3">
                                        <div class="d-flex justify-content-between"><h5
                                                class="main-pink-color">{{ $item->name }} <span
                                                    class="text-dark">&#36;{{ number_format((float)$salePrice, 2, '.', '') }}</span>
                                            </h5></div>
                                    </div>
                                    <img src="{{ asset(($item->image) ? $item->image : 'images/no-image.png') }}"
                                         class="d-block w-100" alt="...">
                                    <div class="d-flex justify-content-center py-2">
                                        <div>
                                            <form action="{{route('remove.menu.item.image',$item->id)}}" method="get"
                                                  class="d-inline">
                                                @csrf
                                                <button class="btn btn-danger deleteBtn1">Remove</button>
                                            </form>
                                        </div>
                                        <div>

                                            <button type="button" class="btn btn-secondary ms-1"
                                                    data-bs-dismiss="modal">Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $sr = 1;
                                @endphp
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('super-admin-scripts')

        <script type="text/javascript">
            $("#items").DataTable({
                responsive: true,
                searching: true,
                caseSensitive: true,
                "language": {
                    "lengthMenu": "Mostra _MENU_",
                },
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

            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    const searchTerm = $('#items_filter').find('input').val().trim().toLowerCase(); // Assuming you have an input field for search
                    // Perform an exact match check
                    return data.some(item => item.toLowerCase().indexOf(searchTerm) !== -1);
                }
            );

            $(document).on('click', '.deleteBtn1', function (e) {
                e.preventDefault()
                var form = $(this).parent().parent();
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-danger',
                        cancelButton: 'btn btn-secondary'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: 'Sei sicuro di voler cancellare?',
                    showCancelButton: true,
                    confirmButtonText: 'Cancella',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            });

            function addActiveClass(id) {
                $(".carousel-item").removeClass("active");
                $(".carousel-item-" + id).addClass("active");
            }
        </script>
    @endpush
@endsection
