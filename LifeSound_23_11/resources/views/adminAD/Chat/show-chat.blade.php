@extends('adminAD.indexAdmin')
@section('contentAdmin')

    <link rel="stylesheet" href="{{ asset('backend/css/chat.css') }}">



    <div class="jumbotron m-0 p-0 bg-transparent">
        <div class="row m-0 p-0 position-relative">
            <div class="col-12 p-0 m-0 position-absolute" style="right: 0px;">
                <div class="card border-0 rounded" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.10), 0 6px 10px 0 rgba(0, 0, 0, 0.01);">

                    <div class="card-header p-1 bg-light border border-top-0 border-left-0 border-right-0" style="color: rgba(96, 125, 139,1.0);">
                        
                        <img class="rounded float-left" style="width: 50px; height: 50px; object-fit: cover;" src="{{ $resultAccount->url_avatar_account }}"  />
                        
                        <h6 class="float-left" style="margin: 0px; margin-left: 10px;"> {{ $resultAccount->fname }} <i class="fa fa-check text-primary" title="Onaylanmış Hesap!"></i> </br><small> İstanbul, TR </small></h6>
                            
                        <div class=" show">

                            <a id="dropdownMenuLink"  class="btn btn-sm float-right text-secondary" role="button"><h5><i class="fa fa-ellipsis-h" title="Ayarlar!" ></i>&nbsp;</h5></a>

                            <div class="dropdown-menu dropdown-menu-right border p-0" >
                                
                                <a class="dropdown-item p-2 text-secondary" href="#"> <i class="fa fa-user m-1" ></i> Profile </a>
                                <hr class="my-1"></hr>
                                <a class="dropdown-item p-2 text-secondary" href="#"> <i class="fa fa-trash m-1" ></i> Delete </a>

                            </div>
                        </div>
                            
                    </div>
                
                    <div class="card bg-sohbet border-0 m-0 p-0" style="height: 65vh;">
                        <div id="sohbet" class="card border-0 m-0 p-0 position-relative bg-transparent" style="overflow-y: auto; height: 100vh;">
                        
                            

                        </div>
                    </div>

                    <div class="w-100 card-footer p-0 bg-light border border-bottom-0 border-left-0 border-right-0">
                        
                            <div class="m-0 p-0"  >
            
                                <div class="row m-0 p-0 footer-chat">
                                    <div class="col-9 m-0 p-1">
                                    
                                        <input id="text" class="mw-100 border rounded form-control input-admin-mess" type="text" name="text" title="Type a message..." placeholder="Nhật tin nhắn..." required>
                                    
                                    </div>
                                    <div class="col-3 m-0 p-1">
                                    
                                        <button class="btn btn-outline-secondary rounded border w-100 btn-send-mess-from-admin" id_account="{{ $resultAccount->id_account }}" style="padding-right: 16px;"><i class="fa fa-paper-plane" ></i></button>
                                                
                                    </div>
                                </div>
                            
                            </div>
                    </div>

                </div>
            </div>
            
        </div>
    </div>


<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script> --}}




    




    <script type="module" src="{{ asset('backend/js/chat.js') }}"></script>
    <script>
        var id_account = {!! $resultAccount->id_account !!};
        // console.log(id_account);
    </script>


@endsection
