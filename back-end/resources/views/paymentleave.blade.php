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
        #header { position: fixed; left: 0px; top: -140px; right: 0px; height: 200px; text-align: center; }
        #footer { position: fixed; left: 0px; bottom: -140px; right: 0px; height: 80px; text-align: center;}
        /* #footer .page:after { content: counter(page, upper-roman); } */

        tr.border_top td {
          border-top: 1px solid black;

          font-weight: bold; font-size: 15pt;
        }

  </style>
  
<body>



  <div id="header">
 

  </div>
 
  <div id="content" >
<p style="text-align: right;">{{ \Carbon\Carbon::parse($leavePayment->date)->format('d-m-Y')}}</p>

  <br>
   <h3 style="text-align: center;"> SOLDE DE TOUT COMPTE </h3>
    <p style="text-align: center;">SOLDE N°  {{$leavePayment->code}}</p>
  

   
<p style="font-size: 15pt;" > 
  Je soussigné Mr <b>N°{{$salary->full_name}}</b>,<b>{{ $salaryCategory->name }} </b> de la nationalité marocaine,tutlaire de la CIN°:{{$salary->cin}} reconnu avoir reçu de la société 
 <b> Ste EGCA</b> SARL AU,sis à 14, Avenue IBN KHALDOUN, Agdal RABAT  <b> la somme de (en chiffre et en lettre ){{ number_format($leavePayment->amount, 2),'-','-'  }}</b> 
   (  <span class="amount_text">{{ ucfirst($leavePayment->amount_text)}} dirhams, {{$leavePayment->amount2}} Cts</span>) 
   <br>
   Représentant tous mes droits après avoir quitté mon travail le : {{ \Carbon\Carbon::parse($leavePayment->date_quit)->format('d-m-Y') }} entant que : 
   <b>{{$salaryCategory->name }}</b>
</p>   

<p>
Le solde de tout compte décompose comme suit :
</p>
   <table class="tablbenif"  >
     <tr>
       <td>Salaire congé :</td>
       <td>{{ number_format($leavePayment->amount, 2),'-','-'  }} Dh.</td>
     </tr>
   <tr>
      <td>Salaire de derniere mois :</td>
       <td>{{ number_format($leavePayment->amount_months, 2),'-','-'  }} Dh.</td>
     </tr>
       <tr>
       <td>Avance :</td>
       <td>{{ number_format($leavePayment->amount_advance, 2),'-','-'  }} Dh.</td>
     </tr>

      <tr  class="border_top">
       <td>Net à payé :</td>
       <td>{{ number_format($leavePayment->amount_total, 2),'-','-'  }} Dh.</td>
     </tr> 
   </table> 
   <br>
   <p style="font-size: 15pt; text-align: center;">
     Fait pour servir et valoir ce que de droit. 
   </p> 
  </div> 
  <br>
<p  style="text-align: left;  margin-right: 80px;font-size: 15pt;font-weight: bold;">Signature de l'intéressé</p>
<p  style="text-align: left;  margin-right: 80px;font-size: 15pt;font-weight: bold;">BENFADOUL HAFID</p>
<br/> 
  @if ($leavePayment->signed) 
  <div style="display:block; text-align: left; "> 
    <img src="{{ storage_path('app/public/signatureEGCA.jpg') }}" style="width: 150px; height: 80px;"> 
  </div> 
  @endif


    <div id="footer">
      
   <!-- <p class="page">Page </p> -->
  </div>
</body>
 
</html>