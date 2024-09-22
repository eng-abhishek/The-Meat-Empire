<!DOCTYPE html>
<html lang="en">
<head>
  <title>Invoice</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

</head>

<style>
    h1,h4,p,span{font-family:'Roboto', sans-serif;}
    h1,h4{font-weight: 600;color: #4a4a4a;}
    span{color: #4d7fd4;font-size: 18px;}
    p{font-weight: normal;font-size: 14px;margin-top: 10px;}
    h3{font-weight: 700;}
    hr {
    margin-top: 1rem;
    margin-bottom: 1rem;
    border: 0;
    border-top: 1.5px solid #4d7fd4;
}
.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #75849226;
    border-top: none;
}
.table td, .table th {
    padding: .75rem;
    vertical-align: top;
    border-top: none!important;
}

@media(max-width: 414px)
{
    .container{padding: 20px!important;}
    .col-lg-2, .col-lg-6{text-align: left!important;}
    span{font-size: 12px!important;}
    td{font-size: 14px;}
    
}
@media(max-width: 768px)
{
    .container{padding: 10px!important;}
    .col-lg-2, .col-lg-6{text-align: left!important;}
    span{font-size: 16px;}
}

</style>
<body>

    <div class="container" style="padding: 30px 0 0px 0;">
        <div class="row">
            <div class="col-lg-8 col-md-12">
             <h2>The MeatEMpire</h2>
             <h4>Tax Invoice</h4>
            </div>
            <div class="col-lg-2 col-md-12">
            <p>GSTIN<br>09ACVFS7333RIZU</p>
            </div>
            <div class="col-lg-2 col-md-12">
            <p>Shop No : 21-25<br> Mahagun Moderne Mart<br> Sector - 78 <br>Phone no : 0120-428800</p>
            </div>
        </div>
    </div>
    
<?php 
error_reporting(1);
// echo"<pre>";
// echo $order[0]->f_name;
// print_r($order);
// die;
?>


    <div class="container" style="padding: 30px 0 0px 0;">
        <div class="row">
            <div class="col-lg-2 col-md-12">
             <span>Billed To</span>
              <p style="margin-bottom:0px">Customer - {{$order[0]->f_name." ".$order[0]->l_name}} <br> Customer Id - #MET{{$order[0]->customerId}}</p>
             <p>{{$order[0]->address}}<br>{{$order[0]->city}}<br>{{$LansMarkAddress}},{{$order[0]->flat_no}}<br>Phone no : {{$order[0]->email}}</p>
            </div>
            <div class="col-lg-2 col-md-12">
            <span>Date</span>
            <p>{{$order[0]->delDate}}</p>
            </div>
            <div class="col-lg-2 col-md-12">
                <span>Invoice Number</span>
                <p>{{$order[0]->order_id}}</p>       
            </div>
            <div class="col-lg-6 col-md-12 text-right">
                <span>Amount</span>
                <h3><i class="fa fa-inr" aria-hidden="true"></i>{{$order[0]->total_amount}}</h3>
            </div>
        </div>
    </div>
   <!-- <hr class="container" style="width:">-->
  <div class="container" style="padding: 30px 0 0px 0;">
    <div class="table-responsive-sm text-left">         
    <table class="table">
      <thead>
        <tr>
          <th><span>Product Name</span></th>
          <th class="text-right"><span>Quantity</span></th>
          <th class="text-right"><span>Cut Inst</span></th>
       
          <th class="text-right"><span>Count</span></th>
          <th class="text-right"><span>MRP</span></th>
          <th class="text-right"><span>Tax</span></th>
          <th class="text-right"><span>Line Total</span></th>
        </tr>
      </thead>
    
      <tbody>
<?php 
foreach ($productPrice as $keyprice=>$productPriceVal){
 if($productPriceVal['fresh'][0]->id){
?>
    <tr style="border-bottom: 1.5px solid #dee2e6!important;">
          <td><p>{{$productPriceVal['fresh'][0]->service_name}}</p></td>
          <td class="text-right">{{$productPriceVal['fresh'][0]->quantity}} {{$productPriceVal['fresh'][0]->quantity_type}}</td>
          <td class="text-right">{{$productPriceVal['cuttingInst']}}</td>
          <td class="text-right">{{$productPriceVal['count']}}</td>
          <td class="text-right"><i class="fa fa-inr" aria-hidden="true"></i>{{$productPriceVal['fresh'][0]->price}}</td>
          <td class="text-right">
@if($productPriceVal['tax'])
 {{$productPriceVal['tax']}}
@else
0
@endif         

           %</td>
          <td class="text-right"><i class="fa fa-inr" aria-hidden="true"></i>{{$productPriceVal['fresh'][0]->price}}</td>
        </tr>   
<?php
 }else{
  ?>
  <tr style="border-bottom: 1.5px solid #dee2e6!important;">
          <td><p>{{$productPriceVal['deal'][0]->foodName}}</p></td>
          <td class="text-right">{{$productPriceVal['deal'][0]->quantity}} {{$productPriceVal['deal'][0]->quantity_type}}</td>
            <td class="text-right">N/A</td>
            <td class="text-right">{{$productPriceVal['count']}}</td>
          <td class="text-right"><i class="fa fa-inr" aria-hidden="true"></i>{{$productPriceVal['deal'][0]->price}}</td>
          <td class="text-right">N/A</td>
          <td class="text-right"><i class="fa fa-inr" aria-hidden="true"></i>{{$productPriceVal['deal'][0]->price}}</td>
        </tr>

<?php
}
}
?>

        <tr>
           
            <td style="border-top: none!important" colspan="5" class="text-right">Subtotal</td>
            <td style="border-bottom: 1.5px solid #dee2e6!important;" class="text-right"><i class="fa fa-inr" aria-hidden="true"></i>{{$order[0]->total_amount}}</td>
        </tr>
        <tr>
            <td colspan="5" class="text-right" >GST</td> 
          
            <td style="border-bottom: 1.5px solid #dee2e6!important;" class="text-right"><i class="fa fa-inr" aria-hidden="true"></i> 0</td>
        </tr>
        <tr>
           
            <td colspan="5" class="text-right">Discount</td>
            <td style="border-bottom: 1.5px solid #dee2e6!important;" class="text-right"><i class="fa fa-inr" aria-hidden="true"></i> 
           @if($order[0]->total_off>0)
             <?php  $off=$order[0]->total_off;?>
           @else
              <?php  $off=0;?>
           @endif
           {{$off}}</td>
        </tr>
@if($order[0]->expressDelivery)
        <tr>
            <td colspan="5" class="text-right">Express Delivery Charges</td>
            <td style="border-bottom: 1.5px solid #dee2e6!important;" class="text-right">
<i class="fa fa-inr"></i>
{{$order[0]->expressDelivery}}

            </td>
        </tr>
@else

@endif       

          <tr>
            <td colspan="5" class="text-right">Delivery Charges</td>
            <td style="border-bottom: 1.5px solid #dee2e6!important;" class="text-right">
Free
            </td>
        </tr>
       
        <tr>
           
            <td colspan="5" class="text-right"><span>Total</span></td>
            <td style="border-bottom: 1.5px solid #dee2e6!important;" class="text-right"><i class="fa fa-inr" aria-hidden="true"></i>{{$order[0]->total_amount}}</td>
        </tr>
        </tbody>
    </table>
    </div>
  </div>


</body>
</html>
