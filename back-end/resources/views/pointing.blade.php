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
 border: 1px solid black;
 text-align: center;
 font-size: 15px;
}

tr:nth-child(even) {background-color: #f2f2f2;}

h1,h2{
  text-align: center;
}
</style>

</head>

<body>
 



    <h1>Pointage mois {{$month}}</h1>
    <h2>Chantier {{$branch->name}}</h2> 
<br>
    <table class="table table-dark"  >
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nom & prénom</th>
      <th scope="col">Fonction</th> 

     @for ($i = 1; $i <=$totalDays; $i++)
        <th scope="">{{ $i  }}</th> -->
     @endfor 

      <th scope="col">Total jour(s)</th>
      <th scope="col">Prix jour</th>
      <th scope="col">Avance</th> 
      <th scope="col">Total</th> 
      <th scope="col">Remark</th> 
    </tr>
  </thead>
  <tbody>
    

        @foreach($presence as $item => $value)
 
       <tr>
              <!-- <li>{{ $item }} == {{ $loop->iteration }}  -->
              @foreach($value as $item_second)
                             <td> 
                                @if ($item_second=='0X0')
                                  
                                @elseif($item_second=='0-0')
                                   -
                                @else  
                                  {{$item_second}}
                                @endif
                             </td>
                             
              @endforeach 
           
      </tr>

        @endforeach


  </tbody>
</table>
 
 


<br>
<br>

<table border="1" style="width: 20%;">
  <tr> <td> -</td>  <td> Present</td>   </tr>
  <tr> <td> </td>  <td> Absent</td>   </tr>
</table>

 
<script>
 
</script>
</body>

</html>