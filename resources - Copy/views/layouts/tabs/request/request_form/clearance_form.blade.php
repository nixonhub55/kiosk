@extends('layouts.admin')

@section('content')
<style>


      .card-container {
            background-color: #fff; 
            border: 1px solid #ccc;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      }

      .header {
            text-align: center;
            margin-bottom: 20px;
      }

      .logo {
            width: 350px;
            height: auto;
            margin-bottom: 10px;
      }

      h2 {
            margin: 0;
            font-size: 20px;
            text-transform: uppercase;
      }

      table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
      }

      th,
      td {
            border: 1px solid #444;
            padding: 6px;
            vertical-align: top;
      }

      .info-table td {
            border: 1px solid #999;
            height: 28px;
      }

      .certify {
            margin-top: 10px;
            text-align: center;
            font-weight: bold;
            background-color: #eef2f6;
            padding: 8px;
      }

      .signatory-table th {
            background-color: #444;
            color: #fff;
            text-align: center;
      }

      .signatory-table td {
            height: 32px;
      }
</style>
<?php

    $compySettings = session()->get('companyPasswordSettings');
    $compyLogo = $compySettings['companyLogoBlob'];
    $compyName = $compySettings['companyName'];

//     echo json_encode($tin);
//     return;
?>
<div class="container-fluid mt-4 card-container">
      <div class="header">
            <img src="<?=$compyLogo?>" alt="Company Logo" class="logo">
            <h2><b>EMPLOYEE CLEARANCE FORM</b></h2>
      </div>
        <h2><b>TIN: <?php echo $tin[0]->tinNo ?> </b></h2>
      <table class="info-table">

            @php 
            $count = 0; 
            $headerValues = $headerData[0] ?? null; // get the first object
            @endphp

            @if($headerValues)
            <tr>
            @foreach($headers as $header)
                  @php 
                        $key = strtoupper($header->itemName ?? ''); 
                        $value = $headerValues->$key ?? ''; 
                  @endphp
                  <td>
                        <strong>{{ $key }}:</strong> {{ $value }}
                  </td>

                  @php $count++; @endphp
                  @if($count % 3 == 0)
                        </tr><tr>
                  @endif
            @endforeach
            </tr>
            @endif



      </table>


      <div class="certify">
            This is to certify that the above mentioned employee has been cleared of all the accountabilities
            with <?=$compyName?>, Inc. as of the date the clearance was signed by all signatories.
      </div>

      <table class="signatory-table">
            <thead>
                  <tr>
                        <th>DIVISION/DEPARTMENT</th>
                        <th>NAME</th>
                        <th>SIGNATURE</th>
                        <th>DATE SIGNED</th>
                        <th>REMARKS</th>
                        <th>ITEMS</th>
                  </tr>
            </thead>
            <tbody>
                 @foreach($list as $item)
            <tr>
                <td>{{ $item->departmentName ?? '' }}</td>
                <td>{{ $item->cfApproverName ?? '' }}</td>
                <td>{{ $item->cfSignature ?? '' }}</td>
                <td>{{ $item->cfApprovedDateTime ?? '' }}</td>
                <td>{{ $item->cfRemarks ?? '' }}</td>
                <td>{{ $item->cfClearanceItems ?? '' }}</td>
            </tr>
        @endforeach
            </tbody>
      </table>
</div>
@endsection
