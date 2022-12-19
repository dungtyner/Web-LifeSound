@extends('product.index')
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css"
        integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>



    <section style="flex: 1;">
        <div class="square_box box_three"></div>
        <div class="square_box box_four"></div>
        <div class="container mt-5">
            <div class="row" >

                @foreach ($dataForum as $sub_dataForum)
                    @if ($sub_dataForum->notification_type == 'delivery')
                        <div class="col-sm-12">
                            <div class="alert fade alert-simple alert-warning alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show"
                                role="alert" data-brk-library="component__alert">
                                <div class="close font__size-18">
                                    <span >{{ $sub_dataForum->notification_date }}</span>
                                </div>
                                <i class="start-icon fas fa-truck-moving faa-flash animated" ></i>
                                <div class="notification_here">
                                    <strong class="font__weight-semibold">{{ $sub_dataForum->notification_title }}</strong>
                                    {{ $sub_dataForum->notification_content }}
                                </div>
                            </div>
                        </div>
                    @elseif($sub_dataForum->notification_type == 'success')
                        <div class="col-sm-12">
                            <div class="alert fade alert-simple alert-success alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show">
                                <div class="close font__size-18">
                                    <span >{{ $sub_dataForum->notification_date }}</span>
                                </div>
                                <i class="start-icon fas fa-handshake faa-flash animated"></i>
                                <div class="notification_here">
                                    <strong class="font__weight-semibold">{{ $sub_dataForum->notification_title }}</strong>
                                    {{ $sub_dataForum->notification_content }}
                                </div>
                            </div>
                        </div>
                    @elseif($sub_dataForum->notification_type == 'cancel')
                        <div class="col-sm-12">
                            <div class="alert fade alert-simple alert-danger alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show" role="alert" data-brk-library="component__alert">
                                <div class="close font__size-18">
                                    <span >{{ $sub_dataForum->notification_date }}</span>
                                </div>
                                <i class="start-icon far fa-times-circle faa-flash animated"></i>
                                <div class="notification_here">
                                    <strong class="font__weight-semibold">{{ $sub_dataForum->notification_title }}</strong>
                                    {{ $sub_dataForum->notification_content }}
                                </div>
                            </div>
                        </div>
                    @elseif($sub_dataForum->notification_type == 'notification_all')
                        <div class="col-sm-12">
                            <div class="alert fade alert-simple alert-info alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show"
                                role="alert" data-brk-library="component__alert">
                                <div class="close font__size-18">
                                    <span >{{ $sub_dataForum->notification_date }}</span>
                                </div>
                                <img src="{{ $sub_dataForum->notification_avt }}" class="mr-3 rounded-circle" width="50" alt="User" />
                                <div class="notification_here">
                                    <strong class="font__weight-semibold">{{ $sub_dataForum->notification_title }}</strong>
                                    {{ $sub_dataForum->notification_content }}
                                </div>
                            </div>
                        </div>
                    @elseif($sub_dataForum->notification_type == 'reply_comment')
                        <div class="col-sm-12 reply_comment" id_product="{{ $sub_dataForum->id_product->id_product }}" >
                            <div class="alert fade alert-simple alert-info alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show"
                                role="alert" data-brk-library="component__alert">
                                <div class="close font__size-18">
                                    <span >{{ $sub_dataForum->notification_date }}</span>
                                </div>
                                <img src="{{ $sub_dataForum->notification_avt }}" class="mr-3 rounded-circle" width="50" alt="User" />
                                <div class="notification_here">
                                    <strong class="font__weight-semibold">{{ $sub_dataForum->notification_title }}</strong>
                                    {{ $sub_dataForum->notification_content }}
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                {{-- <div class="col-sm-12">
                    <div class="alert fade alert-simple alert-success alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show">
                        <div class="close font__size-18">
                            <span >2022-12-17</span>
                        </div>
                        <img src="https://bootdey.com/img/Content/avatar/avatar2.png" class="mr-3 rounded-circle" width="50" alt="User" />
                        <div class="notification_here">
                            <strong class="font__weight-semibold">Title!</strong>
                            Well done! You successfullyread this important.
                        </div>
                    </div>
                </div> --}}
                

                {{-- <div class="col-sm-12">
                    <div class="alert fade alert-simple alert-success alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show">
                        <button type="button" class="close font__size-18" data-dismiss="alert">
                            <span aria-hidden="true"><a>
                                    <i class="fa fa-times greencross"></i>
                                </a></span>
                            <span class="sr-only">Close</span>
                        </button>
                        <i class="start-icon far fa-check-circle faa-tada animated"></i>
                        <div class="notification_here">
                            <strong class="font__weight-semibold">Title!</strong>
                            Well done! You successfullyread this important.
                        </div>
                    </div>
                </div> --}}

                {{-- <div class="col-sm-12">
                    <div class="alert fade alert-simple alert-info alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show"
                        role="alert" data-brk-library="component__alert">
                        
                        <i class="start-icon  fa fa-info-circle faa-shake animated"></i>
                        <strong class="font__weight-semibold">Heads up!</strong> This alert needs your attention, but it's
                        not super important.
                    </div>

                </div> --}}

                {{-- <div class="col-sm-12">
                    <div class="alert fade alert-simple alert-warning alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show"
                        role="alert" data-brk-library="component__alert">
                        
                        <i class="start-icon fa fa-exclamation-triangle faa-flash animated"></i>
                        <strong class="font__weight-semibold">Warning!</strong> Better check yourself, you're not looking
                        too good.
                    </div>
                </div> --}}

                {{-- <div class="col-sm-12">
                    <div class="alert fade alert-simple alert-danger alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show"
                        role="alert" data-brk-library="component__alert">
                        
                        <i class="start-icon far fa-times-circle faa-pulse animated"></i>
                        <strong class="font__weight-semibold">Oh snap!</strong> Change a few things up and try submitting
                        again.
                    </div>
                </div> --}}

                {{-- <div class="col-sm-12">
                    <div class="alert fade alert-simple alert-primary alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show"
                        role="alert" data-brk-library="component__alert">
                        <div class="close font__size-18">
                            <span >2022-12-17</span>
                        </div>
                        <i class="start-icon fa fa-thumbs-up faa-bounce animated"></i>
                        <strong class="font__weight-semibold">Well done!</strong> You successfullyread this important.
                    </div>

                </div> --}}

            </div>
        </div>

    </section>
    <div class="pagination_border">
        <nav aria-label="Page navigation example ">
            <ul class="pagination">
                @for ($i = 1; $i <= $total_page; $i++)
                    <li class="page-item"><a class="page-link" href="/forum?page={{ $i }}">{{ $i }}</a></li>
                @endfor
            </ul>
        </nav>
    </div>












@endsection
