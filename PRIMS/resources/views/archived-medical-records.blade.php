@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Archived Medical Records</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID Number</th>
                    <th>Patient Name</th>
                    <th>Reason for Visit</th>
                    <th>Date Archived</th>
                </tr>
            </thead>
            <tbody>
                @foreach($archivedRecords as $record)
                    <tr>
                        <td>{{ $record->apc_id_number }}</td>
                        <td>{{ $record->first_name }} {{ $record->last_name }}</td>
                        <td>{{ $record->reason }}</td>
                        <td>{{ $record->archived_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
