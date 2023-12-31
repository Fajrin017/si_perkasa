@extends ('dashboard.layouts.main')

@section('container')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Semua Laporan {{ auth()->user()->name }}</h1>
    <h5 style="color:blue;">Jumlah laporan telah diinput : {{ $posts->count() }}</h5>
  </div>

  

  @if(session()->has('success'))
    <div class="alert alert-success col-lg-8" role="alert">
      {{ session('success') }}
    </div>
  @endif

  <div class="table-responsive col-lg-12">
    <a href="/dashboard/posts/create" class= "btn btn-primary mb-3">Buat Laporan Baru</a>
        <table class="table table-striped table-sm-4">
          <thead>
            <tr>
              <th scope="col">#</th>
              @can('admin')
              <th scope="col">Approval</th>
              @endcan
              <th scope="col">Judul</th>
              <th scope="col">Seksi/Subseksi</th>
              <th scope="col">Laporan Dibuat</th>
              <th scope="col">Status Laporan</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($posts as $post)
            <tr>
              <td>{{ $loop->iteration }}</td>
              @can('admin')
              <td>
                <a href="{{ url('dashboard/posts/approved/'.$post->id) }}">
                    <!-- <i class="bi bi-check-square-fill"></i> -->
                    <i class="bi bi-pencil-square"></i>
                </a>
              </td>
              @endcan
              <td>{{ $post->title }}</td>
              <td>{{ $post->category->name}}</td>
              <td>{{ $post->created_at }}</td>

              
              @if ($post->post_status !==1)
              <td>
                
                <span class="badge bg-primary">{{ $post->post_status->nama }}</span>
              </td>
              @else 
              <td>
                <span class="badge bg-success">{{ $post->post_status->nama }}</span>
              </td>
              @endif

             
             
              
              
              <td>
                <a href="/dashboard/posts/{{ $post->slug }}" class="badge bg-info"><span data-feather="eye"></span></a>
                @can('admin')
                <a href="/dashboard/posts/{{ $post->slug }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                <form action="/dashboard/posts/{{ $post->slug}}" method="post" class="d-inline">
                  @method('delete')
                  @csrf
                  <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span></button>
                  @endcan
                </form>
              </td>
              
              
              
              
              
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>



@endsection


<!-- @push('script')
<script>
    let counter= 1
        $(#addButton).click (function() {
          counter ++

          let newInputan = '<tr><td><input class="form-control" style="min-width:150px" type="text" id="barang" name="barang[]"></td><td><input class="form-control"style="min-width:100px" type="text" id="jumlah" name="jumlah[]"></td><td><input class="form-control" style="width:80px" type="text" id="satuan" name="satuan[]"></td><td><input class="form-control" style="width:120px" type="text" id="kondisi" name="kondisi[]"></td></tr>'

                        $('#tambah_inputan').append(newInputan)
        });

            $('#removeButton').click(function () {
                if(counter ==1) {
                  swal.fire("Inputan tidak bisa dihapus")
                }
            });

</script> -->
@endpush