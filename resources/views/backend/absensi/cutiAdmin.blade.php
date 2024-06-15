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
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Jenis</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($cuti as $a)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td width="auto">{{ $a->full_name }}</td>
                                            <td width="auto">{{ $a->status }}</td>
                                            <td width="auto">{{ $a->cuti }}</td>
                                            <td width="auto">{{ $a->tanggal }}</td>
                                            @if ($a->cuti != 'DITERIMA')
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <a href="#" onclick="deleteItem(this)"
                                                                data-id="{{ $a->id }}"><i class="fa fa-check-circle"
                                                                    style="color:black"></i></a>
                                                        </div>
                                                    </div>
                                                </td>
                                            @else
                                                <td></td>
                                            @endif

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
    <script>
        function deleteItem(e) {
            let id = e.getAttribute('data-id');
            console.log(id);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to Accept this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    setInterval(function() {
                            // location.reload();
                        }, 30000),
                        Swal.fire(
                            'Cuti!',
                            'Cuti Berhasil.',
                            'success'
                        ),
                        $.ajax({
                            type: 'POST',
                            url: '{{ url('/cuti/prosesAcc/') }}/' + id,
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function(data) {

                                if (data.success) {

                                    swalWithBootstrapButtons.fire(
                                        'Cuti!',
                                        'Cuti Berhasil.',
                                        "success",

                                    );

                                }

                            }
                        });



                }
                if (result.isConfirmed) location.reload()
            })

        }
    </script>
@endsection
