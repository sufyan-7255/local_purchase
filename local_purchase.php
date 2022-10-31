<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header("location: index.php");
  exit;
}
$uid =  $_SESSION['ID'];
$role =  $_SESSION['ROLE'];
$uname =  $_SESSION['username'];
$vouchers = " ";
$transactions = " ";
$others = " ";
if($uname != 'admin'){
$vouchers = $_SESSION['voucher'];
$transactions = $_SESSION['transaction']; 
$others = $_SESSION['others'];

}

?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Hello, world!</title>
  <?php include "../../header.php" ?>
  <!-- Additional Css -->
  <style>
    body {
      /* -moz-transform: scale(0.95, 0.95); */
      /* zoom: 0.85;
      zoom: 85%; */
    }
    .dropdown-menu li {
      position: relative;
    }

    .dropdown-menu .dropdown-submenu {
      display: none;
      position: absolute;
      left: 100%;
      top: -7px;
    }

    .dropdown-menu .dropdown-submenu-left {
      right: 100%;
      left: auto;
    }

    .dropdown-menu>li:hover>.dropdown-submenu {
      display: block;
    }

    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td,th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #dddddd;
    }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }

    .sticky {
      position: -webkit-sticky;
      position: sticky;
      top: 0;
      left: 0;
      right: 0;
      padding: 4px 3px;
      background-color: #d3d3d3;
      box-shadow: inset 0 1px 0 black, inset 0 -1px 0 black;
      

    }

    .sticky1 {
      position: -webkit-sticky;
      position: sticky;
      bottom: 0;
      left: 0;
      right: 0;
      padding: 4px 3px;
      background-color: #d3d3d3;
      box-shadow: inset 0 1px 0 black, inset 0 -1px 0 black;
      

    }
    .select2-container{
      width:78% !important;
      /* border: 1px solid #d9dbde */
    }
    .amount::placeholder { 
      text-align:right !important
    }

    @media only screen and (max-width: 754px) {
      .select2-container{
          width:89% !important;
        }
    }
    @media screen and (min-width: 766px) and (max-width:994px) {
        .select2-container{
          width:75% !important;
        }
        
    }
    .loading{
        /* margin-top:-5px !important; */
        position:relative;
        top:-7px !important;
    }
    
td .select2-container{
width:100% !important;
}
.table td, .table th {
padding:0.15rem !important;
}
td,th {
border: 1px solid #dddddd;
text-align: left;
font-size:15px
}
.form-group{margin-bottom:4px !important}

.select2-selection--single{
  background:#61bdb6 !important;
}
.select2-selection__rendered{
  color:white !important;
}
.select2-container *:focus {
    outline: none !important;
    border: 2px solid black !important;
}
  </style>
  <!-- Additional Css -->

</head>

