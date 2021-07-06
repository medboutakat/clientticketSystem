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
  font-size: xx-small;
}

tr:nth-child(even) {background-color: #f2f2f2;}

h1{
  text-align: center;
}
</style>

</head>

<body>
 



    <h3>Abonnés</h3>
    
 
    <!-- {{ public_path('foo.jpg') }} -->
<!-- <img src="http://127.0.0.1:8000/api/attachments/1" alt=""> -->
<!-- <img alt="logo" src="{{ public_path('foo.jpg') }}">  -->
<!-- <img alt="logo" src="{{url('api/attachments/1')}}">  -->
 


    <table class="table table-dark">
  <thead>
    <tr>  
      <th scope="col">ORDINAL </th>
      <th scope="col">N° CARTE </th>
      <th scope="col">RERESENTANT </th> 
      <th scope="col">PRENOM </th> 
      <th scope="col">NOM </th> 
      <th scope="col">SEXE </th> 
      <th scope="col">DATE NAISSANCE </th> 
      <th scope="col">LIEU NAISSANCE </th> 
      <th scope="col">CIN </th> 
      <th scope="col">ADRESSE </th> 
      <th scope="col">FONCTION </th> 
      <th scope="col">TELE </th> 
      <th scope="col">EMAIL </th> 
      <th scope="col">N.EDUCATION </th> 
      <th scope="col">INSCRIT AU BUREAU DE VOTE </th> 
    </tr>
  </thead>
  <tbody>

    @foreach($users?? '' as $user) 
  <!-- protected $fillable = ['ordinal','card_number',
        'delegate','first_name','last_name',
        'sexe','birthday','birthplace','cin','adress','function',
        'phone', 'email','education_level','is_member'
     ];  -->

     <tr> 
      <td>{{ $user->ordinal }}</td>
      <td>{{ $user->card_number }}</td>
      <td>{{ $user->delegate }}</td> 
      <td>{{ $user->first_name }}</td> 
      <td>{{ $user->last_name }}</td> 
      <td>{{ $user->sexe }}</td> 
      <td>{{ $user->birthday }}</td> 
      <td>{{ $user->birthplace }}</td> 
      <td>{{ $user->cin }}</td> 
      <td>{{ $user->adress }}</td> 
      <td>{{ $user->function }}</td> 
      <td>{{ $user->phone }}</td> 
      <td>{{ $user->email }}</td> 
      <td>{{ $user->education_level }}</td> 
      <td>{{ $user->is_member }}</td> 
    </tr>

     @endforeach  

  

   
  </tbody>
</table>

<!-- #{{url("attachments")}}  -->
 
<script>
 
</script>
</body>

</html>