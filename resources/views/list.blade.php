@extends('template.masteradmin')
@section('title')
    List Data Nilai Siswa
@endsection
@section('content1')
  <!-- contact section -->
  <section class="content">
    <div class="container-fluid">
      <form action="/students/create">
        <button class="btn btn-success btn-lg">
          Tambah Data
        </button>
      </form>
      <br>

      <table class="table display" style="width:100%" id="dataTable">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Siswa</th>
            <th scope="col">Kelas</th>
            <th scope="col">Status</th>
            <th scope="col">Handle</th>
          </tr>
        </thead>
        <tbody>
         @forelse ($students as $key => $value)
         <tr>
            <td>{{$key + 1}}</td>
            <td>{{$value ->name}}</td>
            <td>{{$value ->class}}</td>
            <td>
                @if($value->status == 1)
                    <button class="status-btn btn btn-success" data-student-id="{{ $value->id }}" data-status="{{ $value->status }}">
                        Aktif
                    </button>
                @else
                    <button class="status-btn btn btn-danger" data-student-id="{{ $value->id }}" data-status="{{ $value->status }}">
                        Non-Aktif
                    </button>
                @endif
            </td>            
            <td>
              <form action="/students/{{$value->id}}" method="POST">
                @csrf
                @method('DELETE')
                <a href="/students/{{$value->id}}/edit" class="btn-2 btn-warning btn">Edit</a>
                <button type="submit" value="Delete" class="btn-2 btn-danger btn delete-button" >Delete</button>
              </form>
            </td>
          </tr> 
         @empty
          <tr>
            <td></td>
            <td>No Data</td>
          </tr>
         @endforelse
        </tbody>
      </table>
    </div>
  </section>
  <!-- end contact section -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-button');

    deleteButtons.forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default form submission

            const confirmDelete = window.confirm('Are you sure you want to delete this item?');

            if (confirmDelete) {
                const form = this.parentElement;
                form.submit();
            }
        });
    });
});
$(document).ready(function() {
    // Initialize the DataTable on your table element
    let table = $('#dataTable').DataTable({
        // Your DataTable configuration options here
    });
});

    
$(document).ready(function () {
        $('.status-btn').click(function () {
            var studentId = $(this).data('student-id');
            var currentStatus = $(this).data('status');

            // Kirim permintaan Ajax ke server
            $.ajax({
                url: '/update-status',
                method: 'POST',
                data: {
                    student_id: studentId,
                    current_status: currentStatus,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    // Tanggapi dengan mengganti status di UI
                    if (response.status == 1) {
                        $(this).removeClass('btn-danger').addClass('btn-success').text('Aktif');
                    } else {
                        $(this).removeClass('btn-success').addClass('btn-danger').text('Non-Aktif');
                    }
                },
                error: function (error) {
                    console.error('Gagal mengirim permintaan Ajax:', error);
                }
            });
        });
    });
</script>

  
@endsection