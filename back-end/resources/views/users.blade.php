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

h1{
  text-align: center;
}
</style>

</head>

<body>
 



    <h1>Users</h1>
    
 
    {{ public_path('foo.jpg') }}
<!-- <img src="http://127.0.0.1:8000/api/attachments/1" alt=""> -->
<img alt="logo" src="{{ public_path('foo.jpg') }}"> 
<!-- <img alt="logo" src="{{url('api/attachments/1')}}">  -->
 
# 


    <table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>

    @foreach($users?? '' as $user) 

     <tr>
      <th scope="row">1</th>
      <td>{{ $user['name'] }}</td>
      <td>{{ $user['email'] }}</td>
      <td>{{ $user->create_at }}</td> 
    </tr>

     @endforeach  

  

   
  </tbody>
</table>

#{{url("attachments")}} 
 
<script>
 
</script>
</body>

</html>