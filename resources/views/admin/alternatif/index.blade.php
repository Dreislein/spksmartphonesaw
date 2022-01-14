@extends('layouts.app')
@section('title', 'SPK SAW | Alternatif')
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#tambahalternatif" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">List Kriteria</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="tambahalternatif">
                <div class="card-body">
                    @if(Session::has('msg'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <strong>Info!</strong> {{ Session::get('msg') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <form action="{{route('alternatif.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama Alternatif</label>
                            <input type="text" class="form-control @error ('nama_alternatif') is invalid @enderror" name="nama_alternatif">
                            @error('nama_alternatif')
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
            <div class="collapse show" id="listkriteria">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="DataTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Alternatif</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach($alternatif as $row)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $row->nama_alternatif }}</td>
                                    <td>
                                        <form action="{{route('alternatif.destroy', $row->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('alternatif.edit' , $row->id) }}" class="btn btn-sm btn-circle btn-warning"><i class="fa fa-edit"></i></a>
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