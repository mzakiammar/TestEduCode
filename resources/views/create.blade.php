@extends('template.masteradmin')

@section('title')
    Input Data Siswa
@endsection
@section('content1')
<link rel="stylesheet" href="{{asset('/adminlte/plugins/select2/css/select2.min.css')}}">
    <!-- contact section -->
  <section class="content">
    <div class="container-fluid">
      <div class="">
        <div class="">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Input Data Siswa</h3>
            </div>
            <div class="card-body">
            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
            <form action="/students" method="post">
              @csrf
              <div class="form-group">
                <label for="exampleInputEmail1">Nama Siswa</label>
                <input type="text" class="form-control" name="name" class="message-box" placeholder="Nama Siswa" />
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Kelas</label>
                <select name="class" class="form-control" data-placeholder="Any" style="width: 100%;">
                      <option value="9">9</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Kelas</label>
                <select name="status" class="form-control" data-placeholder="Any" style="width: 100%;">
                      <option value="1">Aktif</option>
                      <option value="0">Tidak Aktif</option>
                </select>
              </div>
              <button class="btn btn-primary btn-lg ">
                  SEND
              </button>
            </form>
          </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end contact section -->
  <script>
    $(function () {
      $('.select2').select2()
    });
  </script>
  <script src="{{asset('/adminlte/plugins/select2/js/select2.full.min.js')}}"></script>
@endsection