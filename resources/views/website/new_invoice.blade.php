<?php 
error_reporting(1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Invoice</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>

<style>
     .invoice{max-width: 283px;margin: 0 auto;box-shadow: 0 0 10px silver;padding: 10px;}
    h1,h2,h5,h4,p,span,td{font-family:'Roboto', sans-serif;}
    h1,h4{font-weight: 600;color: #4a4a4a;}
    h5{margin: 0;color: #4a4a4a;}
    span{color: #4d7fd4;font-size: 15px;}
    p{font-weight: normal;font-size: 14px;margin-top: 0px;margin-bottom: 4px;}
    h3{font-weight: 700;}
    hr {
    margin-top: 1rem;
    margin-bottom: 1rem;
    border: 0;
    border-top: 1.5px solid #4d7fd4;
}
.bottom-heading p,h5{font-size: 16px;}
.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #75849226;
    border-top: 2px solid #75849226!important;
}
th{padding:0px!important;}
th span{font-size: 10px;}
.table td, .table th {
    padding: .75rem;
    vertical-align: top;
    border-top: none!important;
}
.customer-detail{text-align: left;}
td{font-size: 10px;padding: 5px 0 0 10px!important;}
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
    <div class="invoice">
        <div class="heading">
    
           <center> <h2 style="margin-top: 10px;
            margin-bottom: 10px;">THE MEAT EMPIRE</h2>
            <p>A Unit of Store to Door Foods LLP</p>
            <p>GST # 09AEEFS9730H1ZN</p>
            <p>Contact: 9311845200 / 9311845300</p></center>
   

   </div>


   <div class="customer-detail" style="padding: 30px 0 0px 0;">

          <center>  <p><span>Customer ID</span> &nbsp;&nbsp;#MET{{$order[0]->customerId}}</p>
            
            <p><span>Address</span> &nbsp;&nbsp;{{$order[0]->address}}</p>
           
            <p><span>Invoice No</span> &nbsp;&nbsp;{{$order[0]->order_id}}</p>
 
            <p><span>Invoice Date</span> &nbsp;&nbsp;{{date('d/m/yy h:i:s a',strtotime($order[0]->bokDate))}}</p></center>  
       
   </div>
   <!-- <hr class="container" style="width:">-->
   <table class="table" style="padding: 30px 0 0px 0;">
    <thead>
      <tr>
          <th><span>Product Name</span></th>
          <th><span>Quantity</span></th>
          <th><span>Cut Inst</span></th>
          <th><span>Count</span></th>
          <th><span>MRP</span></th>
          <th ><span>Tax</span></th>
          <th><span>Line Total</span></th>
        </tr>
      </thead>
      <tbody>
        
<?php 
foreach ($productPrice as $keyprice=>$productPriceVal){
 if($productPriceVal['fresh'][0]->id){
?>
    <tr>
          <td>{{$productPriceVal['fresh'][0]->service_name}}</td>
          <td>{{$productPriceVal['fresh'][0]->quantity}} {{$productPriceVal['fresh'][0]->quantity_type}}</td>
          <td>{{$productPriceVal['cuttingInst']}}</td>
          <td>{{$productPriceVal['count']}}</td>
          <td>{{$productPriceVal['fresh'][0]->price}}</td>
          <td>
@if($productPriceVal['tax'])
 {{$productPriceVal['tax']}}
@else
0
@endif         

           %</td>
          <td>{{$productPriceVal['fresh'][0]->price}}</td>
        </tr>   
<?php
 }else{
  ?>
  <tr>
          <td>{{$productPriceVal['deal'][0]->foodName}}</td>
          <td>{{$productPriceVal['deal'][0]->quantity}} {{$productPriceVal['deal'][0]->quantity_type}}</td>
          <td>N/A</td>
          <td>{{$productPriceVal['count']}}</td>
          <td>{{$productPriceVal['deal'][0]->price}}</td>
          <td>N/A</td>
          <td>{{$productPriceVal['deal'][0]->price}}</td>
        </tr>

<?php
}
}
?>
        <tr>
        <td style="border-top: none!important;text-align: right;" colspan="6">Subtotal</td>
            <td style="border-bottom: 1.5px solid #dee2e6!important;">Rs {{$order[0]->total_amount}}</td>
        </tr>
        <tr>
            <td colspan="6" style="text-align: right;">GST</td> 
          
            <td style="border-bottom: 1.5px solid #dee2e6!important;">0</td>
        </tr>
        <tr>
           
            <td colspan="6" style="text-align: right;">Discount</td>
            <td style="border-bottom: 1.5px solid #dee2e6!important;">
             @if($order[0]->total_off>0)
             <?php  $off=$order[0]->total_off;?>
           @else
              <?php  $off=0;?>
           @endif
           {{$off}}</td>
        </tr>

       

          <tr>
            <td colspan="6" style="text-align: right;">Delivery Charges</td>
            <td style="border-bottom: 1.5px solid #dee2e6!important;">
Free
            </td>
        </tr>
       
        <tr>
           
            <td colspan="6" style="text-align: right;"><span>Total</span></td>
            <td style="border-bottom: 1.5px solid #dee2e6!important;">Rs {{$order[0]->total_amount}}</td>
        </tr>
        </tbody>
    </table>
    <div class="bottom-heading">
    
        <center><p>Thank you for choosing</p>
        <h5><b>MEAT EMPIRE</b></h5>
        <p>Have a nice day...</p></center>
    
      </div>
    </div>

</body>
</html>
