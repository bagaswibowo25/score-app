@extends('default')

@section('content')

<div class="container mt-5">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h2>Edit Nilai Mahasiswa</h2>
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

            <form action="{{ route('scores.update', $score->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-md-12">
                        <div class="col-md-6 form-group">
                            <label>Nama:</label>
                            <input type="text" name="nama" class="form-control" value="{{$score->nama}}" />
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

