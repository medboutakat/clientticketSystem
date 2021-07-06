<html>
<head>
  <style>

    .head{
       font-weight: bold;
       text-align:justify;
    }
      #header.title2{
          text-align:center;
        }
        #header .titre1{

          border:1px solid black;
          text-align:center;
        }
        .title3{

          margin-top:-15px; 
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
        .table-title{
          float:right;
        }

        .tablbenif td{
           min-width:250px
        } 
        .bank {
            text-transform: uppercase;
            font-weight: bold;
            text-align:justify;
        }

      span::first-letter { 
            font-weight: bold;
        }
        
      /* .table {
          border-collapse: collapse;
          width: 100%;
        }

        #content  table    tbody th,tbody td {
          text-align: left;
          padding: 8px;
          text-align:centre;
        } */
      

        /* #content  table tbody tr:nth-child(even) {background-color: #f2f2f2;} */
        @page { margin: 150px 90px; }
        #header { position: fixed; left: 0px; top: -170px; right: 0px; height: 160px; text-align: center; }
        #footer { position: fixed; left: 0px; bottom: -140px; right: 0px; height: 80px; text-align: center;}
        /* #footer .page:after { content: counter(page, upper-roman); } */
  </style>
  
<body>



  <div id="header">

    <!-- <img src="{{ public_path('foo.jpg') }}" style="width: 200px; height: 200px"> -->
    <div>
     
        @if ($bankAccount->is_personal)

           <div style="display:block; text-align: left;  height: 120px;">
            <img src="" style="width: 180px; height: 120px;"> 
          </div>  
           <h1 style="display:block; float: left;">{{$bankAccount->full_name}}   </h1>  
        @else 
         
         <div style="display:block; text-align: left;">
            <img src="{{ storage_path('app/public/foo.jpg') }}" style="width: 180px; height: 160px;"> 
          </div> 
        <div style="display:block; float: left;">ENTREPRISE DE GENIE CIVIL ET D’AMENAGEMENT   </div>  

        @endif  


    </div>
  



  </div>

       <hr> 
  <div id="content" >

   <div style="width: 100%; height:130px; "> 
   <div style="width:50%">
   
   </div>
   <div style="float: right; width:50%"> 
    <p class="head">Béni Mellal le {{ \Carbon\Carbon::parse($transfer->date)->format('d-m-Y')}}</p> 
    <p class="head"><h3 class="bank"> {{$bank->name}} </h3></p>
    <p class="head"> {{$bankAccount->agency_adress}}</p>  
   </div>
   </div>
 
  
<h4 style="font-size: 15pt;" class="titre1">Objet: Ordre de virement

  @if ($transfer->express) 
  express -
  @endif
   N°  {{$transfer->code}}</h4>

  <h5 style="font-size: 15pt;" >
   <bold>  Monsieur, Madame </bold>
  </h5>
<p style="font-size: 15pt;" >
  Par, le débit de notre compte  <b>N°{{$bankAccount->account_number}}</b> ouvert auprès de votre agence, nous vous remercions de bien vouloir exécuter un virement  de Dhs  
   <b>{{ number_format($transfer->amount, 2),'-','-'  }}</b>  (  <span class="amount_text">{{ ucfirst($transfer->amount_text)}} dirhams, {{$transfer->amount2}} Cts</span>) selon les coordonnés suivant 

</p>   
   <table class="tablbenif" border="1" style="font-weight: bold; font-size: 15pt; ">
     <tr>
       <td>Bénéficiaire :</td>
       <td>{{$customer->full_name}} </td>
     </tr>
      <tr>
       <td>Banque :</td>
       <td>{{ ucfirst($customerBank ->name) }} </td>
     </tr>
        <tr>
       <td>N°de compte :</td>
       <td>{{$customer->bank_account_no}} </td>
     </tr>
        <tr>
       <td>R.I.B :</td>
       <td>{{$customer->rib}} </td>
     </tr>
   </table> 
   <p style="font-size: 15pt;">
     Dans l’attente, veuillez  accepter, Monsieur, nos respectueuses salutations. 
   </p> 
  </div> 
  <br>
<p  style="text-align: right;  margin-right: 80px;font-size: 15pt;font-weight: bold;">Signature</p>
<br/> 
  @if ($transfer->signed) 
  <div style="display:block; text-align: right; ">
 
            <img src="{{ storage_path('app/public/signatureEGCA.jpg') }}" style="width: 150px; height: 80px;"> 
  </div> 
  @endif


    <div id="footer">
     
     @if (!$bankAccount->is_personal) 
   <hr>   14, Avenue IBN KHALDOUN, Agdal – RABAT – Tél : 0661 32-40-22, 0661 36-04-66, Fax : 05 23 48-97-87 RC : N° Rabat 61273, I.F : 3334326, Patente : 25798156, CNSS : 7039391, ICE 001530991000084.                                                                      
     @endif
   <!-- <p class="page">Page </p> -->
  </div>
</body>
 
</html>