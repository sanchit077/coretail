@extends('layouts.Admin.dashboard')
@if(isset($app_data))
@section('title', __('admin_application.v_application'))
@else
@section('title', __('admin_application.v_application'))
@endif

@section('content')  
<link rel="stylesheet" href="{{ asset('admin/node_modules/jquery-tags-input/dist/jquery.tagsinput.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('admin/node_modules/lightgallery/dist/css/lightgallery.min.css') }}" />
<link rel="stylesheet" href="{{ asset('admin/dist/bootstrap-tagsinput.css') }}">
<div class="row flex-grow">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h4 class="card-title">@if(isset($app_data)){{ __('admin_application.v_application') }}@else {{ __('admin_application.v_application') }} @endif</h4>
                    </div> 
                    <div class="col-6">
                        <p class="page-description"><a style="float: right;" href="{{ route('admin_application_all') }}" class="btn btn-primary">{{ __('buttons.back')}}</a></p> 
                    </div>
                </div> 
                <div class='row'>
                   
 <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <!-- <p class="card-title">APPLICATION: CM19200</p> -->
                 <!--  <p class="card-description">
                    Add class <code>.table-hover</code>
                  </p> -->
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Appliocation</th>
                          <th>FROM</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>{{$app_data->loan_id}}</td>
                          <td>@if(is_object($UserDetail)) {{ $UserDetail->first_name." ".$UserDetail->last_name}}@endif</td>
                          <td><label class="badge badge-warning">{{ucfirst($app_data->status)}}</label></td>
                          <td><a href="javascript:;">To Export</a></td>
                        </tr>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="tab-content">
                  <div class="tab-pane fade show active">
                    
                    <div class="row detail-info-box">
                          <div class="col-sm-12">
                            <div class="row">
                              <div class="col-sm-12">
                                <p><strong>Personal financing</strong></p>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-12">
                                <p><strong>Product:</strong></p>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-12">
                                <p><strong>Advisor:</strong> N / A</p>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-12">
                                <p><strong>Amount to finance:</strong> $ 99,920</p>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-12">
                                <p><strong>Term (in months):</strong> 48</p>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-12">
                                  <p><strong>Start date:</strong> February 20 at 7:41 p.m.</p>
                                 <p><strong>Days in process:</strong> 0</p>
                              </div>
                            </div>

                      

                            <div class="collapse in" id="js-custom-fields-more-panel" aria-expanded="true" style="">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><strong>CAT:</strong> %</p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>Hitch:</strong> $</p>
                                    </div>
                                
                                    <div class="col-md-12">
                                        <p>TOTAL AMOUNT TO PAY</p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>Total Amount to Pay:</strong> $</p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>Total Amount to Pay (in letters):</strong></p>
                                    </div>

                                    <div class="col-md-12">
                                        <p>ANNUAL INTEREST RATE</p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>Ordinary:</strong> %</p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>By default:</strong> %</p>
                                    </div>
                                
                                    <div class="col-md-12">
                                        <p>COMMISSIONS</p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>Opening:</strong> %</p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>Collection expenses:</strong> %</p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>Advance Payment:</strong> %</p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>Balance Management Expenses:</strong> $</p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>LVA Service Charge:</strong> $</p>
                                    </div>

                                    <div class="col-md-12">
                                        <p>AMOUNT OF PARTICIPATIONS</p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>First Payment Date:</strong></p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>Monthly payment:</strong> $</p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>Monthly payment (in letters):</strong></p>
                                    </div>

                                    <div class="col-md-12">
                                        <p>PAYMENT OF PARTICIPATIONS</p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>Payday Date:</strong></p>
                                    </div>

                                    <div class="col-md-12">
                                        <p>WARRANTY</p>
                                    </div>

                                    <div class="col-md-12">
                                        <p>DESCRIPTION </p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>Brand:</strong></p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>Model:</strong></p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>Year :</strong></p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>Colour:</strong></p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>Value of the Car:</strong> $</p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>Invoice Issue Date:</strong></p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>Invoice Issued By:</strong></p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>Invoice No.:</strong></p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>Last Owner:</strong></p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>Lot Name or Agency:</strong></p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>No. of Holdings:</strong></p>
                                    </div>

                                    <div class="col-md-12">
                                        <p>REFERENCES</p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>Serial number:</strong></p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>Engine No.:</strong></p>
                                    </div>

                                    <div class="col-md-12">
                                        <p>SAFE</p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>Amount of Insurance:</strong> $</p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>Amount of Insurance (in letters):</strong></p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>Amount Funded Without Insurance:</strong>  $</p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>Amount Funded Without Insurance (in letters):</strong></p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>Insurance Maturity Date:</strong></p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>Insurance Renewal Date:</strong></p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>Insurance carrier:</strong></p>
                                    </div>

                                    <div class="col-md-12">
                                        <p>CONTRACT</p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>Date of Contract Generation:</strong></p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>Place:</strong></p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>Account number:</strong></p>
                                    </div>
                                    <div class="col-md-12">
                                        <p><strong>Reference number :</strong></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <a data-toggle="collapse" href="#js-custom-fields-more-panel" class="more_a" aria-expanded="true">
                                        Load More <i class="fa fa-angle-down"></i></a>
                                </div>
                            </div>
                            <script>
                                jQuery('.more_a').click(function(){
                                    if(jQuery('#js-custom-fields-more-panel').hasClass('show')){
                                        $(this).html('More <i class="fa fa-angle-down">');
                                    }else{    
                                       $(this).html('');        
                                        // $(this).html('Less <i class="fa fa-angle-up">');
                                    }
                                    e.preventDefault();
                                });
                            </script>


                          </div> 
                        </div>

                  </div>
                </div>
            </div>

                  <!-- tabs section start here  -->
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <!-- <p class="card-title"> </p> -->
                  <div class="tab-minimal tab-minimal-success">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-2-1" data-toggle="tab" href="#home-2-1" role="tab" aria-controls="home-2-1" aria-selected="true"><i class="mdi mdi-account-outline"></i>Applicant</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-2-2" data-toggle="tab" href="#profile-2-2" role="tab" aria-controls="profile-2-2" aria-selected="false"><i class="mdi mdi-message-text-outline"></i>Credit Bureau Report</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-2-3" data-toggle="tab" href="#contact-2-3" role="tab" aria-controls="contact-2-3" aria-selected="false"><i class="mdi mdi-message-text-outline"></i>Scoring and Pre Approvals</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-2-4" data-toggle="tab" href="#contact-2-4" role="tab" aria-controls="contact-2-4" aria-selected="false"><i class="mdi mdi-message-text-outline"></i>Doubts and Clearifications</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-2-5" data-toggle="tab" href="#contact-2-5" role="tab" aria-controls="contact-2-5" aria-selected="false"><i class="mdi mdi-message-text-outline"></i>Validations</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane fade show active" id="home-2-1" role="tabpanel" aria-labelledby="tab-2-1">
                        
                         <div class="row">
                              <div class="col-md-12 col-12">
                            <div class="customAccordion" id="accordion">

               <div class="card">
                  <div class="card-header">
                     <a class="card-link" data-toggle="collapse" href="#collapseOne">
                     <span>Personal Information</span>
                     </a>
                  </div>
                  <div id="collapseOne" class="collapse show" data-parent="#accordion">
                     <div class="card-body">
                     <div class="row">
                        <div class="col-xl-12 col-lg-12 col-12">
                                                  
                     <div class="row">
                        <div class="col-md-6 col-12">
                           <div class="inputSpaceRight2">
                           <div class="row">
                              <div class="col-md-3 col-sm-3 col-4">
                                 <div class="form-group-2 style-select-bx">
                                    <label>Title</label>
                                   <input class="form-control" type="text" value="@if(is_object($UserDetail)) {{ $UserDetail->title}}@endif" disabled="disabled" /> 
                                 </div>
                              </div>
                              <div class="col-md-9 col-sm-9 col-8 paddingL0">
                                 <div class="form-group-2">
                                    <label>First Name</label>
                                      <input class="form-control" type="text" name="first_name" id="first_name" placeholder="Enter here" value="@if(is_object($UserDetail)) {{ $UserDetail->first_name}}@endif" disabled="disabled" />
                                 </div>
                              </div>
                           </div>
                           <div class="form-group-2">
                              <label>Last Name</label>
                             <input class="form-control" type="text" name="last_name" id="last_name" placeholder="Enter here" value="@if(is_object($UserDetail)) {{ $UserDetail->last_name}}@endif" disabled="disabled"  />
                           </div>

                               <div class="form-group-2">
                        <label>Gender</label>
                        <div class="radioBtnGroup2">
                            <label class="custRadioBtn2">  
                            <span class="checkmark">@if(is_object($UserDetail)){{$UserDetail->gender}}@endif</span>
                            </label>  
                        </div>
                     </div>

                      <div class="form-group-2">
                        <label>Marital status</label>
                        <div class="radioBtnGroup2">
                            <label class="custRadioBtn2">  
                            <span class="checkmark">@if(is_object($UserDetail)){{$UserDetail->marital_status}}@endif</span>
                            </label>  
                              </div>
                             </div>
                           </div>
                        </div>


                         <div class="col-md-6 col-12">
                                <div class="inputSpaceLeft2">
                            <div class="form-group-2">
                              <label>RFC ( ID )</label>
                               <input class="form-control" type="text" name="RFC" id="RFC" placeholder="Enter here" value="@if(is_object($UserDetail)) {{ $UserDetail->RFC}}@endif" disabled="disabled">
                           </div>

                            <div class="form-group-2">
                              <label>Date of Birth</label>
                               <input class="form-control date_input" type="text" name="DOB" id="DOB" placeholder="DD/MM/YYYY" value="@if(is_object($UserDetail)) {{ $UserDetail->DOB }}@endif" disabled="disabled" />
                           </div>


                            <div class="form-group-2">
                              <label>Email ID</label>
                              <input class="form-control" type="text" disabled="disabled" name="email" id="email" value="{{ $UserDetail->email }}">
                           </div>

                            <div class="form-group-2">
                              <label>Mobile Number</label>
                             <input class="form-control" type="text" name="phone" id="phone" value="{{$UserDetail->phone }}" disabled="disabled" />
                           </div>
                        </div>

                         </div>
                      
                     </div>
                      </div> 
                     </div>
                     </div>
                  </div>
               </div>
               <div class="card">
                  <div class="card-header">
                     <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                     <span>Address Details</span>                      
                     </a>
                  </div>
                  <div id="collapseTwo" class="collapse" data-parent="#accordion">
                     <div class="card-body">
                            <div class="row">
                        <div class="col-xl-12 col-lg-12 col-12"> 
                       
                     <div class="row">
                        <div class="col-md-6 col-12">
                           <div class="inputSpaceRight2">
                           <div class="form-group-2">
                              <label>Residency status</label>
                                <input class="form-control" type="text" value="@if(is_object($app_data->addressDetails)) {{ $app_data->addressDetails->residency_status }}@endif" disabled="disabled" />  
                           </div>
                           <div class="form-group-2">
                             <label>Street address</label>
                              <input class="form-control" type="text" name="street" id="street" placeholder="Enter here" value="@if(is_object($app_data->addressDetails)) {{ $app_data->addressDetails->street }}@endif" disabled="disabled"  />
                           </div>

                          <div class="form-group-2">
                           <label>State</label>
                                  <input class="form-control" type="text" name="state" id="state" placeholder="Enter here" value="@if(is_object($app_data->addressDetails)) {{ $app_data->addressDetails->state }}@endif" disabled="disabled" />
                         </div>


                        <div class="form-group-2">
                            <label>City / Town</label>
                            <input class="form-control" type="text" name="town" id="town" placeholder="Enter here" value="@if(is_object($app_data->addressDetails)) {{ $app_data->addressDetails->town }}@endif" disabled="disabled"  />
                             </div>
                           </div>
                        </div>


                         <div class="col-md-6 col-12">
                                <div class="inputSpaceLeft2">
                            <div class="form-group-2">
                              <label>Postal code</label>
                              <input class="form-control" type="text" name="postcode" id="postcode" placeholder="Enter here" value="@if(is_object($app_data->addressDetails)) {{ $app_data->addressDetails->postcode }}@endif" disabled="disabled" />
                           </div>

                            <div class="form-group-2">
                                <label>Current Living situation</label> 
                                    <div class="radioBtnGroup2">
                                       <label class="custRadioBtn2">  
                                        @if(is_object($app_data->addressDetails) && $app_data->addressDetails->current_living=='outright') 
                                        <span class="checkmark">Own house (out right)</span>
                                        @elseif(is_object($app_data->addressDetails) && $app_data->addressDetails->current_living=='mortgage')
                                        <span class="checkmark">Own house (mortgage)</span>
                                        @else
                                        <span class="checkmark">Rented</span>
                                        @endif
                                        </label>                               
                                  </div>
                           </div> 
                        </div>
                      </div>                      
                 </div>
                  </div> 
                 </div>
                 </div>
              </div>
           </div>

         <div class="card">
            <div class="card-header">
               <a class="collapsed card-link" data-toggle="collapse" href="#collapseFour">
              <span>Working Information</span>
               </a>
            </div>
            <div id="collapseFour" class="collapse" data-parent="#accordion">
               <div class="card-body">
                 <div class="row">
                  <div class="col-xl-12 col-lg-12 col-12">
                    
                     <div class="row">
                        <div class="col-md-6 col-12">
                           <div class="inputSpaceRight2">
                           <div class="form-group-2">
                              <label>Company</label>
                              <input class="form-control" type="text" name="company" id="company" placeholder="Enter here" value="@if(is_object($app_data->employmentInfo)) {{ $app_data->employmentInfo->company }}@endif" disabled="disabled" />
                           </div>
                           <div class="form-group-2">
                             <label>Occupation</label>
                              <input class="form-control" type="text" name="occupation" id="occupation" placeholder="Enter here" value="@if(is_object($app_data->employmentInfo)) {{ $app_data->employmentInfo->occupation }}@endif" disabled="disabled" />
                           </div>

                          <div class="form-group-2">
                           <label>Position</label>
                              <input class="form-control" type="text" name="position" id="position" placeholder="Enter here" value="@if(is_object($app_data->employmentInfo)) {{ $app_data->employmentInfo->position }}@endif" disabled="disabled" />
                         </div>


                        <div class="form-group-2">
                            <label>Total Experience</label>
                            <input class="form-control" type="text" name="total_exp" id="total_exp" placeholder="Enter here" value="@if(is_object($app_data->employmentInfo)) {{ $app_data->employmentInfo->total_exp }}@endif" disabled="disabled" />
                             </div>

                           <div class="form-group-2">
                              <label>Monthly Income</label>
                              <input class="form-control" type="text" name="monthly_income" id="monthly_income" placeholder="Enter here" value="@if(is_object($app_data->employmentInfo)) {{ $app_data->employmentInfo->monthly_income }}@endif" disabled="disabled" />
                           </div>
                            <div class="form-group-2">
                              <label>Office Phone</label>
                              <input class="form-control" type="text" name="w_phone" id="w_phone" placeholder="Enter here" value="@if(is_object($app_data->employmentInfo)) {{ $app_data->employmentInfo->w_phone }}@endif" disabled="disabled" />
                           </div>
                         </div>
                      </div>

                       <div class="col-md-6 col-12">
                          <div class="inputSpaceLeft2">
                            <div class="form-group-2">
                              <label>Address</label>
                              <input class="form-control" type="text" name="w_address" id="w_address" placeholder="Enter here" value="@if(is_object($app_data->employmentInfo)) {{ $app_data->employmentInfo->w_address }}@endif"  disabled="disabled"/>
                           </div>

                            <div class="form-group-2">
                              <label>No Ext</label>
                              <input class="form-control" type="text" name="no_ext" id="no_ext" placeholder="Enter here" value="@if(is_object($app_data->employmentInfo)) {{ $app_data->employmentInfo->no_ext }}@endif"  disabled="disabled" />
                           </div> 

                             <div class="form-group-2">
                              <label>No Int</label>
                              <input class="form-control" type="text" name="no_int" id="no_int" placeholder="Enter here" value="@if(is_object($app_data->employmentInfo)) {{ $app_data->employmentInfo->no_int }}@endif"  disabled="disabled" />
                           </div> 
                           <div class="form-group-2">
                              <label>CP</label>
                              <input class="form-control" type="text" name="cp" id="cp" placeholder="Enter here" value="@if(is_object($app_data->employmentInfo)) {{ $app_data->employmentInfo->cp }}@endif"  disabled="disabled" />
                           </div> 
                           <div class="form-group-2">
                              <label>Colony</label>
                              <input class="form-control" type="text" name="colony" id="colony" placeholder="Enter here" value="@if(is_object($app_data->employmentInfo)) {{ $app_data->employmentInfo->colony }}@endif"  disabled="disabled" />
                           </div> 

                            <div class="form-group-2">
                              <label>City/ State</label>
                              <input class="form-control" type="text" name="city_state" id="city_state" placeholder="Enter here" value="@if(is_object($app_data->employmentInfo)) {{ $app_data->employmentInfo->city_state }}@endif"  disabled="disabled" />
                           </div>
                        
                        </div>
                      </div>                      
                 </div>
                  </div> 
                 </div>
                     </div>
                  </div>
               </div>

       <div class="card">
          <div class="card-header">
             <a class="collapsed card-link" data-toggle="collapse" href="#collapseSix">
            <span>Personal Refrences</span>
             </a>
          </div>
          <div id="collapseSix" class="collapse" data-parent="#accordion">
            <div class="card-body">                
            <form method="post" name="theForm" id="theForm">
              <div class="row">
                <div class="col-xl-12 col-lg-12 col-12">                          
                      
                      @if(isset($app_data->personalReference) && count($app_data->personalReference)>0) 
                      @foreach($app_data->personalReference as $val)
                   <div class="row"> 
                         <div class="col-md-6 col-12">                           
                           <div class="inputSpaceRight2">
                             <div class="form-group-2">
                             <label>Name</label>
                              <input class="form-control" type="text" value="{{ $val->r_name }}" disabled="disabled" />
                           </div>                          
                          </div>
                        </div> 
                        <div class="col-md-3 col-12">        
                          <div class="form-group-2">
                            <label>Relationship</label>
                            <input class="form-control" type="text" value="{{ $val->relation }}" disabled="disabled" /> 
                           </div>     
                        </div>

                      <div class="col-md-3 col-12">           
                        <div class="form-group-2">
                             <label>Phone</label>
                              <input class="form-control" type="text" value="{{ $val->r_phone }}" disabled="disabled" />
                        </div> 
                      </div>    

                   </div> 
              <hr/>
                @endforeach
            @endif

                                            </div> 
                                        </div>
                                    </form>           
                                   </div>
                                </div>
                             </div> 


