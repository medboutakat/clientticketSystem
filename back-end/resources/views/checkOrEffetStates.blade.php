 <!doctype html>

<html>

<head>

    <!-- Scripts -->

    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

   

    <!-- Styles -->

    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->

    <style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {background-color: #f2f2f2;}

.title2{
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
</style>

</head>

<body>

    <h1>Etat de {{$paymentMode->name}}</h1>

    <h3 class="title2">  bordeaureau de remise N° {{$checkState->code}} </h3>
 
    <span class="date">Le {{$checkState->date}} </span>
 <br>
 <br>
    <table class="table table-dark">
  <thead>
    <tr>
      <!-- <th scope="col">#</th> -->
      <th scope="col">Date d'échéance</th>
      <th scope="col">Client</th>
      <th scope="col">N°chéque</th>
      <th scope="col">Montant</th>
      <th scope="col">Banque</th>
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
      <td>{{ $detail->amount}}</td> 
  
    </tr>

        @endforeach  
        </tbody>
 
 <tfoot>
     <tr>
       <td></td>
       <td></td> 
       <td></td> 
       <td>Total</td> 
       <td>
             @if ($checkBanks) {{ $checkBanks->sum('amount') }}</td>
     </tr>
 </tfoot>
 

</table>



</body>

</html>