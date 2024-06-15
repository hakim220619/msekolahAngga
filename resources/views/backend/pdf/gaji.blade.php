<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="row">
        <div class="col-6">
            <div class="row">
                @forelse ($month as $key => $m)
                    <?php
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