<body>

   
<?php include $_SERVER['DOCUMENT_ROOT']."/import/dashboard.php" ?><br>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-7  text-right">
          <h1 style="line-height:19px" class="animate-charcter"><u> Local Purchases ! </u></h1>
        </div>
        <div class="col-sm-5">
          <ol class="breadcrumb float-sm-right">
            <!-- <li class="breadcrumb-item"><a class="btn btn-sm"  href = "web-api/logout/logout.php">LOGOUT</a></li> -->
            <li class="breadcrumb-item active">Transactions</li>
            <li class="breadcrumb-item active"><button style="background-color:transparent;border:none" class="btn btn-sm" id="im_local_purchases_breadcrumb" >Local Purchases</button></li>
          </ol>
        </div>   
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content-header -->
  <!-- /.content -->
  <div class="row response" style="display:none">
    <div class="col-12">
      <div style="line-height:0.7rem" class="container p-2">
        <div class="">
          <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">&times;</button>
              <span class="vd_alert-icon"><i class="fas fa-check-circle vd_green"></i></span><strong>Success! </strong>
          </div>
        </div>
      </div>
    </div>    
  </div>
  
  <section class="content" style="margin-top:-5px;">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <div class="card" style="box-shadow: rgba(136, 165, 191, 0.48) 6px 2px 16px 0px, rgba(255, 255, 255, 0.8) -6px -2px 16px 0px;">
                    <div class="card-body">
                      <form method = "post" id = "transaction_form">
                          <div class="row" style="margin-top:-14px;border-radius:4px;border  :2px solid #1e293b; padding-top:8px;box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;">
                            <!-- <div class="col-lg-6"  style="border  :4px solid #1e293b; padding-top:8px"> -->
                              <!-- <div class="row pl-2"> -->
                                <div class="col-md-2 col-lg-1 col-sm-12 form-group">
                                    <label for=""><b>Doc No :</b></label><span style="color:red;">*</span>
                                </div>
                                <div class="col-md-4 col-lg-2 col-sm-12 form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-pen"></i></span>
                                        </div>
                                        <input type="number" name="document_no" id="document_no" class="form-control form-control-sm" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-1 col-sm-12 form-group">
                                    <label for=""><b>Doc Date:</b></label><span style="color:red;">*</span>
                                </div>
                                <div class="col-md-4 col-lg-2 col-sm-12 form-group">
                                    <div class="input-group"  style="box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;border:1px solid #61bdb6;border-radius:4px">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-pen"></i></span>
                                        </div>
                                        <input type="date" name="voucher_date" id="voucher_date" class="form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                    <span style="color:red;font-size:12px;text-align:center" id="message" ></span>
                                </div>
                                <div class="col-md-2 col-lg-1 col-sm-12 form-group">
                                    <label for=""><b>Year :</b></label><span style="color:red;">*</span>
                                </div>
                                <div class="col-md-4 col-lg-2 col-sm-12 form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-pen"></i></span>
                                        </div>
                                        <input tabindex="-1" type="number" name="year" id="year" class="form-control form-control-sm" min="2000" max="2099" step="1" value="<?php echo date("Y"); ?>" readonly/>
                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-1 col-sm-12 form-group">
                                    <label for=""><b>Ref No :</b></label>
                                </div>
                                <div class="col-md-4 col-lg-2 col-sm-12 form-group">
                                    <div class="input-group" style="box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;border:1px solid #61bdb6;border-radius:4px">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-pen"></i></span>
                                        </div>
                                        <input pattern="[a-zA-Z0-9 ,._-]{1,}" maxlength="30" type="text" name="ref_no" id="ref_no" class="form-control form-control-sm" placeholder="Reference No" >
                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-1 col-sm-12 form-group">
                                    <label for=""><b>Co Code :</b></label><span style="color:red;">*</span>
                                </div>
                                <div class="col-md-4 col-lg-2 col-sm-12 form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-arrow-up"></i></span>
                                        </div>
                                        <select class="form-control form-control-sm js-example-basic-single" id="company_code" name="company_code">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-1 col-sm-12 form-group">
                                    <label for=""><b>Co Name:</b></label><span style="color:red;">*</span>
                                </div>
                                <div class="col-md-4 col-lg-2 col-sm-12 form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-pen"></i></span>
                                        </div>
                                        <textarea tabindex="-1" pattern="[a-zA-Z0-9 ,._-]{1,}" maxlength="30" type="text" name="company_name" id="company_name" class="form-control form-control-sm" placeholder="Company Name" readonly ></textarea>
                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-1 col-sm-12 form-group">
                                    <label for=""><b>Party :</b></label><span style="color:red;">*</span>
                                </div>
                                <div class="col-md-4 col-lg-2 col-sm-12 form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-arrow-up"></i></span>
                                        </div>
                                        <select class="form-control form-control-sm js-example-basic-single" id="party" name="party">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-1 col-sm-12 form-group">  
                                    <label for=""><b>Name :</b></label><span style="color:red;">*</span>
                                </div>
                                <div class="col-md-4 col-lg-2 col-sm-12 form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-pen"></i></span>
                                        </div>
                                        <textarea tabindex="-1" maxlength="30" type="text" name="title" id="title" class="form-control form-control-sm" placeholder="Title Name" readonly></textarea>
                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-1 col-sm-12 form-group">
                                    <label for=""><b>Address :</b></label>
                                </div>
                                <div class="col-md-4 col-lg-2 col-sm-12 form-group">
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                                    </div>
                                    <textarea  tabindex="-1" rows="1" class="form-control  form-control-sm" id="address" name="address" rows="2" readonly></textarea>
                                  </div>
                                </div>
                                <div class="col-md-2 col-lg-1 col-sm-12 form-group">
                                    <label for=""><b>Phone No:</b></label>
                                </div>
                                <div class="col-md-4 col-lg-2 col-sm-12 form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input tabindex="-1" type="text" name = "phone_no" id="phone_no" placeholder="xxxx-xxx-xxxx" value="" class="form-control form-control-sm" data-inputmask="'mask': ['9999-999-9999', '+99-999-999-9999']"  inputmode="text"  readonly>
                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-1 col-sm-12 form-group">
                                    <label for=""><b>GST :</b></label>
                                </div>
                                <div class="col-md-4 col-lg-2 col-sm-12 form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-sort-numeric-asc"></i></span>
                                        </div>
                                        <input tabindex="-1" maxlength="30" type="number" name="gst_no" id="gst_no" class="form-control form-control-sm" placeholder="GST"  readonly>
                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-1 col-sm-12 form-group">
                                    <label for=""><b>CR Days :</b></label>
                                </div>
                                <div class="col-md-4 col-lg-2 col-sm-12 form-group">
                                    <div class="input-group" style="box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;border:1px solid #61bdb6;border-radius:4px">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-sort-numeric-asc"></i></span>
                                        </div>
                                        <input maxlength="30" type="number" name="cr_days" id="cr_days" class="form-control form-control-sm" placeholder="CR Days" >
                                    </div>
                                </div>
                              
                              <!-- </div> -->
                            <!-- </div> -->
                            <!-- <div class="col-lg-6 pl-3"  style="border:4px solid #1e293b; padding-top:8px;border-right:4px solid #1e293b"> -->
                              <!-- <div class="row"> -->
                              
                                <div class="col-md-2 col-lg-1 col-sm-12 form-group">
                                    <label for=""><b>Lot No :</b></label><span style="color:red;">*</span>
                                </div>
                                <div class="col-md-4 col-lg-2 col-sm-12 form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-arrow-up"></i></span>
                                        </div>
                                        <select class="form-control js-example-basic-single" id="lot_no" name="lot_no">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-1 col-sm-12 form-group">
                                    <label for=""><b>Name:</b></label><span style="color:red;">*</span>
                                </div>
                                <div class="col-md-4 col-lg-2 col-sm-12 form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-pen"></i></span>
                                        </div>
                                        <textarea tabindex="-1" pattern="[a-zA-Z0-9 ,._-]{1,}" maxlength="30" type="text" name="lot_name" id="lot_name" class="form-control form-control-sm" placeholder="Lot Name" readonly ></textarea>
                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-1 col-sm-12 form-group">
                                    <label for=""><b>Location :</b></label><span style="color:red;">*</span>
                                </div>
                                <div class="col-md-4 col-lg-2 col-sm-12 form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-arrow-up"></i></span>
                                        </div>
                                        <select class="form-control js-example-basic-single" id="location_code" name="location_code">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-1 col-sm-12 form-group">
                                    <label for=""><b>Name :</b></label><span style="color:red;">*</span>
                                </div>
                                <div class="col-md-4 col-lg-2 col-sm-12 form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-pen"></i></span>
                                        </div>
                                        <textarea tabindex="-1" pattern="[a-zA-Z0-9 ,._-]{1,}" maxlength="30" type="text" name="location_name" id="location_name" class="form-control form-control-sm" placeholder="Location Name" readonly ></textarea>
                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-1 col-sm-12 form-group">
                                    <label for=""><b>Remarks :</b></label>
                                </div>
                                <div class="col-md-10 col-lg-11 col-sm-12 form-group">
                                    <div class="input-group" style="box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;border:1px solid #61bdb6;border-radius:4px">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-pen"></i></span>
                                        </div>
                                        <textarea rows="1" name="narration" id="narration" class="form-control form-control-sm" placeholder="Narration" ></textarea>
                                    </div>
                                </div>
                              <!-- </div> -->
                            <!-- </div> -->
                            <div class="col-md-6 form-group">
                              <input type="hidden" name="debit" id="debit" class="form-control">
                            </div>
                          </div>
                            <div class="row justify-content-center">
                                <div class="col-sm-12">
                                    <div style="height:50px" class="loading">
                                      <span style="text-align:center;font-weight:bold;">Details</span>
                                    </div>
                                </div>
                            </div>
                          <div class="card-body" style="padding-bottom:0px;padding-top:0px">
                            <form id="d" name="geek">
                              <table id="example1" class="table table-bordered table-striped table-responsive-lg" style="box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;">
                                  <thead>
                                      <tr>
                                          <th>Item Code</th>
                                          <th>Description of Goods</th>
                                          <th>Rent Rt</th>
                                          <th>Quantity</th>
                                          <th>Rate</th>
                                          <th>Excl Amount</th>
                                          <th>Stx%</th>
                                          <th>Stax Amt</th>
                                          <th>Incl Amt</th>
                                          <th>Trade Disc</th>
                                          <th>Net Amt</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody id="d_items">
                                    <tr id="main_tr">
                                        <td style="width:13%"><select name="" id = "acc_desc" class="form-control js-example-basic-single acc_desc"></select></td>
                                        <td style="width: 13%;"><textarea   name="" id = "detail" class="form-control form-control-sm detail" readonly></textarea></td>
                                        <td style="width: 5%;"><input type="text"  name="" id="rent_rt" class="form-control form-control-sm rent_rt" readonly></td>
                                        <td style="width: 8%;"><input  style="text-align:right; padding:0 13px 0 0" type="number"  name="" id="quantity" class="form-control form-control-sm quantity"></td>
                                        <td style="width: 8%;"><input  style="text-align:right; padding:0 1px 0 0"  pattern="[0-9 ,.]{1,}" type="text"  name="" id="rate" class="form-control form-control-sm rate"></td>
                                        <td style="width: 8%;"><input  style="text-align:right; padding:0 1px 0 0" type="text"  name="" id="excl_amt" class="form-control form-control-sm excl_amt" readonly></td>
                                        <td style="width: 8%;"><input  style="text-align:right; padding:0 1px 0 0"  pattern="[0-9 ,.]{1,}" type="text"  name="" id="stx" class="form-control form-control-sm stx"></td>
                                        <td style="width: 8%;"><input  style="text-align:right; padding:0 1px 0 0" type="text"  name="" id="stx_amt" class="form-control form-control-sm stx_amt" readonly></td>
                                        <td style="width: 8%;"><input  style="text-align:right; padding:0 1px 0 0" type="text"  name="" id="incl_amt" class="form-control form-control-sm incl_amt" readonly></td>
                                        <td style="width: 8%;"><input  style="text-align:right; padding:0 1px 0 0"  pattern="[0-9 ,.]{1,}" type="text"  name="" id="trade_disc" class="form-control form-control-sm trade_disc"></td>
                                        <td style="width: 15%;"><input  style="text-align:right; padding:0 1px 0 0"  pattern="[a-zA-Z0-9 ,.]{1,}" value="0" type="text"  name="" id = "amount" class="form-control form-control-sm amount" readonly></td>
                                        <td><button type = "button" class="btn btn-sm btn-primary add"><i class="fa fa-plus"></i></button></td>
                                        <td style="display:none"><input type="text"  name="" id="pack_h" class="form-control form-control-sm pack_h"></td>
                                        <td style="display:none"><input type="text"  name="" id="um_h" class="form-control form-control-sm um_h"></td>
                                        <td style="display:none"><input type="text"  name="" id="contain_h" class="form-control form-control-sm contain_h"></td>
                                    </tr>
                                  </tbody>

                                  
                                      <tr id="last_tr">
                                          <td ><b style="font-size:12px">Packing:</b><input type="text"  name="" id="packing" class="form-control form-control-sm packing" readonly></td>
                                          <td><b style="font-size:12px">UM:</b><input type="text"  name="" id="um" class="form-control form-control-sm um" readonly></td>
                                          <td></td>
                                          <td><b style="font-size:12px">Contain:</b><input type="text"  name="" id="contain" class="form-control form-control-sm contain" readonly></td>
                                          <td style="text-align:right;">Total:</td>
                                          <td style="font-weight:bold;font-size:10px" name="excl_total" id="excl_total"><b>0</b></td>
                                          <td></td>
                                          <td style="font-weight:bold;font-size:10px" name="stx_total" id="stx_total"><b>0</b></td>
                                          <td></td>
                                          <td></td>
                                          <td style="font-weight:bold;font-size:10px" name="total" id="total"><b>0</b></td>
                                          <td></td>
                                          <!-- <td colspan="2"></td> -->
                                      </tr>
                                      
                              </table>
                            </form>
                                  <div style="text-align: center;">
                                      <span id="msg" style="color: red;font-size: 13px;"></span>
                                  </div>
                                  <br>
                              <div class="row">
                                  <div class="col-sm-12 text-right">
                                      <button id="submit" type="submit" value="Submit" class="btn btn-primary toastrDefaultSuccess"><i style="font-size:20px" class="fa fa-plus"></i></button>
                                  </div>
                              </div>
                        </div>
                        <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                      </form>
                    </div>
                  </div>
              </div>
          </div>
      </div>
  </section> 

<script>
    $(document).ready(function () {
            var uname = "<?php echo $uname;?>";
            if(uname != 'admin'){
            var transactions = "<?php echo $vouchers;?>";
            var vouchers = "<?php echo $transactions;?>";
            var others= "<?php echo $others;?>";
            
            var transaction1 = transactions.split(",");
            var vouchers1 = vouchers.split(",");
            var others1 = others.split(",");
            if(transaction1!= ''){
            $.each(transaction1, function(key, value){
              document.getElementById(value).style.display = "";
            });
          } 
          if(vouchers1!= ''){
            $.each(vouchers1, function(key, value){
              document.getElementById(value).style.display = "";
            });
          } 
          if(others1!= ''){
            $.each(others1, function(key, value){
              document.getElementById(value).style.display = "";
            });
          } 
        }else{
          var rights = document.getElementsByClassName("show");
          $.each(rights, function(key, value){
            $(value).css("display", "");
         
            });
         
        }
        
    });
