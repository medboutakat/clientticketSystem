<html>
<head>
  <style>
      #header.title2{
          text-align:center;
        }
        #header .titre1{

          border:1px solid black;
          text-align:center;
        }
        .title3{

          margin-top:-15px;
          text-align:centre;
          display:block;
        }
        #header  .date{
          border:1px solid black;
          text-align:right;
          /* width:250px; */
          float:right;
          /* font-size:15pt;
          font-family: "Times New Roman", Times, serif;
          padding:2px; */
          margin-top:-15px;
        }
        .total {background-color: silver;}
        #total-id{

        font-family:Arial;
        font-weight:600;

        }
        /* .table-title{
          float:right;
        } */

        
      .table {
          border-collapse: collapse;
          width: 100%;
        }
 

 th{
      text-align: left;
        
 }
        #content  table  tbody td {
          text-align: left;
          /* padding: 8px; */
          /* text-align:centre; */
        }
      

        #content  table tbody tr:nth-child(even) {background-color: #f2f2f2;}
        @page { margin: 180px 50px; }
        #header { position: fixed; left: 0px; top: -180px; right: 0px; height: 160px; text-align: center; }
        #footer { position: fixed; left: 0px; bottom: -160px; right: 0px; height: 100px;}
        #footer .page:after { content: counter(page, upper-roman); }
  </style>
  
<body>



  <div id="header">
  <h1 class="titre1">Etat 
      @if ($statePaymentMode)
      de {{ $statePaymentMode->name }} 
      @else
       des cheques et effets
      @endif 
  </h1> 
    <h3 class="title2">  bordeaureau de remise N° {{$checkState->code}} </h3>
    <h5 class="title3"> Banque: {{$stateBank->name}} </h5>
    <h5 class="title3">  N° compte: {{$stateAccountBank->account_number}} </h5>
    <h4 scope="col" class="date">Le {{ \Carbon\Carbon::parse($checkState->date)->format('d-m-Y')}}</h4>

  </div>
  <div id="footer">
    <p class="page">Page </p>
  </div>
  <div id="content">
  <table class="table table-dark" >
  <!-- onchange="showresult($paymentId)" -->
       <thead>
          <tr>
            <!-- <th scope="col">#</th> -->
            <th scope="col">Date d'échéance</th>
            <th scope="col">Client</th>
            <th scope="col">N°</th>
            <th scope="col">Banque</th>
            @if(!$statePaymentMode)
            <td scope="col">Chéque/Effet</td> 
            @endif            
            <th scope="col">Montant</th>
          </tr>
        </thead>
        <tbody>
        @foreach($checkStateDetails?? '' as $detail)
            

          <tr>
            <!-- <th scope="row">1</th> -->            
            <td> 
              {{ \Carbon\Carbon::parse($detail->payment_deadline_date)->format('d-m-Y')}}
            </td> 
            <td>{{ $detail->customer_name}}</td> 
            <td>{{ $detail->check_number }}</td> 
            <td>{{ $detail->bank_name }}</td> 
                        
            @if(!$statePaymentMode)
            <td id="hide-column">{{ $detail->payment_modes_check_name }}</td> 
            @endif            
            <td>{{ $detail->amount}}</td> 

          </tr>

              @endforeach  
        </tbody>
        <tfoot>
        <tr>
          <td></td>
          <td></td>
          <td></td> 
          <td></td> 
          <td><br></td> 
          <td ><br></td>
        </tr> 
        <tr>
          <td></td>
          <td></td>
          <td></td> 
            @if(!$statePaymentMode)
             <td></td> 
            @endif 
          <td class='total'id="total-id">Total :</td> 
          <td class='total' >{{ $checkStateDetails->sum('amount') }} DHS</td>
        </tr> 
        @foreach($checkStateDetailsByPayementId?? '' as $payment)
        <tr>
          <td></td>
          <td></td>
          <td></td> 
          
            @if(!$statePaymentMode)
            <td></td>  
            @endif 
            
          <td class='total'id="total-id">{{$payment->payment_modes_check_name}} :</td> 
            <td class='total'>{{$payment->total}}</td> 
        </tr>
          @endforeach    
        </tfoot>
 </table>

  </div>
</body>

<!-- <script>
function showresult($paymentId) {
  if ($paymentId) {
    $("#hide-column").css('display', 'block');
    return;
  }else{
    $("#hide-column").css('display', 'none'); 
    
  } 
}
</script> -->
</html>