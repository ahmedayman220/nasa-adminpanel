@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Dashboard
                    </div>

                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <h3>Team Member Count Distribution</h3>
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Number of Members</th>
                                <th>Number of Teams</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($memberCountCategories as $category => $count)
                                <tr>
                                    <td>{{ $category }}</td>
                                    <td>{{ $count }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <br />
                        <br />
                            <h3>Onsite Team Member Count Distribution</h3>
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Number of Members</th>
                                    <th>Number of Teams</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($OnsiteMemberCountCategories as $category => $count)
                                    <tr>
                                        <td>{{ $category }}</td>
                                        <td>{{ $count }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
