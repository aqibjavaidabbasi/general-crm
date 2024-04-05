@extends('layouts.app')

@section('page-title', 'Permissions')
@section('content')



    <div class="row">
        <div class="col">
            <div class="card" id="contactList">
                <div class="card-body">
                    <table id="example" class="table nowrap align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col"> # </th>
                                <th scope="col">Module</th>
                                <th scope="col">Permission</th>
                            </tr>
                        </thead>
                        <tbody id="categoryTableBody">
                            @foreach ($permissions as $index => $permission)
                                @php
                                    $parts = explode('_', $permission->name);
                                    $operation = ucfirst($parts[0]);
                                    $moduleName = ucfirst($parts[1]);
                                @endphp

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $moduleName }}</td>
                                    <td>{{ $operation }} {{ $moduleName }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection
