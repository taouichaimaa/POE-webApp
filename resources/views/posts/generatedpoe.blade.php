@extends('layouts.app')
@section('content')
<table class="table">
	 <thead>
    <tr>
      <th scope="col">Transaction ID</th>
      <th scope="col">Timestamp</th>
      <th scope="col">Confirmations</th>
    </tr>
  </thead>
  <tbody>

@foreach($dataReturn as $d)

<tr>
   <td> {{ $d['tx_id']}}</td>
    <td> {{ $d['blocktime']}}</td>
    <td>{{ $d['confirmations'] }}</td>
 </tr>
  
@endforeach
</tbody>
</table>
@endsection