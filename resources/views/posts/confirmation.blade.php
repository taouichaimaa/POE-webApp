@extends('layouts.app')
@section('content')


@if(!empty($successmsg))
<div class="alert alert-success"> {{ $successmsg }}
 <p>The transaction ID is {{ $dataToReturn['transaction_id']}}.</p>
</div>
@endif
 
 

<table class="table">
  <tbody>
    <tr>
      <th scope="row">Publisher's Name</th>
      <td>  {{ $dataToReturn['name'] }}  </td>
    </tr>
    <tr>
      <th scope="row">Phone</th>
      <td>  {{ $dataToReturn['phone'] }} </td>
    </tr>
    <tr>
      <th scope="row">Email</th>
      <td>  {{ $dataToReturn['email'] }}  </td>
    </tr>
     <tr>
      <th scope="row">Message</th>
      <td>  {{ $dataToReturn['message'] }}  </td>
    </tr>
    <tr>
      <th scope="row">IP adr</th>
      <td>  {{ $dataToReturn['userip'] }}  </td>
    </tr>
     <tr>
      <th scope="row">File Signature</th>
      <td>  {{ $dataToReturn['signature'] }}  </td>
    </tr>
     <tr>
      <th scope="row">Confirmations</th>
      <td>  {{ $dataToReturn['confirmations'] }}  </td>
    </tr>
     <tr>
      <th scope="row">BlockHash</th>
      <td>  {{ $dataToReturn['blockhash'] }}  </td>
    </tr>
     <tr>
      <th scope="row">BlockTime</th>
      <td>  {{ $dataToReturn['blocktime'] }}  </td>
    </tr>
     <tr>
      <th scope="row">Transaction ID</th>
      <td>  {{ $dataToReturn['transaction_id'] }}  </td>
    </tr>
     <tr>
      <th scope="row">Timestamp</th>
      <td>  {{ $dataToReturn['timestamp'] }}  </td>
    </tr>
  </tbody>
</table>

  
    



@endsection
