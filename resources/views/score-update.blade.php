@extends('default')

@section('content')

<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Grade', 'Nilai Quiz', 'Nilai Tugas', 'Nilai Absensi', 'Nilai Praktek', 'Nilai UAS'],
                @foreach ($scores as $key=>$score)
                    ['{{$score->nama}}', '{{$score->nilai_quiz}}',
                    '{{$score->nilai_tugas}}', '{{$score->nilai_absensi}}',
                    '{{$score->nilai_praktek}}', '{{$score->nilai_uas}}'],
                @endforeach
            ]);

            var options = {
                chart: {
                    title: 'Mahasiswa Binus',
                    subtitle: 'Nilai tugas',
                }
            };

            var chart = new google.charts.Bar(document.getElementById('myChart'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>
</head>

<body>
    <div class="container mt-5">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2>Input Nilai Mahasiswa</h2>
            </div>
            <div class="panel-body">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif

                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('scores.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-md-12">
                            <div class="col-md-6 form-group">
                                <label>Nama Mahasiswa:</label>
                                <input type="text" name="nama" class="form-control" />
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Nilai Quiz:</label>
                                <input type="number" name="nilai_quiz" class="form-control" min="1" max="100"/>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Nilai Tugas:</label>
                                <input type="number" name="nilai_tugas" class="form-control" min="1" max="100"/>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Nilai Absensi:</label>
                                <input type="number" name="nilai_absensi" class="form-control" min="1" max="100"/>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Nilai Praktek:</label>
                                <input type="number" name="nilai_praktek" class="form-control" min="1" max="100"/>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Nilai UAS:</label>
                                <input type="number" name="nilai_uas" class="form-control" min="1" max="100"/>
                            </div>
                            <div class="col-md-6 form-group">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container" id="myChart" style="width: 800px; height: 500px;"></div>
    <div class="container">

        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>Nilai Quiz</th>
                <th>Nilai Tugas</th>
                <th>Nilai Absensi</th>
                <th>Nilai Praktek</th>
                <th>Nilai UAS</th>
                <th>Action</th>
            </tr>
            @foreach ($scores as $key=>$score)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $score->nama }}</td>
                <td>{{ $score->nilai_quiz }}</td>
                <td>{{ $score->nilai_tugas }}</td>
                <td>{{ $score->nilai_absensi }}</td>
                <td>{{ $score->nilai_praktek }}</td>
                <td>{{ $score->nilai_uas }}</td>
                <td>
                    <form action="{{ route('scores.destroy',$score->id) }}" method="POST">

                        <a class="btn btn-primary" href="{{ route('scores.edit',$score->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</body>
