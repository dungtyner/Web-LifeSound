<?php

    $output = "";
    $output .= <<< END

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <link rel="stylesheet" href="css/payment.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <div class=" container-fluid my-5 ">
        <div class="row justify-content-center ">
            <div class="col-xl-10">
                <div class="card shadow-lg ">
                    <div class="row  mx-auto justify-content-center text-center">
                        <div class="col-12 mt-3 ">
                            
                        </div>
                    </div>
                
                    <div class="row justify-content-around">
                        <div class="col-md-5">
                            <div class="card border-0">
                                <div class="card-header pb-0">
                                    <h2 class="card-title space ">Checkout</h2>
                                    <p class="card-text text-muted mt-4  space">CONTENT DETAILS</p>
                                    <hr class="my-0">
                                </div>
                                <div class="card-body">
                                    <div class="row justify-content-between">
                                        <div class="col-auto mt-0"><p><b>Enter the information into form. Input correct transfer content syntax above avoid wrong.    </b></p></div>
                                        
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col"><p class="text-muted mb-2">PAYMENT DETAILS</p><hr class="mt-0"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="NAME" class="small text-muted mb-1">YOUR NAME</label>
                                        <input type="text" class="form-control form-control-sm" name="NAME" id="NAME" aria-describedby="helpId" placeholder="Enter Your Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="NAME" class="small text-muted mb-1">YOUR LOCAL</label>
                                        <input type="text" class="form-control form-control-sm" name="NAME" id="NAME" aria-describedby="helpId" placeholder="Enter Local Here!">
                                    </div>
                                    <div class="row no-gutters">
                                        <div class="col-sm-6 pr-sm-2">
                                            <div class="form-group">
                                                <label for="NAME" class="small text-muted mb-1">Email</label>
                                                <input type="text" class="form-control form-control-sm" name="NAME" id="NAME" aria-describedby="helpId" placeholder="EnterYourEmail">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="NAME" class="small text-muted mb-1">Phone Number</label>
                                                <input type="text" class="form-control form-control-sm" name="NAME" id="NAME" aria-describedby="helpId" placeholder="EnterPhoneNumber">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-md-5">
                                        <div class="col">
                                            <button type="button" name="" id="" class="btn  btn-lg btn-block ">SAVE INFORMATION</button>
                                        </div>
                                    </div>    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            
                            <div class="card border-0 ">
                                

                                <div class="card-form-list-bank">
                                    <div class="card-items-visa">

                                    <div class="logo"><img src="https://raw.githubusercontent.com/dasShounak/freeUseImages/main/Visa-Logo-PNG-Image.png" alt="Visa"></div>
                                        <div class="chip"><img src="https://raw.githubusercontent.com/dasShounak/freeUseImages/main/chip.png" alt="chip"></div>
                                            <div class="number">1234 5678 9012 3456</div>
                                            <div class="name">TUNG TRUONG</div>
                                            <div class="from">18/10</div>
                                            <div class="to">23/06</div>
                                            <div class="ring"></div>
                                        </div>
                                    
                                    </div>
                                </div>
                                
                           


                                <div class="card-header card-2">
                                    <p class="card-text text-muted mt-md-4  mb-2 space">YOUR ORDER <span class=" small text-muted ml-2 cursor-pointer">EDIT SHOPPING BAG</span> </p>
                                    <hr class="my-2">
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row  justify-content-between">
                                        <div class="col-auto col-md-7">
                                            <div class="media flex-column flex-sm-row">
                                                <img class=" img-fluid" src="images/product/1.png" width="62" height="62">
                                                <div class="media-body  my-auto">
                                                    <div class="row ">
                                                        <div class="col-auto"><p class="mb-0"><b>BASUES</b></p><small class="text-muted">1 Week Subscription</small></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" pl-0 flex-sm-col col-auto  my-auto"> <p class="boxed-1">2</p></div>
                                        <div class=" pl-0 flex-sm-col col-auto  my-auto "><p><b>179 $</b></p></div>
                                    </div>
                                    <hr class="my-2">
                                    <div class="row  justify-content-between">
                                        <div class="col-auto col-md-7">
                                            <div class="media flex-column flex-sm-row">
                                                <img class=" img-fluid " src="images/product/2.png" width="62" height="62">
                                                <div class="media-body  my-auto">
                                                    <div class="row ">
                                                        <div class="col"><p class="mb-0"><b>BASUES</b></p><small class="text-muted">2 Week Subscription</small></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pl-0 flex-sm-col col-auto  my-auto"> <p class="boxed">3</p></div>
                                        <div class="pl-0 flex-sm-col col-auto my-auto"><p><b>179 $</b></p></div>
                                    </div>
                                    <hr class="my-2">
                                    <div class="row  justify-content-between">
                                        <div class="col-auto col-md-7">
                                            <div class="media flex-column flex-sm-row">
                                                <img class=" img-fluid " src="images/product/3.png" width="62" height="62">
                                                <div class="media-body  my-auto">
                                                    <div class="row ">
                                                        <div class="col"><p class="mb-0"><b>BASUES</b></p><small class="text-muted">2 Week Subscription</small></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pl-0 flex-sm-col col-auto  my-auto"> <p class="boxed-1">2</p></div>
                                        <div class="pl-0 flex-sm-col col-auto my-auto"><p><b>179 $</b></p></div>
                                    </div>
                                    <hr class="my-2">
                                    <div class="row ">
                                        <div class="col">
                                            <div class="row justify-content-between">
                                                <div class="col-4"><p class="mb-1"><b>Subtotal</b></p></div>
                                                <div class="flex-sm-col col-auto"><p class="mb-1"><b>179 $</b></p></div>
                                            </div>
                                            <div class="row justify-content-between">
                                                <div class="col"><p class="mb-1"><b>Shipping</b></p></div>
                                                <div class="flex-sm-col col-auto"><p class="mb-1"><b>0 $</b></p></div>
                                            </div>
                                            <div class="row justify-content-between">
                                                <div class="col-4"><p ><b>Total</b></p></div>
                                                <div class="flex-sm-col col-auto"><p  class="mb-1"><b>537 $</b></p> </div>
                                            </div><hr class="my-0">
                                        </div>
                                    </div>
                                    <div class="row mb-5 mt-4 ">
                                        <div class="col-md-7 col-lg-6 mx-auto"><button type="button" class="btn btn-block btn-outline-primary btn-lg">CONFIRM ORDER</button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    END;


    echo $output;
