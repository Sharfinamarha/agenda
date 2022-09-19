@extends('layouts.main')
@section('title', 'Agenda')
@section('container')
<form action="" method="get" id="myForm">
    <div class="row">
        <div class="col-6">
            <h4>Daftar Agenda</h4>
        </div>
        <div class="col-3">
            <select class="form-select" name="sort" id="sort">
                <option value="all">Semua</option>
                <option value="newest">Paling Baru</option>
                <option value="oldest">Paling Lama</option>
            </select>
        </div>
        <div class="col-3">
            <div class="input-group mb-3">
                <input type="text" name="q" class="form-control" placeholder="Cari Agenda" value="{{ Request::get('q') }}">
                <button class="btn btn-secondary" type="submit" id="button-addon2">Cari</button>
            </div>
        </div>
    </div>
</form>
<div class="row mt-4">
    <div class="col-12">
        <div class="table-responsive">
            <table id="dataTable" class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" data-sortable="false">Event</th>
                        <th scope="col">Lokasi</th>
                        <th scope="col">Penyelenggara</th>
                        <th scope="col">Peserta</th>
                        <th scope="col">Tanggal Mulai</th>
                        <th scope="col">Tanggal Selesai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($eventdata as $event)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $event->title }}</td>
                            <td>{{ $event->location }}</td>
                            <td>{{ $event->penyelenggara }}</td>
                            <td>{{ $event->peserta }}</td>
                            <td>{{ \Carbon\Carbon::parse($event->start)->translatedFormat('l, d F Y H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($event->end)->translatedFormat('l, d F Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $('#sort').val("{{ Request::get('sort') ?? 'all' }}");
    $(document).ready(function() {
        $('#sort').on('change', function() {
            $('form#myForm').submit();
        });
        $('#dataTable').DataTable({
            paging: false,
            ordering: false,
            info: false,
            searching: false,
            dom: 'Bfrtip',
            buttons: [
                'excel'
            ]
        } );
    });

    $(document).ready(function () {

    });
</script>
@endsection
