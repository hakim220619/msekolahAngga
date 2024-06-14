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
                @forelse ($month as $key => $m)
                    <?php
                    // dd($no[$key]);
                        // $numb = 0;
                        // dd(date('Y-') . '6');
                        if ($no[$key] <= 10) {
                            $absen = '';
                           
                                $absen = DB::table('absensi')
                                    ->where('id_user', Auth::user()->id)
                                    ->where('tanggal', 'like', '%' . date('Y-') . '0' . $no[$key] . '%')
                                    ->where('status', 'OUT')
                                    ->count();
                           ?>
                    <div class="col-md-3">
                        <div class="card border-primary mb-3">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <div class="p-2">{{ $m }} {{ date('Y') }}</div>
                                    <div class="ml-auto p-2">Nama: {{ $users->full_name }}</div>
                                </div>
                            </div>

                            <div class="card-body text-primary">
                                <table class="table table-striped">
                                    <tbody>

                                        <tr>
                                            <td>Jumlah Absensi</td>
                                            <td>: <span id="nm-siswa"><?php echo $absen; ?></span></td>
                                        </tr>
                                        <tr>
                                            <td>Nilai Per Jam</td>
                                            <td>: Rp. <?php echo number_format($gajiperjam); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td>: Rp. <?php echo number_format($absen * $gajiperjam); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        &nbsp;
                        &nbsp;
                    </div>
                    <?php  } else {
                            $absen = '';
                            
                                $absen = DB::table('absensi')
                                    ->where('id_user', Auth::user()->id)
                                    ->where('tanggal', 'like', '%'.$no[$key].'%')
                                    ->where('status', 'OUT')
                                    ->count();
                             ?>
                    <div class="col-md-3">
                        <div class="card border-primary mb-3">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <div class="p-2">{{ $m }} {{ date('Y') }}</div>
                                    <div class="ml-auto p-2">Nama: {{ $users->full_name }}</div>
                                </div>
                            </div>

                            <div class="card-body text-primary">
                                <table class="table table-striped">
                                    <tbody>

                                        <tr>
                                            <td>Jumlah Absensi</td>
                                            <td>: <span id="nm-siswa"><?php echo $absen; ?></span></td>
                                        </tr>
                                        <tr>
                                            <td>Nilai Per Jam</td>
                                            <td>: Rp. <?php echo number_format($gajiperjam); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td>: Rp. <?php echo number_format($absen * $gajiperjam); ?></td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        &nbsp;
                        &nbsp;
                    </div>
                    <?php } 

                        // dd($absen);
                    ?>

                @empty
                @endforelse



            </div>
        </div>
        <!-- end col -->
    </div>
@endsection
