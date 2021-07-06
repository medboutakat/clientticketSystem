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
h1{
  text-align: center;
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
      impayes
  </h1>
 

 
    <table class="table table-dark">
  <thead>
    <tr>
      <!-- <th scope="col">#</th> -->
      <th scope="col">DATE CHEQUE</th>
      <th scope="col">DATE IMPAYE </th>
      <th scope="col">TIREUR/TIRE</th>
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
          <td>{{ \Carbon\Carbon::parse($checkBank->reception_date)->format('d/m/Y')}}</td>
          <td>{{ \Carbon\Carbon::parse($checkBank->unpaid_date)->format('d/m/Y') }}</td>
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
      <td>Total</td> 
      <td>{{ $total }}</td> 
      <td></td> 
    </tr>
  
   
  </tbody>
</table>



</body>

</html>