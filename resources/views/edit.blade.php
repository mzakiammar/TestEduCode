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
                        <form action="/students/{{$students->id}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Siswa</label>
                                <input type="text" class="form-control" name="name" value="{{$students->name}}" />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kelas</label>
                                <select name="class" class="form-control" data-placeholder="Any" style="width: 100%;">
                                    <option value="9" {{$students->class == '9' ? 'selected' : ''}}>9</option>
                                    <option value="10" {{$students->class == '10' ? 'selected' : ''}}>10</option>
                                    <option value="11" {{$students->class == '11' ? 'selected' : ''}}>11</option>
                                    <option value="12" {{$students->class == '12' ? 'selected' : ''}}>12</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Status</label>
                                <select name="status" class="form-control" data-placeholder="Any" style="width: 100%;">
                                    <option value="1" {{$students->status == '1' ? 'selected' : ''}}>Aktif</option>
                                    <option value="0" {{$students->status == '0' ? 'selected' : ''}}>Tidak Aktif</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg">
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