<!-- New Section for Documents Listing  -->
                <div class="card">
                  <div class="card-header">
                      <a class="collapsed card-link" data-toggle="collapse" href="#collapseSeven">
                        <span>Documents </span>
                       </a>
                      </div>
                      <div id="collapseSeven" class="collapse" data-parent="#accordion">
                        <div class="card-body">  
                           <form method="post" name="ducumentForm" id="ducumentForm">
                            <div class="row">
                              <div class="col-xl-12 col-lg-12 col-12">       
                                 <div class="row"> 
                                       <div class="col-md-12 col-12">                           
                                         <div class="inputSpaceRight2">
                                           <div class="form-group-2">
                                           <label>Official Documents</label>
                                           <div class="row"> 
                                            @foreach($app_data->appDoc as $files)
                                              @if($files->doc_type=='official')
                                                @foreach($files->files as $filespath)   
                                                    @php  
                                                      $val = explode('.',$filespath->doc_img);         
                                                    @endphp
                                                    @if($val[1]=='pdf')
                                                      <div class="col-sm-2 col-md-2 col-lg-2">
                                                        <i class="fa fa-folder-open-o fa-3x"></i>
                                                      </div>
                                                      <div class="col-sm-4 col-md-4 col-lg-4">
                                                          <a href="{{ $filespath->doc_img_url }}" target="_blank">View File</a>
                                                      </div>
                                                       <div class="col-sm-6 col-md-6 col-lg-6">
                                                       </div>
                                                    @else
                                                      <div class="col-sm-2 col-md-2 col-lg-2">
                                                        <i class="fa fa-folder-open-o fa-3x"></i>
                                                      </div>
                                                      <div class="col-sm-4 col-md-4 col-lg-4">
                                                          <a href="{{ $filespath->doc_img_url }}" target="_blank">View File</a>
                                                      </div>
                                                       <div class="col-sm-6 col-md-6 col-lg-6">
                                                       </div>
                                                     @endif 
                                                @endforeach
                                              @endif
                                            @endforeach
                                          </div>
                                         </div>                          
                                        </div>
                                      </div>    
                                    </div>  

 <hr />                            
                                    <div class="row">  
                                       <div class="col-md-12 col-12">                           
                                         <div class="inputSpaceRight2">
                                           <div class="form-group-2">
                                           <label>Address Documents</label>
                                           <div class="row"> 
                                            @foreach($app_data->appDoc as $files)
                                              @if($files->doc_type=='address')
                                                @foreach($files->files as $filespath)   
                                                    @php  
                                                      $val = explode('.',$filespath->doc_img);         
                                                    @endphp
                                                    @if($val[1]=='pdf')
                                                      <div class="col-sm-2 col-md-2 col-lg-2">
                                                        <i class="fa fa-folder-open-o fa-3x"></i>
                                                      </div>
                                                      <div class="col-sm-4 col-md-4 col-lg-4">
                                                          <a href="{{ $filespath->doc_img_url }}" target="_blank">View File</a>
                                                      </div>
                                                       <div class="col-sm-6 col-md-6 col-lg-6">
                                                       </div>
                                                    @else
                                                      <div class="col-sm-2 col-md-2 col-lg-2">
                                                        <i class="fa fa-folder-open-o fa-3x"></i>
                                                      </div>
                                                      <div class="col-sm-4 col-md-4 col-lg-4">
                                                          <a href="{{ $filespath->doc_img_url }}" target="_blank">View File</a>
                                                      </div>
                                                       <div class="col-sm-6 col-md-6 col-lg-6">
                                                       </div>
                                                     @endif 
                                                @endforeach
                                              @endif
                                            @endforeach
                                          </div>
                                         </div>                          
                                        </div>
                                      </div>    
                                    </div> 
  <hr />
                                   <div class="row"> 
                                       <div class="col-md-12 col-12">                           
                                         <div class="inputSpaceRight2">
                                           <div class="form-group-2">
                                           <label>Income Documents</label>
                                           <div class="row"> 
                                            @foreach($app_data->appDoc as $files)
                                              @if($files->doc_type=='income')
                                                @foreach($files->files as $filespath)   
                                                    @php  
                                                      $val = explode('.',$filespath->doc_img);         
                                                    @endphp
                                                    @if($val[1]=='pdf')
                                                      <div class="col-sm-2 col-md-2 col-lg-2">
                                                        <i class="fa fa-folder-open-o fa-3x"></i>
                                                      </div>
                                                      <div class="col-sm-4 col-md-4 col-lg-4">
                                                          <a href="{{ $filespath->doc_img_url }}" target="_blank">View File</a>
                                                      </div>
                                                       <div class="col-sm-6 col-md-6 col-lg-6">
                                                       </div>
                                                    @else
                                                      <div class="col-sm-2 col-md-2 col-lg-2">
                                                        <i class="fa fa-folder-open-o fa-3x"></i>
                                                      </div>
                                                      <div class="col-sm-4 col-md-4 col-lg-4">
                                                          <a href="{{ $filespath->doc_img_url }}" target="_blank">View File</a>
                                                      </div>
                                                       <div class="col-sm-6 col-md-6 col-lg-6">
                                                       </div>
                                                     @endif 
                                                @endforeach
                                              @endif
                                            @endforeach
                                          </div>
                                         </div>                          
                                        </div>
                                      </div>    
                                    </div> 
  <hr />
                                 <div class="row"> 
                                       <div class="col-md-12 col-12">                           
                                         <div class="inputSpaceRight2">
                                           <div class="form-group-2">
                                           <label>Contract</label>
                                           <div class="row"> 
                                            @foreach($app_data->appDoc as $files)
                                              @if($files->doc_type=='contract')
                                                @foreach($files->files as $filespath)   
                                                    @php  
                                                      $val = explode('.',$filespath->doc_img);         
                                                    @endphp
                                                    @if($val[1]=='pdf')
                                                      <div class="col-sm-2 col-md-2 col-lg-2">
                                                        <i class="fa fa-folder-open-o fa-3x"></i>
                                                      </div>
                                                      <div class="col-sm-4 col-md-4 col-lg-4">
                                                          <a href="{{ $filespath->doc_img_url }}" target="_blank">View File</a>
                                                      </div>
                                                       <div class="col-sm-6 col-md-6 col-lg-6">
                                                       </div>
                                                    @else
                                                      <div class="col-sm-2 col-md-2 col-lg-2">
                                                        <i class="fa fa-folder-open-o fa-3x"></i>
                                                      </div>
                                                      <div class="col-sm-4 col-md-4 col-lg-4">
                                                          <a href="{{ $filespath->doc_img_url }}" target="_blank">View File</a>
                                                      </div>
                                                       <div class="col-sm-6 col-md-6 col-lg-6">
                                                       </div>
                                                     @endif 
                                                @endforeach
                                              @endif
                                            @endforeach
                                          </div>
                                         </div>                          
                                        </div>
                                      </div>    
                                    </div> 
    
                                 </div> 
                              </div>
                            </form>
                          </div>
                        </div>
                      </div> 
                    <!-- New section end here -->
                             
                          </div>

                        </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="profile-2-2" role="tabpanel" aria-labelledby="tab-2-2">
                          Him open blessed. Of. A stars. Seed one kind seed that there. Firmament fifth great don't said. Fourth signs seasons they're life, deep. Abundantly had forth rule years they're i
                          mage place thing may sixth created. Moveth, gathered abundantly their thing.
                      </div>
                      <div class="tab-pane fade" id="contact-2-3" role="tabpanel" aria-labelledby="tab-2-3">
                          Doesn't moveth earth creature two saw. Divide i, day divided evening every male very whales form. Form. Creature over, grass moving make multiply doesn't image image replenish is fourth. 
                          Seasons rule, together great. Spirit. Creature one very moved earth gathered.
                      </div>
                       <div class="tab-pane fade" id="contact-2-4" role="tabpanel" aria-labelledby="tab-2-4">
                         2 Doesn't moveth earth creature two saw. Divide i, day divided evening every male very whales form. Form. Creature over, grass moving make multiply doesn't image image replenish is fourth. 
                          Seasons rule, together great. Spirit. Creature one very moved earth gathered.
                      </div>
                       <div class="tab-pane fade" id="contact-2-5" role="tabpanel" aria-labelledby="tab-2-5">
                         3 Doesn't moveth earth creature two saw. Divide i, day divided evening every male very whales form. Form. Creature over, grass moving make multiply doesn't image image replenish is fourth. 
                          Seasons rule, together great. Spirit. Creature one very moved earth gathered.
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

                 <!-- tabs section end here  -->
                </div>
            </div>

        </div>
    </div>
</div>    
@endsection
