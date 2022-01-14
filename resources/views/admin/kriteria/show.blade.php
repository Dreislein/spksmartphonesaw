@extends('layouts.app')
@section('title','Crips | '.$kriteria->nama_kriteria)
@section('css')
<!-- Custom styles for this page -->
<link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@stop
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#tambahcrips" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Crips</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="tambahcrips">
                <div class="card-body">
                    @if(Session::has('msg'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <strong>Info!</strong> {{ Session::get('msg') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <form action="{{route('crips.store')}}" method="POST">
                        @csrf
                        <input type="hidden" name="kriteria_id" value="{{$kriteria->id}}">
                        <div class="form-group">
                            <label for="nama">Nama Crips</label>
                            <input type="text" class="form-control @error ('nama_crips') is invalid @enderror" name="nama_crips">
                            @error('nama_crips')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="bobot">Bobot Crips</label>
                            <input type="number" class="form-control @error ('bobot') is invalid @enderror" name="bobot">
                            @error('bobot')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button class="btn btn-sm btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="listcrips">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="DataTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Crips</th>
                                    <th>Bobot</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach($crips as $row)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $row->nama_crips }}</td>
                                    <td>{{ $row->bobot }}</td>
                                    <td>
                                        <form action="{{route('crips.destroy', $row->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('crips.edit' , $row->id) }}" class="btn btn-sm btn-circle btn-warning"><i class="fa fa-edit"></i></a>
                                            <button type="submit" class="btn btn-sm btn-circle btn-danger hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>    
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection