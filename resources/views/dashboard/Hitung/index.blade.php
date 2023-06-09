@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Perhitungan Metode SMART</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Kriteria</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Kriteria</th>
                        <th>Jenis</th>
                        <th>Bobot</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kriteria as $c)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $c->kode_kriteria }}</td>
                        <td>{{ $c->kriteria }}</td>
                        <td>{{ $c->jenis }}</td>
                        <td>{{ $c->bobot_kriteria }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-center"><b>Total</b></td>
                        <td>{{ $total_bobot }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Normalisasi Data Kriteria</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Kriteria</th>
                        <th>Jenis</th>
                        <th>Bobot</th>
                        <th>Normalisasi</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < sizeof($kriteria); $i++) <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $kriteria[$i]->kode_kriteria }}</td>
                        <td>{{ $kriteria[$i]->kriteria }}</td>
                        <td>{{ $kriteria[$i]->jenis }}</td>
                        <td>{{ $kriteria[$i]->bobot_kriteria }}</td>
                        <td>{{ number_format($normalisasi[$i], 2, '.', ',') }}</td>
                        </tr>
                        @endfor
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-center"><b>Total Normalisasi</b></td>
                        <td>{{ number_format($total_normalisasi, 2, '.', ',') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Memberi Nilai Alternatif pada Masing-Masing Kriteria</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Alternatif</th>
                        @foreach ($kriteria as $item)
                        <th scope="row">{{ $item->kode_kriteria }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bobot_alternatif1 as $item1)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item1->alternatif }}</td>
                        @foreach ($item1->subKriteria as $data)
                        <td>{{ $data->sub_kriteria }}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Memberikan Nilai Subkriteria pada masing-masing alternatif</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Alternatif</th>
                        @foreach ($kriteria as $item)
                        <th scope="row">{{ $item->kode_kriteria }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bobot_alternatif1 as $item1)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item1->alternatif }}</td>
                        @foreach ($item1->subKriteria as $data)
                        <td>{{ $data->bobot_sub }}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Menentukan Nilai Utility</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Alternatif</th>
                        @foreach ($kriteria as $item)
                        <th scope="row">{{ $item->kode_kriteria }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @for ($a = 0; $a < sizeof($arr_da); $a++) <tr>
                        <td>{{ $a + 1 }}</td>
                        <td>{{ $arr_da[$a]->alternatif }}</td>
                        @foreach ($utility[$a] as $item)
                        <td>{{ number_format($item, 2, '.', ',') }}</td>
                        @endforeach
                        </tr>
                        @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Menentukan Hasil</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Alternatif</th>
                        @foreach ($kriteria as $item)
                        <th scope="row">{{ $item->kode_kriteria }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @for ($a = 0; $a < sizeof($arr_da); $a++) <tr>
                        <td>{{ $a + 1 }}</td>
                        <td>{{ $arr_da[$a]->alternatif }}</td>
                        @foreach ($hasil[$a] as $item)
                        <td>{{ number_format($item, 2, '.', ',') }}</td>
                        @endforeach
                        </tr>
                        @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Menentukan Hasil Akhir</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Alternatif</th>
                        <th>Hasil Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rangking as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item[0] }}</td>
                        <td>{{ number_format($item[1], 2, '.', ',') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection