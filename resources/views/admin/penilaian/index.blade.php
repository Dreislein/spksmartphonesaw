@extends('layouts.app')
@section('title', 'SPK SAW | Penilaian Alternatif')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#tambahpenilaian" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Penilaian Alternatif</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="tambahpenilaian">
                <div class="card-body">
                    @if(Session::has('msg'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <strong>Info!</strong> {{ Session::get('msg') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <form action="{{ route('penilaian.store') }}" method="post">
                            @csrf
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama Alternatif</th>
                                        @foreach($kriteria as $key => $value)
                                            <th>{{ $value->nama_kriteria }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($alternatif as $alt => $valt)
                                        <tr>
                                            <input type="hidden" name="alternatif_id[]" value="$valt->id">
                                            <td>{{ $valt->nama_alternatif }}</td>
                                            @if(count($valt->penilaian) > 0)
                                                @foreach($kriteria as $key => $value)
                                                <td>
                                                    <select name="crips_id[ {{ $valt->id }} ][]" class="form-control">
                                                        @foreach($value->crips as $k_1 => $v_1)
                                                            <option value="{{ $v_1->id }}" {{ $v_1->id == $valt->penilaian[$key]->crips_id ? 'selected' : '' }}>{{ $v_1->nama_crips  }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                @endforeach
                                            @else
                                                @foreach($kriteria as $key => $value)
                                                <td>
                                                    <select name="crips_id[ {{ $valt->id }} ][]" class="form-control">
                                                        @foreach($value->crips as $k_1 => $v_1)
                                                            <option value="{{ $v_1->id }}">{{ $v_1->nama_crips  }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                @endforeach
                                            @endif
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>
                                                Tidak ada data
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-sm btn-primary float-right">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection