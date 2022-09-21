@extends('layouts.main')
@section('title', 'Kalender')
@section('container')

<div id="calendar"></div>

<!-- Modal Tambah Agenda-->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Agenda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="title" class="form-label">Judul Agenda</label>
                    <input type="text" id="title" class="form-control" placeholder="Judul" required>
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Lokasi Agenda</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-pin-map-fill"></i></span>
                        <input type="text" id="location" class="form-control" placeholder="Lokasi" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="penyelenggara" class="form-label">Penyelenggara Agenda</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-building"></i></span>
                        <input type="text" id="penyelenggara" class="form-control" placeholder="Penyelenggara" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="peserta" class="form-label">Disposisi</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-fill"></i></span>
                        <input type="text" id="peserta" class="form-control" placeholder="Disposisi" value="">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="start" class="form-label">Tanggal Mulai Agenda</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-calendar-plus-fill"></i></span>
                        <input type="text" name="start" id="start_time" data-toggle="datetimepicker" class="form-control datetimepicker" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="end" class="form-label">Tanggal Selesai Agenda</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-calendar-minus-fill"></i></span>
                        <input type="text" name="end" id="finish_time" data-toggle="datetimepicker" class="form-control datetimepicker" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveAgenda()">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit & Hapus Agenda-->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Agenda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit-id">
                <div class="mb-3">
                    <label for="title" class="form-label">Judul Agenda</label>
                    <input type="text" id="edit-title" class="form-control" placeholder="Judul" required>
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Lokasi Agenda</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-pin-map-fill"></i></span>
                        <input type="text" id="edit-location" class="form-control" placeholder="Lokasi" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="penyelenggara" class="form-label">Penyelenggara Agenda</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-building"></i></span>
                        <input type="text" id="edit-penyelenggara" class="form-control" placeholder="Penyelenggara" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="peserta" class="form-label">Disposisi</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-fill"></i></span>
                        <input type="text" id="edit-peserta" class="form-control" placeholder="Disposisi">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="start" class="form-label">Tanggal Mulai Agenda</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-calendar-plus-fill"></i></span>
                        <input type="text" name="start" id="edit-start_time" data-toggle="datetimepicker" class="form-control datetimepicker" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="end" class="form-label">Tanggal Selesai Agenda</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-calendar-minus-fill"></i></span>
                        <input type="text" name="end" id="edit-finish_time" data-toggle="datetimepicker" class="form-control datetimepicker" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger me-auto" onclick="deleteAgenda()">Hapus</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="updateAgenda()">Update</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

<script>
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var calendar = $('#calendar').fullCalendar({
            editable: true,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: '/Agenda',
            selectable: true,
            selectHelper: true,
            select: function (start, end, allDay) {
                clearFormModal();
                $('#start_time').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                $('#finish_time').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                $('#tambahModal').modal('show');
            },
            editable: true,
            eventResize: function (event, delta) {
                var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                $.ajax({
                    url: "/Agenda/action",
                    type: "POST",
                    traditional: true,
                    data: {
                        id: event.id,
                        title: event.title,
                        location: event.location,
                        penyelenggara: event.penyelenggara,
                        peserta: event.peserta,
                        start: start,
                        end: end,
                        type: 'update'
                    },
                    success: function (response) {
                        calendar.fullCalendar('refetchEvents');
                        swalert('success', 'Agenda berhasil diupdate!');
                    }
                })
            },
            eventDrop: function (event, delta) {
                var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                $.ajax({
                    url: "/Agenda/action",
                    type: "POST",
                    traditional: true,
                    data: {
                        id: event.id,
                        title: event.title,
                        location: event.location,
                        penyelenggara: event.penyelenggara,
                        peserta: event.peserta,
                        start: start,
                        end: end,
                        type: 'update'
                    },
                    success: function (response) {
                        calendar.fullCalendar('refetchEvents');
                        swalert('success', 'Agenda berhasil diupdate!');
                    }
                })
            },

            eventClick: function (event) {
                clearFormModal();
                $('#edit-id').val(event.id);
                $('#edit-title').val(event.title);
                $('#edit-location').val(event.location);
                $('#edit-penyelenggara').val(event.penyelenggara);
                $('#edit-peserta').val(event.peserta);
                $('#edit-start_time').val(moment(event.start).format('YYYY-MM-DD HH:mm:ss'));
                $('#edit-finish_time').val(moment(event.end).format('YYYY-MM-DD HH:mm:ss'));
                $('#updateModal').modal('show');
            }
        });
    });

    function saveAgenda(){
        var title = $('#title').val();
        var location = $('#location').val();
        var penyelenggara = $('#penyelenggara').val();
        var peserta = $('#peserta').val();
        var start_date = $('#start_time').val();
        var start = moment(start_date).format('YYYY-MM-DD HH:mm:ss');
        var finish_date = $('#finish_time').val();
        var finish = moment(finish_date).format('YYYY-MM-DD HH:mm:ss');

        console.log(start);
        $.ajax({
            url:"/Agenda/action",
            type:"POST",
            data:{
                title: title,
                location: location,
                penyelenggara: penyelenggara,
                peserta: peserta,
                start: start,
                end: finish,
                type: 'add'
            },
            success:function(data)
            {
                $('#calendar').fullCalendar('refetchEvents');
                $('#tambahModal').modal('hide');
                swalert('success', 'Agenda berhasil ditambahkan!');
            }
        });
    }

    function deleteAgenda(){
        var id = $('#edit-id').val();
        $.ajax({
            url:"/Agenda/action",
            type:"POST",
            data:{
                id: id,
                type: 'delete'
            },
            success:function(data)
            {
                $('#calendar').fullCalendar('refetchEvents');
                $('#updateModal').modal('hide');
                swalert('success', 'Agenda berhasil dihapus!');
            }
        });
    }

    function updateAgenda(){
        var id = $('#edit-id').val();
        var title = $('#edit-title').val();
        var location = $('#edit-location').val();
        var penyelenggara = $('#edit-penyelenggara').val();
        var peserta = $('#edit-peserta').val();
        var start_date = $('#edit-start_time').val();
        var start = moment(start_date).format('YYYY-MM-DD HH:mm:ss');
        var finish_date = $('#edit-finish_time').val();
        var finish = moment(finish_date).format('YYYY-MM-DD HH:mm:ss');

        console.log(start);
        $.ajax({
            url:"/Agenda/action",
            type:"POST",
            data:{
                id: id,
                title: title,
                location: location,
                penyelenggara: penyelenggara,
                peserta: peserta,
                start: start,
                end: finish,
                type: 'update'
            },
            success:function(data)
            {
                $('#calendar').fullCalendar('refetchEvents');
                $('#updateModal').modal('hide');
                swalert('success', 'Agenda berhasil diupdate!');
            }
        });
    }

    function clearFormModal(){
        $('#id').val('');
        $('#title').val('');
        $('#location').val('');
        $('#penyelenggara').val('');
        $('#peserta').val('');
        $('#start_time').val('');
        $('#finish_time').val('');
    }
</script>
@endsection