$(document).ready(function(){
  $("#voucher_date").focus();
  var message=sessionStorage.getItem('message');
  var status=sessionStorage.getItem('status');
  var doc_no=sessionStorage.getItem('doc_no');
  var lot_status=sessionStorage.getItem('lot_status');
  if(status == '1'){
    toastr.success('Document Number has assigned to this Transaction is '+doc_no+'.');
    $('.alert-dismissible strong').html("Success!"+message);
    $('.response').css('display','');
  }else if(status == '0'){
    toastr.warning('local purchase has not been inserted');
  }
  if(lot_status == '1'){
    toastr.success('Lot has been inserted / updated');
  }else if(lot_status == '0'){
    toastr.warning('Lot has not been inserted / updated');
  }
  sessionStorage.clear(); 
}); 
    $(document).ready(function(){
        var date =$('#voucher_date').val();
        // ACCOUNT code dropdown
        $.ajax({
            url: '../../api/account_vouchers/cash_receipts_api.php',
            type: 'POST',
            data: {action: 'year',voucher_date:date},
            dataType: "json",
            success: function(data){
                if(data != null){
                  $('#year').val(data.mdoc_year);
                  $("#message").html("");
                }else{
                  $('#year').val("");
                  $("#message").html("Invalid Date");
                }
            },
            error: function(error){
                console.log(error);
                alert("Contact IT Department");
            }
        });
      $("#transaction_form").on('focus','.stx',function(){
          var button_id = $(this).attr("id");
          if(button_id =='stx'){
            var stax_id='';
          }else{
            var p_amountid = button_id.split("x");
            var stax_id=p_amountid[1];
          }
          var previous_stax_amountd= $('#stx_amt'+stax_id).val();
          var previous_net_amount= $('#amount'+stax_id).val();
          sessionStorage.setItem("previous_stax_amountd", previous_stax_amountd);
          sessionStorage.setItem("previous_net_amount", previous_net_amount);
      });
      $("#transaction_form").on('change','.stx',function(){
        var previous_stx_amounts=sessionStorage.getItem('previous_stax_amountd');
        if(previous_stx_amounts == ""){
          previous_stx_amount=0;
        }else{
          previous_stx_amount = previous_stx_amounts.replaceAll(',','');
        }
        var total= $('#stx_total').text();
        if(total==''|| total=='0' || total=='0.00'){
          total=0;
        }else{
          total = total.replaceAll(',','');
        }
        var stx_total=parseFloat(total)-parseFloat(previous_stx_amount);
          var button_id = $(this).attr("id");
          if(button_id =='stx'){
            var stx_id='';
          }else{
            var p_stxid = button_id.split("x");
            var stx_id=p_stxid[1];
          }
          var stx_per= $('#stx'+stx_id).val();
          if(stx_per == "" || stx_per == '0.00' || stx_per == '0' || isNaN(stx_per)){
            stx_per=0;
          }
            var amount= $('#excl_amt'+stx_id).val();
            excl_amount = amount.replaceAll(',','');
            percentage=parseFloat(excl_amount)*parseFloat(stx_per)/100;
            var percentage_fnf=new Intl.NumberFormat(
            'en-US', { style: 'currency', 
              currency: 'USD',
            currencyDisplay: 'narrowSymbol'}).format(percentage);
            var percentage_fnf=percentage_fnf.replace(/[$]/g,'');
            console.log(percentage);
            console.log(stx_total);
            var total_stax=parseFloat(percentage)+parseFloat(stx_total);
            // console.log(total_stax);
            var total_stax_fnf=new Intl.NumberFormat(
            'en-US', { style: 'currency', 
              currency: 'USD',
            currencyDisplay: 'narrowSymbol'}).format(total_stax);
            var total_stax_fnf=total_stax_fnf.replace(/[$]/g,'');
            $('#stx_total').text(total_stax_fnf);
            stx_amount=parseFloat(percentage)+parseFloat(excl_amount);
            var st_fnf=new Intl.NumberFormat(
            'en-US', { style: 'currency', 
              currency: 'USD',
            currencyDisplay: 'narrowSymbol'}).format(stx_amount);
            var st_fnf=st_fnf.replace(/[$]/g,'');
            $('#stx_amt'+stx_id).val(percentage_fnf);
            $('#incl_amt'+stx_id).val(st_fnf);
            var trade_disc= $('#trade_disc'+stx_id).val();
            if(trade_disc=='' || trade_disc=='0' || trade_disc=='0.00'){
              $('#amount'+stx_id).val(st_fnf);
            }else{
              trade_disc_f = trade_disc.replaceAll(',','');
              var net_amount=parseFloat(stx_amount)+parseFloat(trade_disc_f);
              var net_amount_fnf=new Intl.NumberFormat(
              'en-US', { style: 'currency', 
                currency: 'USD',
              currencyDisplay: 'narrowSymbol'}).format(net_amount);
              var net_amount_fnf=net_amount_fnf.replace(/[$]/g,'');
              $('#amount'+stx_id).val(net_amount_fnf);
            }
            var total= $('#total').text();
            if(total==''|| total=='0' || total=='0.00'){
              total=0;
            }else{
              total = total.replaceAll(',','');
            }
            console.log(total);
            var previous_net_amounts=sessionStorage.getItem('previous_net_amount');
            if(previous_net_amounts == ""){
              previous_net_amount=0;
            }else{
              previous_net_amount = previous_net_amounts.replaceAll(',','');
            }
            var net_total=parseFloat(total)-parseFloat(previous_net_amount);
            var amount= $('#amount'+stx_id).val();
            amount = amount.replaceAll(',','');
            var final_total_net_amt=parseFloat(amount)+parseFloat(net_total);
            console.log(final_total_net_amt);
            var final_total_net_amt_fnf=new Intl.NumberFormat(
            'en-US', { style: 'currency', 
              currency: 'USD',
            currencyDisplay: 'narrowSymbol'}).format(final_total_net_amt);
            var final_total_net_amt_fnf=final_total_net_amt_fnf.replace(/[$]/g,'');
            $('#total').text(final_total_net_amt_fnf);
          

      });
      $("#transaction_form").on('focus','.trade_disc',function(){
          var button_id = $(this).attr("id");
          if(button_id =='trade_disc'){
            var dis_id='';
          }else{
            var p_amountid = button_id.split("c");
            var dis_id=p_amountid[1];
          }
          var previous_net_amount= $('#amount'+dis_id).val();
          sessionStorage.setItem("previous_net_amount", previous_net_amount);
      });
      $("#transaction_form").on('change','.trade_disc',function(){
        var previous_net_amounts=sessionStorage.getItem('previous_net_amount');
        // console.log(previous_amounts);
        if(previous_net_amounts == ""){
          previous_net_amount=0;
        }else{
          previous_net_amount = previous_net_amounts.replaceAll(',','');
        }
          var button_id = $(this).attr("id");
          if(button_id =='trade_disc'){
            var trade_id='';
          }else{
            var p_tradeid = button_id.split("c");
            var trade_id=p_tradeid[1];
          }
        var total= $('#total').text();
        if(total==''|| total=='0' || total=='0.00'){
          total=0;
        }else{
          total = total.replaceAll(',','');
        }
        // console.log(total);
        var net_total=parseFloat(total)-parseFloat(previous_net_amount);
        // console.log(net_total);
        // amount = amount.replaceAll(',','');
        // var final_total_net_amt=parseInt(amount)+parseInt(net_total);
        // console.log(final_total_net_amt);
          var incl_amt= $('#incl_amt'+trade_id).val();
          incl_amt = incl_amt.replaceAll(',','');
          var trade_disc= $('#trade_disc'+trade_id).val();
          if(trade_disc == "" || trade_disc == '0.00' || trade_disc == '0' || isNaN(trade_disc)){
            trade_disc=0;
          }
          net_amount=parseFloat(incl_amt)-parseFloat(trade_disc);
          var total_amount_final=net_total+net_amount;
        var net_total_fnf=new Intl.NumberFormat(
        'en-US', { style: 'currency', 
          currency: 'USD',
        currencyDisplay: 'narrowSymbol'}).format(total_amount_final);
        var net_total_fnf=net_total_fnf.replace(/[$]/g,'');
        $('#total').text(net_total_fnf);
          // console.log(net_amount);
          var net_amount_fnf=new Intl.NumberFormat(
          'en-US', { style: 'currency', 
            currency: 'USD',
          currencyDisplay: 'narrowSymbol'}).format(net_amount);
          var net_amount_fnf=net_amount_fnf.replace(/[$]/g,'');
          $('#amount'+trade_id).val(net_amount_fnf);
          
          var trade_disc_fnf=new Intl.NumberFormat(
          'en-US', { style: 'currency', 
            currency: 'USD',
          currencyDisplay: 'narrowSymbol'}).format(trade_disc);
          var trade_disc_fnf=trade_disc_fnf.replace(/[$]/g,'');
          $('#trade_disc'+trade_id).val(trade_disc_fnf);
      });
      $("#transaction_form").on('focus','.rate',function(){
          var button_id = $(this).attr("id");
          if(button_id =='rate'){
            var p_rate_id='';
          }else{
            var p_amountid = button_id.split("e");
            var p_rate_id=p_amountid[1];
          }
          var previous_amount= $('#amount'+p_rate_id).val();
          sessionStorage.setItem("previous_amount", previous_amount);
          var previous_excl_amount= $('#excl_amt'+p_rate_id).val();
          sessionStorage.setItem("previous_excl_amount", previous_excl_amount);
          var p_stx= $('#stx'+p_rate_id).val();
          sessionStorage.setItem("p_stx", p_stx);
          var previous_stx_amount= $('#stx_amt'+p_rate_id).val();
          sessionStorage.setItem("previous_stx_amount", previous_stx_amount);
      });
      $("#transaction_form").on('change','.rate',function(){
        var button_id = $(this).attr("id");
        if(button_id =='rate'){
          rate_id='';
        }else{
        var rateid = button_id.split("e");
        rate_id=rateid[1];
        }
        $('#excl_amt'+rate_id).val('');
        $('#stx'+rate_id).val('');
        $('#stx_amt'+rate_id).val('');
        $('#incl_amt'+rate_id).val('');
        // $('#trade_disc'+rate_id).val('');
        $('#amount'+rate_id).val('');
        var previous_amounts=sessionStorage.getItem('previous_amount');
        var previous_excl_amounts=sessionStorage.getItem('previous_excl_amount');
        var p_stxs=sessionStorage.getItem('p_stx');
        var previous_stx_amounts=sessionStorage.getItem('previous_stx_amount');
        // console.log(previous_amounts);
        if(previous_amounts == ""){
          previous_amount=0;
        }else{
          previous_amount = previous_amounts.replaceAll(',','');
        }
        if(previous_excl_amounts == ""){
          previous_excl_amount=0;
        }else{
          previous_excl_amount = previous_excl_amounts.replaceAll(',','');
        }
        if(p_stxs == ""){
          p_stx=0;
        }else{
          p_stx = p_stxs.replaceAll(',','');
        }
        if(previous_stx_amounts == ""){
          previous_stx_amount=0;
        }else{
          previous_stx_amount = previous_stx_amounts.replaceAll(',','');
        }
        var excl_total=$('#excl_total').text();
        var stx_total=$('#stx_total').text();
        var total=$('#total').text();
        if(total == '' || total == '0' || total=='0.00'){
          minuss=0;
        }else{
          minus_t = total.replaceAll(',','');
          minuss= parseFloat(minus_t) - parseFloat(previous_amount);
        }
        if(excl_total == '' || excl_total == '0' || excl_total=='0.00'){
          minuss_e=0;
        }else{
          minus_t_e = excl_total.replaceAll(',','');
          minuss_e= parseFloat(minus_t_e) - parseFloat(previous_excl_amount);
        }
        if(stx_total == '' || stx_total == '0' || stx_total=='0.00'){
          minuss_s=0;
        }else{
          minus_t_s = stx_total.replaceAll(',','');
          minuss_s= parseFloat(minus_t_s) - parseFloat(previous_stx_amount);
        }
        // console.log(minuss);
        var quantity=$('#quantity'+rate_id).val();
        var rate=$('#rate'+rate_id).val();
        if(rate == "" || rate == '0.00' || rate == '0' || isNaN(rate)){
          rate=0;
          amts=0;
          // var 
        }else{
          // rate=rate;
          console.log(rate);
          if (rate.indexOf(',') > -1) { 
            pre_rate = rate.replaceAll(',','');
            var rate=new Intl.NumberFormat(
            'en-US', { style: 'currency', 
              currency: 'USD',
            currencyDisplay: 'narrowSymbol'}).format(pre_rate);
            var rate=rate.replace(/[$]/g,'');
            var  show_rate=rate;
            // console.log(show_rate);
            $('#rate'+rate_id).val(show_rate);
          }else{
            pre_rate=rate;
            var rates=new Intl.NumberFormat(
            'en-US', { style: 'currency', 
              currency: 'USD',
            currencyDisplay: 'narrowSymbol'}).format(rate);
            var rates=rates.replace(/[$]/g,'');
            var  show_rate=rates;
            // console.log(show_rate);
            $('#rate'+rate_id).val(show_rate);
            // var amts=parseFloat(quantity) * parseFloat(pre_rate);
          }
          var contain_h=$('#contain_h'+rate_id).val();
          var amts=parseFloat(quantity) * parseFloat(pre_rate) * parseFloat(contain_h);
        }
          var org_amt=new Intl.NumberFormat(
          'en-US', { style: 'currency', 
            currency: 'USD',
          currencyDisplay: 'narrowSymbol'}).format(amts);
          var org_amt=org_amt.replace(/[$]/g,'');
          // console.log(org_amt);
          $('#amount'+rate_id).val(org_amt);
          $('#excl_amt'+rate_id).val(org_amt);
          $('#incl_amt'+rate_id).val(org_amt);
          if(p_stx=='' || p_stx=='0' || p_stx=='0.00' || isNaN(p_stx)){

          }else{
            // var p_stxs=new Intl.NumberFormat(
            // 'en-US', { style: 'currency', 
            //   currency: 'USD',
            // currencyDisplay: 'narrowSymbol'}).format(p_stx);
            // var p_stx=p_stxs.replace(/[$]/g,'');
            $('#stx'+rate_id).val(p_stx);
            var stx_amount_nd=parseFloat(amts)*parseFloat(p_stx)/100;
            var stx_amount_ns=new Intl.NumberFormat(
            'en-US', { style: 'currency', 
              currency: 'USD',
            currencyDisplay: 'narrowSymbol'}).format(stx_amount_nd);
            var stx_amount_n=stx_amount_ns.replace(/[$]/g,'');
            $('#stx_amt'+rate_id).val(stx_amount_n);
            // console.log(amts);
            // console.log(stx_amount_nd);
            var incl_amount_n=parseFloat(amts)+parseFloat(stx_amount_nd);
            var incl_amount_ns=new Intl.NumberFormat(
            'en-US', { style: 'currency', 
              currency: 'USD',
            currencyDisplay: 'narrowSymbol'}).format(incl_amount_n);
            var incl_amount_n=incl_amount_ns.replace(/[$]/g,'');
            $('#incl_amt'+rate_id).val(incl_amount_n);
            var trade_discount_pre=$('#trade_disc'+rate_id).val();
            console.log(trade_discount_pre);
            if(trade_discount_pre=='' || trade_discount_pre=='0' || trade_discount_pre=='0.00'){
              var incl_amt_upd=$('#incl_amt'+rate_id).val();
              $('#amount'+rate_id).val(incl_amt_upd);
            console.log(incl_amt_upd);
            }else{
              trade_discount_pre = trade_discount_pre.replaceAll(',','');
              var incl_amt_upds=$('#incl_amt'+rate_id).val();
              incl_amt_upd = incl_amt_upds.replaceAll(',','');
              var amount_upd=parseFloat(incl_amt_upd)-parseFloat(trade_discount_pre);
              var amount_upds=new Intl.NumberFormat(
              'en-US', { style: 'currency', 
                currency: 'USD',
              currencyDisplay: 'narrowSymbol'}).format(amount_upd);
              var amount_upd=amount_upds.replace(/[$]/g,'');
              $('#amount'+rate_id).val(amount_upd);
            console.log(amount_upd);
            }
          }
          var amount=$('#amount'+rate_id).val();
          var excl_amts=$('#excl_amt'+rate_id).val();
          var stx_amts=$('#stx_amt'+rate_id).val();
          if(excl_amts=='' || excl_amts=='0' || excl_amts=='0.00'){
            excl_amt=0;
            var ex_tot=$('#excl_total').text();
            var ex_tot = ex_tot.replaceAll(',','');
            var final_ex=parseFloat(ex_tot)-parseFloat(previous_excl_amount);
            $('#excl_total').text(final_ex);
          }else{
            if (excl_amts.indexOf(',') > -1) { 
              excl_amt = excl_amts.replaceAll(',','');
            }else{
              excl_amt=excl_amts;
            }
            var excl_amount=new Intl.NumberFormat(
            'en-US', { style: 'currency', 
              currency: 'USD',
            currencyDisplay: 'narrowSymbol'}).format(excl_amt);
            var excl_amount=excl_amount.replace(/[$]/g,'');
            // var  show_amount=amount;
            var fnf_e=parseFloat(minuss_e) +parseFloat(excl_amt);
            var total_e=new Intl.NumberFormat(
            'en-US', { style: 'currency', 
              currency: 'USD',
            currencyDisplay: 'narrowSymbol'}).format(fnf_e);
            var total_e=total_e.replace(/[$]/g,'');
            $('#excl_total').text(total_e);
          }
          if(stx_amts=='' || stx_amts=='0' || stx_amts=='0.00'){
            stx_amt=0;
            var st_tot=$('#stx_total').text();
            var st_tot = st_tot.replaceAll(',','');
            var final_st=parseFloat(st_tot)-parseFloat(previous_stx_amount);
            $('#stx_total').text(final_st);
          }else{
            if (stx_amts.indexOf(',') > -1) { 
              stx_amt = stx_amts.replaceAll(',','');
            }else{
              stx_amt=stx_amts;
            }
            var stx_amount=new Intl.NumberFormat(
            'en-US', { style: 'currency', 
              currency: 'USD',
            currencyDisplay: 'narrowSymbol'}).format(stx_amt);
            var stx_amount=stx_amount.replace(/[$]/g,'');
            // var  show_amount=amount;
            // console.log(minuss_e);
            // console.log(stx_amt);
            var fnf_e=parseFloat(minuss_s) +parseFloat(stx_amt);
            // console.log(fnf_e);
            var total_s=new Intl.NumberFormat(
            'en-US', { style: 'currency', 
              currency: 'USD',
            currencyDisplay: 'narrowSymbol'}).format(fnf_e);
            var total_s=total_s.replace(/[$]/g,'');
            $('#stx_total').text(total_s);
          }
          if (amount.indexOf(',') > -1) { 
            pre_amount = amount.replaceAll(',','');
            var amount=new Intl.NumberFormat(
            'en-US', { style: 'currency', 
              currency: 'USD',
            currencyDisplay: 'narrowSymbol'}).format(pre_amount);
            var amount=amount.replace(/[$]/g,'');
            var  show_amount=amount;
            var fnf=parseFloat(minuss)+parseFloat(pre_amount);
            // var fnf_e=parseFloat(minuss_e) +parseFloat(pre_amount);
          }else{
            var amounts=new Intl.NumberFormat(
            'en-US', { style: 'currency', 
              currency: 'USD',
            currencyDisplay: 'narrowSymbol'}).format(amount);
            var amunt=amounts.replace(/[$]/g,'');
            var show_amount=amunt;
            var fnf=parseFloat(minuss) +parseFloat(amount);
          }
          var total=new Intl.NumberFormat(
          'en-US', { style: 'currency', 
            currency: 'USD',
          currencyDisplay: 'narrowSymbol'}).format(fnf);
          var total=total.replace(/[$]/g,'');
          $('#total').text(total);
          // $('#amount'+rate_id).val(show_amount);
        

      });
       
      $("#transaction_form").on('focus','.quantity',function(){
          var button_id = $(this).attr("id");
          if(button_id =='quantity'){
            var p_quantity_id='';
          }else{
            var p_amountid = button_id.split("y");
            var p_quantity_id=p_amountid[1];
          }
          var previous_amount= $('#amount'+p_quantity_id).val();
          sessionStorage.setItem("previous_amount", previous_amount);
          var previous_excl_amount= $('#excl_amt'+p_quantity_id).val();
          sessionStorage.setItem("previous_excl_amount", previous_excl_amount);
          var p_stx= $('#stx'+p_quantity_id).val();
          sessionStorage.setItem("p_stx", p_stx);
          var previous_stx_amount= $('#stx_amt'+p_quantity_id).val();
          sessionStorage.setItem("previous_stx_amount", previous_stx_amount);
      });
      $("#transaction_form").on('change','.quantity',function(){
        var button_id = $(this).attr("id");
        if(button_id =='quantity'){
          quantity_id='';
        }else{
        var quantityid = button_id.split("y");
        quantity_id=quantityid[1];
        }
        $('#excl_amt'+quantity_id).val('');
        $('#stx'+quantity_id).val('');
        $('#stx_amt'+quantity_id).val('');
        $('#incl_amt'+quantity_id).val('');
        // $('#trade_disc'+quantity_id).val('');
        $('#amount'+quantity_id).val('');
        var previous_amounts=sessionStorage.getItem('previous_amount');
        var previous_excl_amounts=sessionStorage.getItem('previous_excl_amount');
        var previous_stx_amounts=sessionStorage.getItem('previous_stx_amount');
        var p_stxs=sessionStorage.getItem('p_stx');
        // console.log(previous_amounts);
        if(p_stxs == ""){
          p_stx=0;
        }else{
          p_stx = p_stxs.replaceAll(',','');
        }
        if(previous_amounts == ""){
          previous_amount=0;
        }else{
          previous_amount = previous_amounts.replaceAll(',','');
        }
        if(previous_excl_amounts == ""){
          previous_excl_amount=0;
        }else{
          previous_excl_amount = previous_excl_amounts.replaceAll(',','');
        }
        if(previous_stx_amounts == ""){
          previous_stx_amount=0;
        }else{
          previous_stx_amount = previous_stx_amounts.replaceAll(',','');
        }
        var excl_total=$('#excl_total').text();
        var stx_total=$('#stx_total').text();
        var total=$('#total').text();
        if(total == '' || total == '0' || total=='0.00'){
          minuss=0;
        }else{
          minus_t = total.replaceAll(',','');
          minuss= parseFloat(minus_t) - parseFloat(previous_amount);
        }
        if(excl_total == '' || excl_total == '0' || excl_total=='0.00'){
          minuss_e=0;
        }else{
          minus_t_e = excl_total.replaceAll(',','');
          minuss_e= parseFloat(minus_t_e) - parseFloat(previous_excl_amount);
          // console.log(minuss_e);
        }
        if(stx_total == '' || stx_total == '0' || stx_total=='0.00'){
          minuss_s=0;
        }else{
          minus_t_s = stx_total.replaceAll(',','');
          minuss_s= parseFloat(minus_t_s) - parseFloat(previous_stx_amount);
        }
        var quantity=$('#quantity'+quantity_id).val();
        // console.log(quantity);
        var rate=$('#rate'+quantity_id).val();
        if(rate == ""){
          $('#excl_amt'+quantity_id).val('');
          $('#incl_amt'+quantity_id).val('');
          $('#amount'+quantity_id).val('');
          $('#rate').val('');
        }else{
          if(quantity=='' || quantity=='0' || quantity=='0.00'){
            quantity=0;
          }
            if (rate.indexOf(',') > -1) { 
              pre_rate = rate.replaceAll(',','');
              var rate=new Intl.NumberFormat(
              'en-US', { style: 'currency', 
                currency: 'USD',
              currencyDisplay: 'narrowSymbol'}).format(pre_rate);
              var rate=rate.replace(/[$]/g,'');
              var  show_rate=rate;
              console.log(show_rate);
              $('#rate'+quantity_id).val(show_rate);
              var amts=parseFloat(quantity) * parseFloat(pre_rate);
            }else{
              var rates=new Intl.NumberFormat(
              'en-US', { style: 'currency', 
                currency: 'USD',
              currencyDisplay: 'narrowSymbol'}).format(rate);
              var rates=rates.replace(/[$]/g,'');
              var  show_rate=rates;
              console.log(show_rate);
              $('#rate'+quantity_id).val(show_rate);
              var contain_h=$('#contain_h'+quantity_id).val();
              var amts=parseFloat(quantity) * parseFloat(rate) * parseFloat(contain_h);
            }
            var org_amt=new Intl.NumberFormat(
            'en-US', { style: 'currency', 
              currency: 'USD',
            currencyDisplay: 'narrowSymbol'}).format(amts);
            var org_amt=org_amt.replace(/[$]/g,'');
            $('#amount'+quantity_id).val(org_amt);
            $('#excl_amt'+quantity_id).val(org_amt);
            $('#incl_amt'+quantity_id).val(org_amt);
            if(p_stx=='' || p_stx=='0' || p_stx=='0.00' || isNaN(p_stx)){

            }else{
              // var p_stxs=new Intl.NumberFormat(
              // 'en-US', { style: 'currency', 
              //   currency: 'USD',
              // currencyDisplay: 'narrowSymbol'}).format(p_stx);
              // var p_stx=p_stxs.replace(/[$]/g,'');
              $('#stx'+quantity_id).val(p_stx);
              var stx_amount_nd=parseFloat(amts)*parseFloat(p_stx)/100;
              var stx_amount_ns=new Intl.NumberFormat(
              'en-US', { style: 'currency', 
                currency: 'USD',
              currencyDisplay: 'narrowSymbol'}).format(stx_amount_nd);
              var stx_amount_n=stx_amount_ns.replace(/[$]/g,'');
              $('#stx_amt'+quantity_id).val(stx_amount_n);
              var incl_amount_n=parseFloat(amts)+parseFloat(stx_amount_nd);
              var incl_amount_ns=new Intl.NumberFormat(
              'en-US', { style: 'currency', 
                currency: 'USD',
              currencyDisplay: 'narrowSymbol'}).format(incl_amount_n);
              var incl_amount_n=incl_amount_ns.replace(/[$]/g,'');
              $('#incl_amt'+quantity_id).val(incl_amount_n);
              var trade_discount_pre=$('#trade_disc'+quantity_id).val();
              console.log(trade_discount_pre);
              if(trade_discount_pre=='' || trade_discount_pre=='0' || trade_discount_pre=='0.00'){
                var incl_amt_upd=$('#incl_amt'+quantity_id).val();
                $('#amount'+quantity_id).val(incl_amt_upd);
              console.log(incl_amt_upd);
              }else{
                trade_discount_pre = trade_discount_pre.replaceAll(',','');
                var incl_amt_upds=$('#incl_amt'+quantity_id).val();
                incl_amt_upd = incl_amt_upds.replaceAll(',','');
                var amount_upd=parseFloat(incl_amt_upd)-parseFloat(trade_discount_pre);
                var amount_upds=new Intl.NumberFormat(
                'en-US', { style: 'currency', 
                  currency: 'USD',
                currencyDisplay: 'narrowSymbol'}).format(amount_upd);
                var amount_upd=amount_upds.replace(/[$]/g,'');
                $('#amount'+quantity_id).val(amount_upd);
              console.log(amount_upd);
              }
            }
            var excl_amts=$('#excl_amt'+quantity_id).val();
            var stx_amts=$('#stx_amt'+quantity_id).val();
            if(excl_amts=='' || excl_amts=='0' || excl_amts=='0.00'){
              excl_amt=0;
            }else{
              if (excl_amts.indexOf(',') > -1) { 
                excl_amt = excl_amts.replaceAll(',','');
              }
              var excl_amount=new Intl.NumberFormat(
              'en-US', { style: 'currency', 
                currency: 'USD',
              currencyDisplay: 'narrowSymbol'}).format(excl_amt);
              var excl_amount=excl_amount.replace(/[$]/g,'');
              // var  show_amount=amount;
              var fnf_e=parseFloat(minuss_e) +parseFloat(excl_amt);
              console.log(fnf_e);
              var total_e=new Intl.NumberFormat(
              'en-US', { style: 'currency', 
                currency: 'USD',
              currencyDisplay: 'narrowSymbol'}).format(fnf_e);
              var total_e=total_e.replace(/[$]/g,'');
              excl_amt=total_e;
            }
            $('#excl_total').text(excl_amt);
            if(stx_amts=='' || stx_amts=='0' || stx_amts=='0.00'){
              stx_amt=0;
            }else{
              if (stx_amts.indexOf(',') > -1) { 
                stx_amt = stx_amts.replaceAll(',','');
              }
              var stx_amount=new Intl.NumberFormat(
              'en-US', { style: 'currency', 
                currency: 'USD',
              currencyDisplay: 'narrowSymbol'}).format(stx_amt);
              var stx_amount=stx_amount.replace(/[$]/g,'');
              // var  show_amount=amount;
              var fnf_e=parseFloat(minuss_e) +parseFloat(stx_amt);
              var total_s=new Intl.NumberFormat(
              'en-US', { style: 'currency', 
                currency: 'USD',
              currencyDisplay: 'narrowSymbol'}).format(fnf_e);
              var total_s=total_s.replace(/[$]/g,'');
              stx_amt=total_s;
            }
            $('#stx_total').text(stx_amt);

            var amount=$('#excl_amt'+quantity_id).val();
            
            if (amount.indexOf(',') > -1) { 
              pre_amount = amount.replaceAll(',','');
              var amount=new Intl.NumberFormat(
              'en-US', { style: 'currency', 
                currency: 'USD',
              currencyDisplay: 'narrowSymbol'}).format(pre_amount);
              var amount=amount.replace(/[$]/g,'');
              var  show_amount=amount;
              var fnf=parseFloat(minuss) +parseFloat(pre_amount);
            }else{
              var amounts=new Intl.NumberFormat(
              'en-US', { style: 'currency', 
                currency: 'USD',
              currencyDisplay: 'narrowSymbol'}).format(amount);
              var amunt=amounts.replace(/[$]/g,'');
              var show_amount=amunt;
              var fnf=parseFloat(minuss) +parseFloat(amount);
              // var fnf_e=parseFloat(minuss_e) +parseFloat(amount);
            }
            // console.log(amount);
            var total=new Intl.NumberFormat(
            'en-US', { style: 'currency', 
              currency: 'USD',
            currencyDisplay: 'narrowSymbol'}).format(fnf);
            var total=total.replace(/[$]/g,'');
            $('#total').text(total);
          
        }
        

      });
      $("#transaction_form").on('change','#voucher_date',function(){
        var date =$('#voucher_date').val();
          // ACCOUNT code dropdown
          $.ajax({
              url: '../../api/account_vouchers/cash_receipts_api.php',
              type: 'POST',
              data: {action: 'year',voucher_date:date},
              dataType: "json",
              success: function(data){
                  if(data != null){
                    $('#year').val(data.mdoc_year);
                    $("#message").html("");
                  }else{
                    $('#year').val("");
                    $("#message").html("Invalid Date");
                  }
              },
              error: function(error){
                  console.log(error);
                  alert("Contact IT Department");
              }
          });
      });
    });
    $(document).ready(function(){
      $('.js-example-basic-single').select2();
    });
    $('#im_local_purchases_breadcrumb').click(function(){
      window.location.href='local_purchase.php';
    });
    
    //validation
    $(function () {
          $.validator.setDefaults({
            submitHandler: function () {
              // alert( "Form successful submitted!" );
            }
          });
          $('#transaction_form').validate({
            rules: {
              voucher_date: {
                required: true,
              },
              year: {
                required: true,
              },
              company_code: {
                required: true,
              },
              company_name: {
                required: true,
              },
              party: {
                required: true,
              },
              title: {
                required: true,
              },
              lot_no: {
                required: true,
              },
              location_code: {
                required: true,
              },
              location_name: {
                required: true,
              }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
              error.addClass('invalid-feedback');
              element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
              $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
              $(element).removeClass('is-invalid');
            }
          });
    });


