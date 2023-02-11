@extends('layout')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Customer</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Customer list </li>
    </ol>
    <p class="btn btn-primary">Total Amount : Rs.{{ $total }}</p>
    <div class="row">
        <div class="container">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Vehicle Number</th>
                </thead>
                <tbody>
                    
                    @foreach ($customers as $key => $customer )
                        <tr>
                           <td>{{ $key+1 }}</td>
                            <td>{{ $customer->user->name }}</td>
                            <td>{{ $customer->user->email }}</td>
                            <td>{{ $customer->vehicle_number }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection