@extends('backend.layout.base')

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4>{{ $title }}</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ Helper::apk()->app_name }}</a></li>
                    <li class="breadcrumb-item active"><a href="javascript: void(0);">{{ $title }}</a></li>

                </ol>
            </div>
        </div>
        {{-- <div class="col-sm-6">
            <div class="state-information d-none d-sm-block">
                <div class="state-graph">
                    <div id="header-chart-1"></div>
                    <div class="info">Balance $ 2,317</div>
                </div>
                <div class="state-graph">
                    <div id="header-chart-2"></div>
                    <div class="info">Item Sold 1230</div>
                </div>
            </div>
        </div> --}}
    </div>
    <div class="row">
        <div class="col-12">
            <div class="row">
                @forelse ($tahun as $ta)
                    @php
                        $penilaian_guru = DB::table('penilaian_guru')
                            ->where('id_user', Auth::user()->id)
                            ->where('tahun', $ta->tahun)
                            ->count();
                        $nilai = DB::table('penilaian_guru')
                            ->where('id_user', Auth::user()->id)
                            ->where('tahun', $ta->tahun)
                            ->sum('nilai');
                        $hasilNilai = number_format($nilai / $penilaian_guru);
                    @endphp
                    <div class="col-md-3">
                        <div class="card border-primary mb-3">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <div class="p-2">Penilaian Pegawai Tahun {{ $ta->tahun }}</div>
                                </div>
                            </div>
                            <div class="card-body text-primary">
                                <table class="table table-striped">
                                    <tbody>

                                        <tr>
                                            <td>Nama</td>
                                            <td>: <span id="nm-siswa"><?php echo Auth::user()->full_name; ?></span></td>
                                        </tr>
                                        <tr>
                                            <td>Performa</td>
                                            <td>: <span id="nm-siswa"><?php echo $hasilNilai; ?>%</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
    <!-- end col -->
    </div>
@endsection