$('#example1').ready(function(){
  // company code dropdown
  $.ajax({
      url: '../../api/charts_of_account/control_account_api.php',
      type: 'POST',
      data: {action: 'company_code'},
      dataType: "json",
      success: function(response){
          // $("#ajax-loader").show();
          console.log(response);
          $('#company_code').html('');
          $('#company_code').append('<option value="" selected disabled>Select Company</option>');
          $.each(response, function(key, value){
              $('#company_code').append('<option data-name="'+value["CO_NAME"]+'"  data-code='+value["CO_CODE"]+' value='+value["CO_CODE"]+'>'+value["CO_CODE"]+' - '+value["CO_NAME"]+'</option>');
          });
      },
      error: function(error){
          console.log(error);
          alert("Contact IT Department");
      }
  });
  //on chAnge company code
  $("#transaction_form").on('change','#company_code',function(){
      // $("#ajax-loader").show();
      var rowCount = $("#example1 tr").length;
      if(rowCount == 3){
        $('#acc_desc').val('');
        $('#detail').val('');
        $('#rent_rt').val('');
        $('#quantity').val('');
        $('#rate').val('');
        $('#excl_amt').val('');
        $('#stx').val('');
        $('#incl_amt').val('');
        $('#trade_disc').val('');
        $('#amount').val('');
      }else{
        for(var a=2;a<rowCount -1;a++){
          var d=a-1;
          $('#tr'+d+'').remove(); 
          $('#excl_total').text('0');
          $('#stx_total').text('0');
          $('#total').text('0');
        }
      }
      $('#party').val('');
      // $('#select2-company_code-container').val('');
      // $('#title').val('');
      var company_name=$('#company_code').find(':selected').attr("data-name");
      var company_code=$('#company_code').find(':selected').attr("data-code");
      $('#select2-company_code-container').html(company_code);
      $('#company_name').val(company_name);
      
      // cash account dropdown
      $.ajax({
          url: '../../api/inventory_management/transactions/local_purchase_api.php',
          type: 'POST',
          data: {action: 'party_accounts_spec',company_code:company_code},
          dataType: "json",
          success: function(response){
              // console.log(response);
              $("#ajax-loader").hide();
              $('#party').html('');
              $('#party').append('<option value="" selected disabled>Select Party</option>');
                $.each(response, function(key, value){
                    $('#party').append('<option data-name="'+value["DESCR"]+'"  data-code='+value["ACCOUNT_CODE"]+' value='+value["ACCOUNT_CODE"]+'>'+value["ACCOUNT_CODE"]+' - '+value["DESCR"]+'</option>');
                });
          },
          error: function(error){
              console.log(error);
              alert("Contact IT Department");
          }
      });
      // LOT detail dropdown
      $.ajax({
          url: '../../api/inventory_management/transactions/local_purchase_api.php',
          type: 'POST',
          data: {action: 'lot_code',company_code:company_code},
          dataType: "json",
          success: function(response){
              // console.log(response);
              $("#ajax-loader").hide();
              $('#lot_no').html('');
              $('#lot_no').append('<option value="" selected disabled>Select Lot</option>');
                $.each(response, function(key, value){
                    $('#lot_no').append('<option data-name="'+value["LOT_NAME"]+'"  data-code='+value["LOT_CODE"]+' value='+value["LOT_CODE"]+'>'+value["LOT_CODE"]+' - '+value["LOT_NAME"]+'</option>');
                });
          },
          error: function(error){
              console.log(error);
              alert("Contact IT Department");
          }
      });
      // LOT detail dropdown
      $.ajax({
          url: '../../api/inventory_management/transactions/local_purchase_api.php',
          type: 'POST',
          data: {action: 'location_code',company_code:company_code},
          dataType: "json",
          success: function(response){
              // console.log(response);
              $("#ajax-loader").hide();
              $('#location_code').html('');
              $('#location_code').append('<option value="" selected disabled>Select Location</option>');
                $.each(response, function(key, value){
                    $('#location_code').append('<option data-name="'+value["WH_NAME"]+'"  data-code='+value["WH_CODE"]+' value='+value["WH_CODE"]+'>'+value["WH_CODE"]+' - '+value["WH_NAME"]+'</option>');
                });
          },
          error: function(error){
              console.log(error);
              alert("Contact IT Department");
          }
      });
      // ACCOUNT code dropdown
      $.ajax({
          url: '../../api/inventory_management/transactions/local_purchase_api.php',
          type: 'POST',
          data: {action: 'item_code',company_code:company_code},
          dataType: "json",
          success: function(response){
              // $("#ajax-loader").show();
              console.log(response);
              $('#acc_desc').html('');
              $('#acc_desc').append('<option value="" selected disabled>Select Account</option>');
              $.each(response, function(key, value){
                  $('#acc_desc').append('<option data-name="'+value["DESCR"]+'"  data-code='+value["ACCOUNT_CODE"]+' value='+value["ACCOUNT_CODE"]+'>'+value["ACCOUNT_CODE"]+' - '+value["DESCR"]+'</option>');
              });
          },
          error: function(error){
              console.log(error);
              alert("Contact IT Department");
          }
      });     
  });
  //on chAnge lot code
  $("#transaction_form").on('change','#lot_no',function(){
      var lot_detail=$('#lot_no').find(':selected').attr("data-name");
      // console.log(lot_detail);
      var lot_code=$('#lot_no').find(':selected').attr("data-code");
      $('#select2-lot_no-container').html(lot_code);
      $('#lot_name').val(lot_detail);
  });
  //on chAnge location code
  $("#transaction_form").on('change','#location_code',function(){
      var location_detail=$('#location_code').find(':selected').attr("data-name");
      // console.log(location_detail);
      var location_code=$('#location_code').find(':selected').attr("data-code");
      $('#select2-location_code-container').html(location_code);
      $('#location_name').val(location_detail);
  });
  
  //on chAnge company code
  $("#transaction_form").on('change','#party',function(){
      var company_code=$('#company_code').val();
      var party_detail=$('#party').find(':selected').attr("data-name");
      // console.log(party_detail);
      var party_code=$('#party').find(':selected').attr("data-code");
      // console.log(detail);
      $('#select2-party-container').html(party_code);
      $('#title').val(party_detail);
      // cash account dropdown
      $.ajax({
          url: '../../api/inventory_management/transactions/local_purchase_api.php',
          type: 'POST',
          data: {action: 'party_detail',party_code:party_code,company_code:company_code},
          dataType: "json",
          success: function(response){
              $('#address').val(response.ADDRESS);
              $('#phone_no').val(response.PHONE_NOS);
              $('#gst_no').val(response.GST);
          },
          error: function(error){
              console.log(error);
              alert("Contact IT Department");
          }
      });
  });
  
  //on chAnge company code
  $("#transaction_form").on('change','#acc_desc',function(){
      var account_code=$('#acc_desc').find(':selected').val();
      var detail=$('#acc_desc').find(':selected').attr("data-name");
      // console.log(detail);
      $('#select2-acc_desc-container').html(account_code);
      $('#detail').val(detail);
  });
  //on chAnge account code
  $("#transaction_form").on('change','.acc_desc',function(){
      var target = event.target || event.srcElement;
      var id = target.id;
      var id = id.split("-");
      id=id[1];
      var id = id.split("acc_desc");
      id=id[1];
      var account_code=$('#acc_desc'+id).find(':selected').val();
      var detail=$('#acc_desc'+id).find(':selected').attr("data-name");
      $('#select2-acc_desc'+id+'-container').html(account_code);
      $('#detail'+id).val(detail);
      var Co_code = $('#company_code').val();
      // item detail  dropdown
      $.ajax({
          url: '../../api/inventory_management/transactions/local_purchase_api.php',
          type: 'POST',
          data: {action: 'item_detail',item_code:account_code, company_code:Co_code},
          dataType: "json",
          success: function(data){
              console.log(data);
              $('#um').val(data.UNIT_DESC);
              // $('#pack_qty').html(data.pack_qty);
              $('#contain').val(data.pack_qty);
              $('#packing').val(data.pack_name);

              $('#pack_h'+id).val(data.pack_name);
              $('#um_h'+id).val(data.UNIT_DESC);
              $('#contain_h'+id).val(data.pack_qty);
              $('#rent_rt'+id).val(data.rent_rate);
          },
          error: function(error){
              console.log(error);
              alert("Contact IT Department");
          }
      });
  });
  $("#transaction_form").on('click','.detail',function(){
      var button_id = $(this).attr("id");
      if(button_id =='detail'){
        var item_id='';
      }else{
        var itemid = button_id.split("il");
        var item_id=itemid[1];
      }
      var acc_des=$('#acc_desc'+item_id).val();
      console.log(acc_des);
      if(acc_des=='' || acc_des==null){
        $('#packing').val('');
        $('#um').val('');
        $('#contain').val('');
      }else{
      var Co_code = $('#company_code').val();
      // item detail  dropdown
      $.ajax({
          url: '../../api/inventory_management/transactions/local_purchase_api.php',
          type: 'POST',
          data: {action: 'item_detail',item_code:acc_des, company_code:Co_code},
          dataType: "json",
          success: function(data){
              console.log(data);
              $('#um').val(data.UNIT_DESC);
              // $('#pack_qty').html(data.pack_qty);
              $('#contain').val(data.pack_qty);
              $('#packing').val(data.pack_name);

              $('#pack_h'+item_id).val(data.pack_name);
              $('#um_h'+item_id).val(data.UNIT_DESC);
              $('#contain_h'+item_id).val(data.pack_qty);
              $('#rent_rt'+item_id).val(data.rent_rate);
          },
          error: function(error){
              console.log(error);
              alert("Contact IT Department");
          }
      });
      }
        
  });
  
});
$('#example1').ready(function(){
  var i = 0;
  $('.add').click(function(){
    var company_code=$('#company_code').val();
      i++;
      var acc_desc = $('#acc_desc').val();
      var detail = $("#detail").val();
      var rent_rt = $("#rent_rt").val();
      var quantity = $("#quantity").val();
      var pack_h = $("#pack_h").val();
      var um_h = $("#um_h").val();
      var contain_h = $("#contain_h").val();
      var rates = $("#rate").val();
      rate = rates.replaceAll(',','');
      var excl_amts = $("#excl_amt").val();
      excl_amt = excl_amts.replaceAll(',','');
      var stxs = $("#stx").val();
      stx = stxs.replaceAll(',','');
      var stx_amts = $("#stx_amt").val();
      stx_amt = stx_amts.replaceAll(',','');
      var incl_amts = $("#incl_amt").val();
      incl_amt = incl_amts.replaceAll(',','');
      var trade_discs = $("#trade_disc").val();
      trade_disc = trade_discs.replaceAll(',','');
      var amounts = $("#amount").val();
      amount = amounts.replaceAll(',','');
      if(acc_desc == null){
          $('#msg').text("Account can't be the null.");
      }else if(quantity == ""){
          $('#msg').text("Quantity can't be the null.");
      }else if(rates == "" || rates =='0' || rates=='0.00'){
          $('#msg').text("Rate can't be the null.");
      }else if(amount <= 0){
          $('#msg').text("Amount can't be the null.");
      }else{
          $('#msg').text("");
          
          // values empty
          $("#amount").val('0');
          $("#trade_disc").val('0');
          $("#incl_amt").val('0');
          $("#stx_amt").val('0');
          $("#stx").val('0');
          $("#excl_amt").val('0');
          $("#quantity").val('');
          $("#rate").val('');
          $("#rent_rt").val('');
          $("#detail").val('');
          $("#pack_h").val('');
          $("#um_h").val('');
          $("#contain_h").val('');

          $('#d_items tr:last').before('<tr id="tr'+i+'"><td><select name="acc_desc[]" id = "acc_desc'+i+'" class="form-control js-example-basic-single acc_desc" ></td><td><input name="detail[]" id = "detail'+i+'" class="form-control form-control-sm detail" readonly></td><td><input style="font-size:.75rem" name="rent_rt[]" id = "rent_rt'+i+'" class="form-control rent_rt" readonly></td><td><input type="number" name="quantity[]" id = "quantity'+i+'" class="form-control form-control-sm quantity"></td><td><input pattern="[0-9 ,.]{1,}" type="text" name="rate[]" id = "rate'+i+'"  class="form-control form-control-sm rate"></td><td><input type="text" name="excl_amt[]" id = "excl_amt'+i+'" class="form-control form-control-sm excl_amt" readonly></td><td><input pattern="[0-9 ,.]{1,}" type="text" name="stx[]" id = "stx'+i+'" class="form-control form-control-sm stx"></td><td><input type="text" name="stx_amt[]" id = "stx_amt'+i+'" class="form-control form-control-sm stx_amt" readonly></td><td><input type="text" name="incl_amt[]" id = "incl_amt'+i+'" class="form-control form-control-sm incl_amt" readonly></td><td><input  pattern="[0-9 ,.]{1,}" type="text" name="trade_disc[]" id = "trade_disc'+i+'" class="form-control form-control-sm trade_disc" ></td><td><input type="text" name="amount[]" id = "amount'+i+'" class="form-control form-control-sm amount" readonly></td><td><button type = "button" id="'+i+'" class="btn btn-sm btn-danger remove"><b>X<b></button></td><td style="display:none"><input type="text" name="pack_h[]" id = "pack_h'+i+'" class="form-control form-control-sm pack_h"></td><td style="display:none"><input type="text" name="um_h[]" id = "um_h'+i+'" class="form-control form-control-sm um_h"></td><td style="display:none"><input type="text" name="contain_h[]" id = "contain_h'+i+'" class="form-control form-control-sm contain_h"></td></tr>');
          
          // Item code dropdown
          $.ajax({
              url: '../../api/inventory_management/transactions/local_purchase_api.php',
              type: 'POST',
              data: {action: 'item_code',company_code:company_code},
              dataType: "json",
              success: function(response){
                  $('#acc_desc').html('');
                  $('#acc_desc').append('<option value="" selected disabled>Select Account</option>');
                  $.each(response, function(key, value){
                      $('#acc_desc').append('<option data-name="'+value["DESCR"]+'"  data-code='+value["ACCOUNT_CODE"]+' value='+value["ACCOUNT_CODE"]+'>'+value["ACCOUNT_CODE"]+' - '+value["DESCR"]+'</option>');
                  });
              },
              error: function(error){
                  console.log(error);
                  alert("Contact IT Department");
              }
          });  
                // ACCOUNT code dropdown
                $.ajax({
                    url: '../../api/inventory_management/transactions/local_purchase_api.php',
                    type: 'POST',
                    data: {action: 'item_code',company_code:company_code},
                    dataType: "json",
                    success: function(response){
                        $('#acc_desc'+i).html('');
                        $('#acc_desc'+i).addClass('js-example-basic-single');
                        $('.js-example-basic-single').select2();
                        $('#acc_desc'+i).append('<option value="" selected disabled>Select Account</option>');
                        // var j=1;
                        $.each(response, function(key, value){
                            $('#acc_desc'+i).append('<option data-name="'+value["DESCR"]+'"  data-code='+value["ACCOUNT_CODE"]+' value='+value["ACCOUNT_CODE"]+'>'+value["ACCOUNT_CODE"]+' - '+value["DESCR"]+'</option>');
                            if(value["ACCOUNT_CODE"]== acc_desc){
                              acc_desc= value["ACCOUNT_CODE"];
                              $('#acc_desc'+i+' option[value='+acc_desc+']').prop("selected", true);
                            }
                            
                          });
                    },
                    error: function(error){
                        console.log(error);
                        alert("Contact IT Department");
                    }
                });
                //on chAnge account code
                $("#transaction_form").on('change','#acc_desc',function(){
                    var account_code=$('#acc_desc').find(':selected').val();
                    var detail=$('#acc_desc').find(':selected').attr("data-name");
                    $('#select2-acc_desc-container').html(account_code);
                    $('#detail').val(detail);
                });
              $('#detail'+i+'').val(detail);
              $('#um_h'+i+'').val(um_h);
              $('#pack_h'+i+'').val(pack_h);
              $('#contain_h'+i+'').val(contain_h);
        // console.log($('#contain_h'+i+'').val());
              $('#quantity'+i+'').val(quantity);
              $('#rate'+i+'').val(rates);
              $('#amount'+i+'').val(amounts);
              $('#rent_rt'+i+'').val(rent_rt);
              $('#rent_rt'+i+'').css('text-align','right ');
              $('#excl_amt'+i+'').val(excl_amts);
              $('#excl_amt'+i+'').css('text-align','right ');
              $('#stx'+i+'').val(stxs);
              $('#stx'+i+'').css('text-align','right ');
              $('#stx_amt'+i+'').val(stx_amts);
              $('#stx_amt'+i+'').css('text-align','right ');
              $('#incl_amt'+i+'').val(incl_amts);
              $('#incl_amt'+i+'').css('text-align','right ');
              $('#trade_disc'+i+'').val(trade_discs);
              $('#trade_disc'+i+'').css('text-align','right ');
              $('#quantity'+i+'').css('text-align','right ');
              $('#quantity'+i+'').css('padding','0 13px 0 0');
              $('#rate'+i+'').css('text-align','right ');
              $('#rate'+i+'').css('padding','0 13px 0 0');
              $('#amount'+i+'').css('text-align','right ');
              $('#amount'+i+'').css('padding','0 13px 0 0');
      } 
  });
    
  $('#example1').on('click','.remove', function(){
      var button_id = $(this).attr("id");
      $('#packing').val('');
      $('#um').val('');
      $('#contain').val('');
      var excl_remove_amount = $('#excl_amt'+button_id+'').val();
          excl_remove_amount = excl_remove_amount.replaceAll(',','');
      var stx_remove_amount = $('#stx_amt'+button_id+'').val();
          stx_remove_amount = stx_remove_amount.replaceAll(',','');
      var net_remove_amount = $('#amount'+button_id+'').val();
          net_remove_amount = net_remove_amount.replaceAll(',','');
      var current_amount = $('#total').text();
      current_amount = current_amount.replaceAll(',','');
      var total_net_amount = parseFloat(current_amount) - parseFloat(net_remove_amount);
      if(isNaN(total_net_amount)){
        total_net_amount='0';
      }else{
      }
      $('#tr'+button_id+'').remove();

      var current_amount = $('#total').text();
      current_amount = current_amount.replaceAll(',','');
      var total_amount = parseFloat(current_amount) - parseFloat(net_remove_amount);
      if(isNaN(total_amount)){
        total_amount='0';
      }else{
            var total=new Intl.NumberFormat(
            'en-US', { style: 'currency', 
              currency: 'USD',
            currencyDisplay: 'narrowSymbol'}).format(total_amount);
            var total_net=total.replace(/[$]/g,'');
      }
      $('#total').text(total_net);

      var current_stx_amount = $('#stx_total').text();
      current_stx_amount = current_stx_amount.replaceAll(',','');
      var total_amount_stx = parseFloat(current_stx_amount) - parseFloat(stx_remove_amount);
      if(isNaN(total_amount_stx)){
        total_amount_stx='0';
      }else{
            var total_stax=new Intl.NumberFormat(
            'en-US', { style: 'currency', 
              currency: 'USD',
            currencyDisplay: 'narrowSymbol'}).format(total_amount_stx);
            var total_stax=total_stax.replace(/[$]/g,'');
      }
      $('#stx_total').text(total_stax);

      var current_excl_amount = $('#excl_total').text();
      current_excl_amount = current_excl_amount.replaceAll(',','');
      var total_excl_amount = parseFloat(current_excl_amount) - parseFloat(excl_remove_amount);
      if(isNaN(total_excl_amount)){
        total_excl_amount='0';
      }else{
            var total_exl=new Intl.NumberFormat(
            'en-US', { style: 'currency', 
              currency: 'USD',
            currencyDisplay: 'narrowSymbol'}).format(total_excl_amount);
            var total_exl=total_exl.replace(/[$]/g,'');
      }
      $('#excl_total').text(total_exl);




  });
});
      
