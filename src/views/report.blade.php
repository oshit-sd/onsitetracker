<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Time Tracker Reports</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="col-12 my-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Time Tracking Reports</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th style="width:50px" class="text-center">SL</th>
                                <th>Name</th>
                                <th>Mobile No</th>
                                <th>Email</th>
                                <th class="text-center">Time</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $key => $item)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td>{{ $item->user->name ?? 'Unknown User' }}</td>
                                    <td>{{ $item->user->mobile_no ?? '' }}</td>
                                    <td>{{ $item->user->email ?? '' }}</td>
                                    <td class="text-center"><b>{{ $item->times }}</b></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- pagination --}}
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
</body>

</html>
