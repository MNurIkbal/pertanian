@extends('layouts.main2')

@section('title')
Dashboard
@endsection

@section('dashboard')
active
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card p-3">
        <h5 class="card-header">Ajax Sourced Server-side</h5>
        <div class="card-datatable text-nowrap">
          <table class="datatables-ajax table table-bordered">
            <thead>
              <tr>
                <th>Full name</th>
                <th>Email</th>
                <th>Position</th>
                <th>Office</th>
                <th>Start date</th>
                <th>Salary</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                </tr>
            </tbody>
          </table>
        </div>
      </div>
</div>
@endsection