$("#transaction_form").on("submit", function (e) {
      if ($("#transaction_form").valid()) {
        var rowCount = $("#example1 tr").length;
        var total=parseInt($('#total').html());
        var excl_total=parseInt($('#excl_total').html());
        var stx_total=parseInt($('#stx_total').html());
        // var quantity=parseInt($('#quantity').val());
        var rate=parseInt($('#rate').val());
        var amount=parseInt($('#amount').val());
        if(rowCount > 3){
          if(quantity == '' && rate == '' || isNaN(rate) && amount == '0' || amount=='0.00'){
          
            e.preventDefault();
            var formData = new FormData(this); 
            formData.append('action','insert');
            // formData.append('quantity',quantity);
            formData.append('excl_total',excl_total);
            formData.append('stx_total',stx_total);
            formData.append('net_total',total);
            $.ajax({
                url: '../../api/inventory_management/transactions/local_purchase_api.php',
                type: 'POST',
                data: formData,
                contentType: false,
                cache: false,
                processData:false,
                success: function (response) {
                    var message = response.message;
                    var status = response.status;
                    var doc_no = response.doc_no;
                    var lot_status = response.lot_status;
                    if(status == 0){
                      $("#msg").html(message);
                    }else{
                        window.location.href='local_purchase.php';
                        sessionStorage.setItem("message", message);
                        sessionStorage.setItem("doc_no", doc_no);
                        sessionStorage.setItem("status", status);
                        sessionStorage.setItem("lot_status", lot_status);
                    }
                },
                error: function(e) 
                {
                    console.log(e);
                }   
            });
          }else{
            $("#msg").html("Click on Add Row otherwise the last Row will not be count");
          }
        }else{
            $("#msg").html("Please Insert Some Data");
        }
    }
});

