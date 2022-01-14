@extends('layouts.app')
@section('title', 'Edit Crips | '.$crips->nama_crips)
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#editcrips" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Edit Crips {{ $crips->nama_crips }}</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="editcrips">
                <div class="card-body">
                    @if(Session::has('msg'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <strong>Info!</strong> {{ Session::get('msg') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <form action="{{route('crips.update', $crips->id)}}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="nama">Nama Crips</label>
                            <input type="text" class="form-control @error ('nama_crips') is invalid @enderror" name="nama_crips" value="{{$crips->nama_crips}}">
                            @error('nama_crips')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="bobot">Bobot Crips</label>
                            <input type="number" class="form-control @error ('bobot') is invalid @enderror" name="bobot" value="{{$crips->bobot}}">
                            @error('bobot')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button class="btn btn-sm btn-primary">Save</button>
                        <a href="{{route('kriteria.index')}}" class="btn btn-sm btn-success">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<!-- Page level plugins -->
<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $('#DataTable').DataTable();
    })
</script>
@stop