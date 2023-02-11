@extends('layout')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Booking</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Upcoming Booking</li>
    </ol>
    <div class="row">
        <div class="container">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Appoinmet_id</th>
                    <th>Slot</th>
                    <th>Start Date&time</th>
                    <th>End Date&time</th>
                    <th>User name</th>
                    <th>Vichle number</th>
                </thead>
                <tbody>
                    @foreach ($bookings as $key=> $booking)
                    <tr>
                        <td>{{ $key+1 }}</td>
                      <td>{{ $booking->appoinment_id }}</td>  
                      <td>{{ $booking->slot->name }}</td>  
                      <td>{{ $booking->appoinment_start }}</td>  
                      <td>{{ $booking->appoinment_end }}</td>
                      <td>{{ $booking->user->name }}</td>   
                      <td>{{ $booking->vehicle_number }}</td>  
                      <tr>
                    @endforeach
                    @if ( $bookings->count()<1)
                    <tr><td colspan="6"><p class="text-center py-5">No Upcoming booking<p><td></tr>
                    @endif
                   
                 
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection