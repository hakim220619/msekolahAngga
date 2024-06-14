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
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Penilaian</h5>
                </div>
                <div class="card-body">
                    <div class="card">
                        <input type="hidden" name="" id="id_user" value="{{ $id }}">
                        {{-- <h5 class="card-header">Kuesioner <b style="color: black">PERPUSTAKAAN</b> --}}
                        </h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr class="text-nowrap">

                                        <th>No</th>
                                        <th>Pertanyaan</th>
                                        <th>A</th>
                                        <th>B</th>
                                        <th>C</th>
                                        <th>D</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($pertanyaan as $a)
                                        <input type="hidden" value="{{ $a->id }}"
                                            id="id_pertanyaan{{ $a->id }}" name="id_pertanyaan{{ $a->id }}">
                                        <input type="hidden" value="{{ $a->tahun }}" id="tahun" name="tahun">

                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{!! $a->pertanyaan !!}</td>
                                            <td>
                                                <div class="form-check form-check-inline mt-3">
                                                    <input class="form-check-input" type="radio"
                                                        name="{{ $a->id }}" id="inlineRadio1{{ $a->id }}"
                                                        onclick="return getValue(this.value, this.name)" value="100"
                                                        style="accent-color: #e74c3c;" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-check-inline mt-3">
                                                    <input class="form-check-input" type="radio"
                                                        name="{{ $a->id }}" id="inlineRadio2{{ $a->id }}"
                                                        onclick="return getValue(this.value, this.name)" value="80"
                                                        style="accent-color: #e74c3c;" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-check-inline mt-3">
                                                    <input class="form-check-input" type="radio"
                                                        name="{{ $a->id }}" id="inlineRadio3{{ $a->id }}"
                                                        onclick="return getValue(this.value, this.name)" value="70" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-check-inline mt-3">
                                                    <input class="form-check-input" type="radio"
                                                        name="{{ $a->id }}" id="inlineRadio4{{ $a->id }}"
                                                        onclick="return getValue(this.value, this.name)" value="50" />
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="demo-inline-spacing">
                            <button onclick="sendtolistlab()" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function sendtolistlab() {
            alert('success');
            window.location.href = '/penilaianPegawai'
        }

        function getValue(params1, params2) {
            const id_user = $('#id_user').val();
            const tahun = $('#tahun').val();
            const nilai = params1;
            const id_pertanyaan = params2
            // console.log(params2);
            $.ajax({
                type: 'POST',
                url: '/penilaian/addProses',
                async: true,
                data: {
                    "_token": "{{ csrf_token() }}",
                    id_user: id_user,
                    tahun: tahun,
                    nilai: nilai,
                    id_pertanyaan: id_pertanyaan
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    // $('#datatable').DataTable();


                }
            });

        }
    </script>
    <script>
        $(document).ready(function() {
            getchecked()

            function getchecked() {
                const id_user = $('#id_user').val();
                const tahun = $('#tahun').val();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('penilaian.load_data') }}',
                    async: true,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id_user: id_user,
                        tahun: tahun
                    },
                    dataType: 'json',
                    success: function(data) {
                        // console.log(data);
                        var i;
                        var no = 1;
                        for (i = 0; i < data.length; i++) {
                            console.log(data[i].id_pertanyaan);
                            document.getElementById('inlineRadio' + data[i].nilai + '' + data[i]
                                .id_pertanyaan + '').setAttribute("checked", "checked")
                        }
                    }
                });
            }
        })
    </script>
@endsection
