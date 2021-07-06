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
h1{
  text-align: center;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {background-color: #f2f2f2;}
</style>

</head>

<body> 
  
   <h1>Etat
      @if ($paymentModes)
      de {{ $paymentModes->name }} 
      @else
       des cheques et effets
      @endif 
      à reporter
  </h1>
 
 
    <table class="table table-dark">
  <thead>
    <tr>
      <!-- <th scope="col">#</th> -->
      <th scope="col">DATE CHEQUE/EFFET</th>
      <th scope="col">DATE DU REPORT</th>
      <th scope="col">TIREUR</th>
      <th scope="col">CLIENT</th>
      <th scope="col">N° CHEQUE/EFFETS</th>
      <th scope="col">BANQUE</th>
      <th scope="col">MONTANT</th>
      <th scope="col">MODE DE PAIEMENT</th>
    </tr>
  </thead>
  <tbody>

    @foreach($checkBanks?? '' as $checkBank)
      

     <tr>
      <!-- <th scope="row">1</th> -->
     <td>{{ \Carbon\Carbon::parse($checkBank->reception_date)->format('d/m/Y')}}</td>
      <td>{{ \Carbon\Carbon::parse($checkBank->report_date)->format('d/m/Y') }}</td>
      <td>{{ $checkBank->customer_name }}</td> 
      <td>{{ $checkBank->payer_name }}</td> 
      <td>{{ $checkBank->check_number }}</td> 
      <td>{{ $checkBank->bank_name }}</td> 
      <td>{{ $checkBank->amount }}</td> 
      <td>{{ $checkBank->encasment_modes_name }}</td> 
    </tr>

        @endforeach  

        <tr>
      <!-- <th scope="row">1</th> -->
     <td></td>
      <td></td>
      <td></td> 
      <td></td> 
      <td></td> 
      <td></td> 
      <td>Total</td> 
      <td>{{ $total }}</td> 
    </tr>
   
  </tbody>
</table>



</body>

</html>