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
            <div class="card">
                <div class="card-body">
                    <form action="/absensi/addProses" method="POST" class="custom-validation"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="latitude" id="latitude" hidden>
                        <input type="text" name="longitude" id="longitude" hidden>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="col-form-label" for="full_name">Nama
                                        Lengkap</label>
                                    <input type="text" class="form-control" id="full_name" name="full_name"
                                        value="{{ Auth::user()->full_name }}" placeholder="Masukan Nama Lengkap" readonly />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="col-form-label" for="tanggal">Tanggal</label>
                                    <input type="text" class="form-control" id="tanggal" name="tanggal"
                                        value="{{ date('Y-m-d ') }}" placeholder="Masukan Nama Lengkap" readonly />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="col-md-2 col-form-label" for="status">Status</label>
                                    <select class="form-control" name="status" id="sts" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="IN">IN</option>
                                        <option value="OUT">OUT</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <br>
                                <br>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Posisi</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($absensi as $a)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td width="auto">{{ $a->full_name }}</td>
                                            <td width="auto">{{ $a->status }}</td>
                                            <td width="auto">
                                                @if (Helper::apk()->latitude == $a->latitude && Helper::apk()->longitude == $a->longitude)
                                                Sesuai Lokasi
                                                @else
                                                Tidak Sesuai Lokasi
                                                @endif
                                            </td>
                                            <td width="auto">{{ $a->tanggal }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
    <script>
        $(window).on('load', function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    // Success function
                    showPosition,
                    // Error function
                    null,
                    // Options. See MDN for details.
                    {
                        enableHighAccuracy: true,
                        timeout: 5000,
                        maximumAge: 0
                    });
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        })

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    // Success function
                    showPosition,
                    // Error function
                    null,
                    // Options. See MDN for details.
                    {
                        enableHighAccuracy: true,
                        timeout: 5000,
                        maximumAge: 0
                    });
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            $('#latitude').val(position.coords.latitude);
            $('#longitude').val(position.coords.longitude);
            // alert(position.coords.latitude);
            // alert("Latitude: " + position.coords.latitude +
            //     "<br>Longitude: " + position.coords.longitude"")
        }
    </script>
@endsection