// ===== for total amount in table==== 
// function final1() {
//       var td = document.getElementsByClassName('total');
//       var total_td = 0;
//       for (i = 0; i < td.length; i++) {
//         if (td[i].value == "" ){
//           continue;
//         } 
//         total_td += parseInt(td[i].value);
//         var target = event.target || event.srcElement;
//         var id = target.id;
//         var amountid = id.split("t");
//         amount_id=amountid[1];
//         var amunt=td[i].value.toLocaleString()+'.00';
//         $('#amount'+amount_id).text(amunt);
//       }
//       amount=total_td.toLocaleString()+'.00';
//       document.getElementById("total").innerText = amount;
//       $('#debit').html(total_td);
//       // document.getElementById("debit").innerText = total_td;
//       document.getElementById("debit").value = total_td;
// }

// function final(){
//     var quantity0 = document.getElementById('quantity').value;
//     quantity = quantity0.replace(/[^\d\,\.]/g, '');  
//     let commaNotation_q = /^\d+(\.\d{3})?\,\d{2}$/.test(quantity);
//     quantity = commaNotation_q ?
//     Math.round(parseFloat(quantity0.replace(/[^\d\,]/g, '').replace(/,/, '.'))) :
//     Math.round(parseFloat(quantity0.replace(/[^\d\.]/g, '')));
//     var rate0 = document.getElementById('rate').value;
//     rate = quantity0.replace(/[^\d\,\.]/g, '');  
//     let commaNotation_r = /^\d+(\.\d{3})?\,\d{2}$/.test(rate);
//     rate = commaNotation_r ?
//     Math.round(parseFloat(rate0.replace(/[^\d\,]/g, '').replace(/,/, '.'))) :
//     Math.round(parseFloat(rate0.replace(/[^\d\.]/g, '')));
//     var amount=quantity*rate;
//     if(isNaN(amount)){
//       amount='0';
//     }else{
//       var amount=new Intl.NumberFormat(
//       'en-US', { style: 'currency', 
//         currency: 'USD',
//       currencyDisplay: 'narrowSymbol'}).format(amount);
//       var amount=amount.replace(/[$]/g,'');
//       var  show_amount=amount;
//     }
//     $('#amount').val(show_amount);

// }

</script>

<?php include "../../footer.php" ?>
 

</body>

</html>