@extends('layout.template')
<!-- START FORM -->
@section('konten') 

<form action='{{ url('mahasiswa/'.$data->matakuliah) }}' method='post'>
@csrf 
@method('PUT')
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <a href='{{ url('mahasiswa') }}' class="btn btn-secondary"><< kembali</a>
    <div class="mb-3 row">
        <label for="matakuliah" class="col-sm-2 col-form-label">matakuliah</label>
        <div class="col-sm-10">
            {{ $data->matakuliah }}
        </div>
    </div>
    <div class="mb-3 row">
        <label for="namadosen" class="col-sm-2 col-form-label">namadosen</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name='namadosen' value="{{ $data->namadosen }}" id="namadosen">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="mengampu" class="col-sm-2 col-form-label">mengampu</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name='mengampu' value="{{ $data->mengampu }}" id="mengampu">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="mengampu" class="col-sm-2 col-form-label"></label>
        <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
    </div>
</div>
</form>
<!-- AKHIR FORM -->
@endsection