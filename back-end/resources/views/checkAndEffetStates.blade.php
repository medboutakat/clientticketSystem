 <!doctype html>

<html>

<head>
    <style>
        table {
          border-collapse: collapse;
          width: 100%;
        }

        tbody th,tbody td {
          text-align: left;
          padding: 8px;
          text-align:centre;
        }

        tbody tr:nth-child(even) {background-color: #f2f2f2;}

        #total-id{

        font-family:Arial;
        font-weight:600;


        }
        .total {background-color: silver;

}


        .footer-style{
          margin-bottom:1%;
          margin-left:1%;
        font-size:10px;
        }
        .title2{
          text-align:center;
        }



       
        .titre1{

          border:1px solid black;
          text-align:center;
        }
        .date{
          border:1px solid black;
          text-align:right;
          /* width:250px; */
          float:right;
          font-size:15pt;
          font-family: "Times New Roman", Times, serif;
          padding:2px;
        }

        @page { margin: 200px 50px; }
        #header { position: fixed; left: 0px; top: -200px; right: 0px; height: 150px; text-align: center; }
        #footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 150px; }
        #footer .page:after { content: counter(page, upper-roman); }
</style>

</head>

<body>
<div id="header">
    <h1 class="titre1">Etat des cheques et effets</h1>
    <h3 class="title2">  bordeaureau de remise N° {{$checkState->code}} </h3>
    <h3 class="title2">  Banque: {{$stateBank->name}} </h3>
    <span class="date">Le {{$checkState->date}} </span>
</div>
 <br>
 <br>
 
  <div id="content">
    <table class="table table-dark">
       <thead>
          <tr>
            <!-- <th scope="col">#</th> -->
            <th scope="col">Date d'échéance</th>
            <th scope="col">Client</th>
            <th scope="col">N°chéque</th>
            <th scope="col">Banque</th>
            <th scope="col">Chéques/effets</th>
            <th scope="col">Montant</th>
          </tr>
        </thead>
        <tbody>
        @foreach($checkStateDetails?? '' as $detail)
            

          <tr>
            <!-- <th scope="row">1</th> -->
            
            <td>{{ $detail->payment_deadline_date }}</td> 
            <td>{{ $detail->customer_name}}</td> 
            <td>{{ $detail->check_number }}</td> 
            <td>{{ $detail->bank_name }}</td> 
            <td>{{ $detail->payment_mode_name }}</td> 
            <td>{{ $detail->amount}}</td> 
        
          </tr>

              @endforeach  
        </tbody>
 </table>
 <table>
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
          <td></td> 
          <td class='total'id="total-id">Total :</td> 
          <td class='total' >{{ $checkStateDetails->sum('amount') }} DHS</td>
        </tr> 
        @foreach($checkStateDetailsByPayementId?? '' as $payment)
        <tr>
          <td></td>
          <td></td>
          <td></td> 
          <td></td> 
          <td class='total'id="total-id">{{$payment->payment_mode_name}} :</td> 
            <td class='total'>{{$payment->total}}</td> 
        </tr>
          @endforeach      
  </table>
    </div>
      <div id="footer">

          <p class="footer-style">Générer par 'Mohamed boutakat', Le {{ date('Y-m-d H:i:s') }}</p>

          <p class="page">Page </p>
  
      </div>
    </body>

</html>

