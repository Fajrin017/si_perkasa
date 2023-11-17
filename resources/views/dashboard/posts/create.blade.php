@extends ('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">BUAT LAPORAN PEMERIKSAAN SARPRAS</h1>
  </div>

  <div class="col-lg-8">
      <form action="/dashboard/posts" method="post" class="mb-3" enctype="multipart/form-data">
        @csrf
      <div class="mb-3">
        <label for="title" class="form-label">KEGIATAN PEMERIKSAAN</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required autofocus value="{{ old('title') }}">
          @error('title')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
     </div>
     
      <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" required value="{{ old('slug') }}">
        @error('slug')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      
      <div class="mb-3">
        <label for="Category" class="form-label">SEKSI/BAGIAN</label>
        <select class="form-select" name="category_id">
          @foreach ( $categories as $category)
            @if(old('category_id') == $category->id)
            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
            @else
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endif
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label for="image" class="form-label">DOKUMENTASI PEMERIKSAAN</label>
        <img class="img-preview img-fluid mb-3 col-sm-5">
        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
        @error('image')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>


      <div>
      <input class="form-control" type="hidden" id="post_status_id" name="post_status_id" value="1">
      </div>
      

      <div class="mb-3">
        <label for="body" class="form-label">KETERANGAN TAMBAHAN</label>
        @error('body')
        <p class="text-danger">{{ $message }}</p>
        @enderror
          <input id="body" type="hidden" name="body" value="{{ old('body') }}">
          <trix-editor input="body"></trix-editor>
      </div>

      

      <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-hover table-white" id="tableEstimate">
                                        <thead>
                                            <tr>
                                                <!-- <th style="width: 20px">#</th> -->
                                                <th class="col-sm-6">Nama Barang</th>
                                                <th class="col-md-2">Jumlah</th>
                                                <th style="width:100px;">Satuan</th>
                                                <th class="col-sm-4">Kondisi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="data">
                                        <tr>
                                            <td><input class="form-control" style="min-width:150px" type="text" id="barang1" name="barang1" value="{{ old('barang1') }}"></td>
                                            <td><input class="form-control"style="min-width:50px" type="number" id="jumlah1" name="jumlah1" value="{{ old('jumlah1') }}"></td>
                                            <td><div class="mb-3">
                                                <select style="min-width:100px" type="text" class="form-select" id="satuan1" name="satuan1" value="{{ old('satuan1') }}">
                                                    <option selected></option>
                                                    <option value="Unit" @if (old('satuan1') == "Unit ") {{ 'selected' }} @endif>Unit</option>
                                                    <option value="Buah" @if (old('satuan1') == "Buah") {{ 'selected' }} @endif>Buah</option>
                                                    <option value="Set" @if (old('satuan1') == "Set") {{ 'selected' }} @endif>Set</option>
                                                </select>
                                            </div>
                                            </td>
                                            <td><input class="form-control" style="width:120px" type="text" id="kondisi1" name="kondisi1" value="{{ old('kondisi1') }}"></td>
                                        </tr>

                                        <tr>
                                            <td><input class="form-control" style="min-width:150px" type="text" id="barang2" name="barang2" value="{{ old('barang2') }}"></td>
                                            <td><input class="form-control"style="min-width:100px" type="number" id="jumlah2" name="jumlah2" value="{{ old('jumlah2') }}"></td>
                                            <td><div class="mb-3">
                                                <select type="text" class="form-select" id="satuan2" name="satuan2" value="{{ old('satuan2') }}">
                                                    <option selected></option>
                                                    <option value="Unit" @if (old('satuan2') == "Unit ") {{ 'selected' }} @endif>Unit</option>
                                                    <option value="Buah" @if (old('satuan2') == "Buah") {{ 'selected' }} @endif>Buah</option>
                                                    <option value="Set" @if (old('satuan2') == "Set") {{ 'selected' }} @endif>Set</option>
                                                </select>
                                            </div>
                                            </td>
                                            <td><input class="form-control" style="width:120px" type="text" id="kondisi2" name="kondisi2" value="{{ old('kondisi2') }}"></td>
                                        </tr>

                                        <tr>
                                            <td><input class="form-control" style="min-width:150px" type="text" id="barang3" name="barang3" value="{{ old('barang3') }}"></td>
                                            <td><input class="form-control"style="min-width:100px" type="number" id="jumlah3" name="jumlah3" value="{{ old('jumlah3') }}"></td>
                                            <td><div class="mb-3">
                                                <select type="text" class="form-select" id="satuan3" name="satuan3" value="{{ old('satuan3') }}">
                                                    <option selected></option>
                                                    <option value="Unit" @if (old('satuan3') == "Unit ") {{ 'selected' }} @endif>Unit</option>
                                                    <option value="Buah" @if (old('satuan3') == "Buah") {{ 'selected' }} @endif>Buah</option>
                                                    <option value="Set" @if (old('satuan3') == "Set") {{ 'selected' }} @endif>Set</option>
                                                </select>
                                            </div>
                                            </td>
                                            <td><input class="form-control" style="width:120px" type="text" id="kondisi3" name="kondisi3" value="{{ old('kondisi3') }}"></td>
                                        </tr>

                                        <tr>
                                            <td><input class="form-control" style="min-width:150px" type="text" id="barang4" name="barang4" value="{{ old('barang4') }}"></td>
                                            <td><input class="form-control"style="min-width:100px" type="number" id="jumlah4" name="jumlah4" value="{{ old('jumlah4') }}"></td>
                                            <td><div class="mb-3">
                                                <select type="text" class="form-select" id="satuan4" name="satuan4" value="{{ old('satuan4') }}">
                                                    <option selected></option>
                                                    <option value="Unit" @if (old('satuan4') == "Unit ") {{ 'selected' }} @endif>Unit</option>
                                                    <option value="Buah" @if (old('satuan4') == "Buah") {{ 'selected' }} @endif>Buah</option>
                                                    <option value="Set" @if (old('satuan4') == "Set") {{ 'selected' }} @endif>Set</option>
                                                </select>
                                            </div>
                                            </td>
                                            <td><input class="form-control" style="width:120px" type="text" id="kondisi4" name="kondisi4" value="{{ old('kondisi4') }}"></td>
                                        </tr>

                                        <tr>
                                            <td><input class="form-control" style="min-width:150px" type="text" id="barang5" name="barang5" value="{{ old('barang5') }}"></td>
                                            <td><input class="form-control"style="min-width:100px" type="number" id="jumlah5" name="jumlah5" value="{{ old('jumlah5') }}"></td>
                                            <td><div class="mb-3">
                                                <select type="text" class="form-select" id="satuan5" name="satuan5" value="{{ old('satuan5') }}">
                                                    <option selected></option>
                                                    <option value="Unit" @if (old('satuan5') == "Unit ") {{ 'selected' }} @endif>Unit</option>
                                                    <option value="Buah" @if (old('satuan5') == "Buah") {{ 'selected' }} @endif>Buah</option>
                                                    <option value="Set" @if (old('satuan5') == "Set") {{ 'selected' }} @endif>Set</option>
                                                </select>
                                            </div>
                                            </td>
                                            <td><input class="form-control" style="width:120px" type="text" id="kondisi5" name="kondisi5" value="{{ old('kondisi5') }}"></td>
                                        </tr>

                                        <tr>
                                            <td><input class="form-control" style="min-width:150px" type="text" id="barang6" name="barang6" value="{{ old('barang6') }}"></td>
                                            <td><input class="form-control"style="min-width:100px" type="number" id="jumlah6" name="jumlah6" value="{{ old('jumlah6') }}"></td>
                                            <td><div class="mb-3">
                                                <select type="text" class="form-select" id="satuan6" name="satuan6" value="{{ old('satuan6') }}">
                                                    <option selected></option>
                                                    <option value="Unit" @if (old('satuan6') == "Unit ") {{ 'selected' }} @endif>Unit</option>
                                                    <option value="Buah" @if (old('satuan6') == "Buah") {{ 'selected' }} @endif>Buah</option>
                                                    <option value="Set" @if (old('satuan6') == "Set") {{ 'selected' }} @endif>Set</option>
                                                </select>
                                            </div>
                                            </td>
                                            <td><input class="form-control" style="width:120px" type="text" id="kondisi6" name="kondisi6" value="{{ old('kondisi6') }}"></td>
                                        </tr>

                                        <tr>
                                            <td><input class="form-control" style="min-width:150px" type="text" id="barang7" name="barang7" value="{{ old('barang7') }}"></td>
                                            <td><input class="form-control"style="min-width:100px" type="number" id="jumlah7" name="jumlah7" value="{{ old('jumlah') }}"></td>
                                            <td><div class="mb-3">
                                                <select type="text" class="form-select" id="satuan7" name="satuan7" value="{{ old('satuan7') }}">
                                                    <option selected></option>
                                                    <option value="Unit" @if (old('satuan7') == "Unit ") {{ 'selected' }} @endif>Unit</option>
                                                    <option value="Buah" @if (old('satuan7') == "Buah") {{ 'selected' }} @endif>Buah</option>
                                                    <option value="Set" @if (old('satuan7') == "Set") {{ 'selected' }} @endif>Set</option>
                                                </select>
                                            </div>
                                            </td>
                                            <td><input class="form-control" style="width:120px" type="text" id="kondisi7" name="kondisi7" value="{{ old('kondisi7') }}"></td>
                                        </tr>

                                        <tr>
                                            <td><input class="form-control" style="min-width:150px" type="text" id="barang8" name="barang8" value="{{ old('barang8') }}"></td>
                                            <td><input class="form-control"style="min-width:100px" type="number" id="jumlah8" name="jumlah8" value="{{ old('jumlah8') }}"></td>
                                            <td><div class="mb-3">
                                                <select type="text" class="form-select" id="satuan8" name="satuan8" value="{{ old('satuan8') }}">
                                                    <option selected></option>
                                                    <option value="Unit" @if (old('satuan8') == "Unit ") {{ 'selected' }} @endif>Unit</option>
                                                    <option value="Buah" @if (old('satuan8') == "Buah") {{ 'selected' }} @endif>Buah</option>
                                                    <option value="Set" @if (old('satuan8') == "Set") {{ 'selected' }} @endif>Set</option>
                                                </select>
                                            </div>
                                            </td>
                                            <td><input class="form-control" style="width:120px" type="text" id="kondisi8" name="kondisi8" value="{{ old('kondisi8') }}"></td>
                                        </tr>

                                        <tr>
                                            <td><input class="form-control" style="min-width:150px" type="text" id="barang9" name="barang9" value="{{ old('barang9') }}"></td>
                                            <td><input class="form-control"style="min-width:100px" type="number" id="jumlah9" name="jumlah9" value="{{ old('jumlah9') }}"></td>
                                            <td><div class="mb-3">
                                                <select type="text" class="form-select" id="satuan9" name="satuan9" value="{{ old('satuan9') }}">
                                                    <option selected></option>
                                                    <option value="Unit" @if (old('satuan9') == "Unit ") {{ 'selected' }} @endif>Unit</option>
                                                    <option value="Buah" @if (old('satuan9') == "Buah") {{ 'selected' }} @endif>Buah</option>
                                                    <option value="Set" @if (old('satuan9') == "Set") {{ 'selected' }} @endif>Set</option>
                                                </select>
                                            </div>
                                            </td>
                                            <td><input class="form-control" style="width:120px" type="text" id="kondisi9" name="kondisi9" value="{{ old('kondisi9') }}"></td>
                                        </tr>

                                        <tr>
                                            <td><input class="form-control" style="min-width:150px" type="text" id="barang10" name="barang10" value="{{ old('barang10') }}"></td>
                                            <td><input class="form-control"style="min-width:100px" type="number" id="jumlah10" name="jumlah10" value="{{ old('jumlah10') }}"></td>
                                            <td><div class="mb-3">
                                                <select type="text" class="form-select" id="satuan10" name="satuan10" value="{{ old('satuan10') }}">
                                                    <option selected></option>
                                                    <option value="Unit" @if (old('satuan10') == "Unit ") {{ 'selected' }} @endif>Unit</option>
                                                    <option value="Buah" @if (old('satuan10') == "Buah") {{ 'selected' }} @endif>Buah</option>
                                                    <option value="Set" @if (old('satuan10') == "Set") {{ 'selected' }} @endif>Set</option>
                                                </select>
                                            </div>
                                            </td>
                                            <td><input class="form-control" style="width:120px" type="text" id="kondisi10" name="kondisi10" value="{{ old('kondisi10') }}"></td>
                                        </tr>

                                        <tr>
                                            <td><input class="form-control" style="min-width:150px" type="text" id="barang11" name="barang11" value="{{ old('barang11') }}"></td>
                                            <td><input class="form-control"style="min-width:100px" type="number" id="jumlah11" name="jumlah11" value="{{ old('jumlah11') }}"></td>
                                            <td><div class="mb-3">
                                                <select type="text" class="form-select" id="satuan11" name="satuan11" value="{{ old('satuan11') }}">
                                                    <option selected></option>
                                                    <option value="Unit" @if (old('satuan11') == "Unit ") {{ 'selected' }} @endif>Unit</option>
                                                    <option value="Buah" @if (old('satuan11') == "Buah") {{ 'selected' }} @endif>Buah</option>
                                                    <option value="Set" @if (old('satuan11') == "Set") {{ 'selected' }} @endif>Set</option>
                                                </select>
                                            </div>
                                            </td>
                                            <td><input class="form-control" style="width:120px" type="text" id="kondisi11" name="kondisi11" value="{{ old('kondisi11') }}"></td>
                                        </tr>

                                        <tr>
                                            <td><input class="form-control" style="min-width:150px" type="text" id="barang12" name="barang12" value="{{ old('barang12') }}"></td>
                                            <td><input class="form-control"style="min-width:100px" type="number" id="jumlah12" name="jumlah12" value="{{ old('jumlah12') }}"></td>
                                            <td><div class="mb-3">
                                                <select type="text" class="form-select" id="satuan12" name="satuan12" value="{{ old('satuan12') }}">
                                                    <option selected></option>
                                                    <option value="Unit" @if (old('satuan12') == "Unit ") {{ 'selected' }} @endif>Unit</option>
                                                    <option value="Buah" @if (old('satuan12') == "Buah") {{ 'selected' }} @endif>Buah</option>
                                                    <option value="Set" @if (old('satuan12') == "Set") {{ 'selected' }} @endif>Set</option>
                                                </select>
                                            </div>
                                            </td>
                                            <td><input class="form-control" style="width:120px" type="text" id="kondisi12" name="kondisi12" value="{{ old('kondisi12') }}"></td>
                                        </tr>

                                        <tr>
                                            <td><input class="form-control" style="min-width:150px" type="text" id="barang13" name="barang13" value="{{ old('barang13') }}"></td>
                                            <td><input class="form-control"style="min-width:100px" type="number" id="jumlah13" name="jumlah13" value="{{ old('jumlah13') }}"></td>
                                            <td><div class="mb-3">
                                                <select type="text" class="form-select" id="satuan13" name="satuan13" value="{{ old('satuan13') }}">
                                                    <option selected></option>
                                                    <option value="Unit" @if (old('satuan13') == "Unit ") {{ 'selected' }} @endif>Unit</option>
                                                    <option value="Buah" @if (old('satuan13') == "Buah") {{ 'selected' }} @endif>Buah</option>
                                                    <option value="Set" @if (old('satuan13') == "Set") {{ 'selected' }} @endif>Set</option>
                                                </select>
                                            </div>
                                            </td>
                                            <td><input class="form-control" style="width:120px" type="text" id="kondisi13" name="kondisi13" value="{{ old('kondisi13') }}"></td>
                                        </tr>

                                        <tr>
                                            <td><input class="form-control" style="min-width:150px" type="text" id="barang14" name="barang14" value="{{ old('barang14') }}"></td>
                                            <td><input class="form-control"style="min-width:100px" type="number" id="jumlah14" name="jumlah14" value="{{ old('jumlah14') }}"></td>
                                            <td><div class="mb-3">
                                                <select type="text" class="form-select" id="satuan14" name="satuan14" value="{{ old('satuan14') }}">
                                                    <option selected></option>
                                                    <option value="Unit" @if (old('satuan14') == "Unit ") {{ 'selected' }} @endif>Unit</option>
                                                    <option value="Buah" @if (old('satuan14') == "Buah") {{ 'selected' }} @endif>Buah</option>
                                                    <option value="Set" @if (old('satuan14') == "Set") {{ 'selected' }} @endif>Set</option>
                                                </select>
                                            </div>
                                            </td>
                                            <td><input class="form-control" style="width:120px" type="text" id="kondisi14" name="kondisi14" value="{{ old('kondisi14') }}"></td>
                                        </tr>

                                        <tr>
                                            <td><input class="form-control" style="min-width:150px" type="text" id="barang15" name="barang15" value="{{ old('barang15') }}"></td>
                                            <td><input class="form-control"style="min-width:100px" type="number" id="jumlah15" name="jumlah15" value="{{ old('jumlah15') }}"></td>
                                            <td><div class="mb-3">
                                                <select type="text" class="form-select" id="satuan15" name="satuan15" value="{{ old('satuan15') }}">
                                                    <option selected></option>
                                                    <option value="Unit" @if (old('satuan15') == "Unit ") {{ 'selected' }} @endif>Unit</option>
                                                    <option value="Buah" @if (old('satuan15') == "Buah") {{ 'selected' }} @endif>Buah</option>
                                                    <option value="Set" @if (old('satuan15') == "Set") {{ 'selected' }} @endif>Set</option>
                                                </select>
                                            </div>
                                            </td>
                                            <td><input class="form-control" style="width:120px" type="text" id="kondisi15" name="kondisi15" value="{{ old('kondisi15') }}"></td>
                                        </tr>

                                        <tr>
                                            <td><input class="form-control" style="min-width:150px" type="text" id="barang16" name="barang16" value="{{ old('barang16') }}"></td>
                                            <td><input class="form-control"style="min-width:100px" type="number" id="jumlah16" name="jumlah16" value="{{ old('jumlah16') }}"></td>
                                            <td><div class="mb-3">
                                                <select type="text" class="form-select" id="satuan16" name="satuan16" value="{{ old('satuan16') }}">
                                                    <option selected></option>
                                                    <option value="Unit" @if (old('satuan16') == "Unit ") {{ 'selected' }} @endif>Unit</option>
                                                    <option value="Buah" @if (old('satuan16') == "Buah") {{ 'selected' }} @endif>Buah</option>
                                                    <option value="Set" @if (old('satuan16') == "Set") {{ 'selected' }} @endif>Set</option>
                                                </select>
                                            </div>
                                            </td>
                                            <td><input class="form-control" style="width:120px" type="text" id="kondisi16" name="kondisi16" value="{{ old('kondisi16') }}"></td>
                                        </tr>

                                        <tr>
                                            <td><input class="form-control" style="min-width:150px" type="text" id="barang17" name="barang17" value="{{ old('barang17') }}"></td>
                                            <td><input class="form-control"style="min-width:100px" type="number" id="jumlah17" name="jumlah17" value="{{ old('jumlah17') }}"></td>
                                            <td><div class="mb-3">
                                                <select type="text" class="form-select" id="satuan17" name="satuan17" value="{{ old('satuan17') }}">
                                                    <option selected></option>
                                                    <option value="Unit" @if (old('satuan17') == "Unit ") {{ 'selected' }} @endif>Unit</option>
                                                    <option value="Buah" @if (old('satuan17') == "Buah") {{ 'selected' }} @endif>Buah</option>
                                                    <option value="Set" @if (old('satuan17') == "Set") {{ 'selected' }} @endif>Set</option>
                                                </select>
                                            </div>
                                            </td>
                                            <td><input class="form-control" style="width:120px" type="text" id="kondisi17" name="kondisi17" value="{{ old('kondisi17') }}"></td>
                                        </tr>

                                        <tr>
                                            <td><input class="form-control" style="min-width:150px" type="text" id="barang18" name="barang18" value="{{ old('barang18') }}"></td>
                                            <td><input class="form-control"style="min-width:100px" type="number" id="jumlah18" name="jumlah18" value="{{ old('jumlah18') }}"></td>
                                            <td><div class="mb-3">
                                                <select type="text" class="form-select" id="satuan18" name="satuan18" value="{{ old('satuan18') }}">
                                                    <option selected></option>
                                                    <option value="Unit" @if (old('satuan18') == "Unit ") {{ 'selected' }} @endif>Unit</option>
                                                    <option value="Buah" @if (old('satuan18') == "Buah") {{ 'selected' }} @endif>Buah</option>
                                                    <option value="Set" @if (old('satuan18') == "Set") {{ 'selected' }} @endif>Set</option>
                                                </select>
                                            </div>
                                            </td>
                                            <td><input class="form-control" style="width:120px" type="text" id="kondisi18" name="kondisi18" value="{{ old('kondisi18') }}"></td>
                                        </tr>

                                        <tr>
                                            <td><input class="form-control" style="min-width:150px" type="text" id="barang19" name="barang19" value="{{ old('barang19') }}"></td>
                                            <td><input class="form-control"style="min-width:100px" type="number" id="jumlah19" name="jumlah19" value="{{ old('jumlah19') }}"></td>
                                            <td><div class="mb-3">
                                                <select type="text" class="form-select" id="satuan19" name="satuan19" value="{{ old('satuan19') }}">
                                                    <option selected></option>
                                                    <option value="Unit" @if (old('satuan19') == "Unit ") {{ 'selected' }} @endif>Unit</option>
                                                    <option value="Buah" @if (old('satuan19') == "Buah") {{ 'selected' }} @endif>Buah</option>
                                                    <option value="Set" @if (old('satuan19') == "Set") {{ 'selected' }} @endif>Set</option>
                                                </select>
                                            </div>
                                            </td>
                                            <td><input class="form-control" style="width:120px" type="text" id="kondisi19" name="kondisi19" value="{{ old('kondisi19') }}"></td>
                                        </tr>

                                        <tr>
                                            <td><input class="form-control" style="min-width:150px" type="text" id="barang20" name="barang20" value="{{ old('barang20') }}"></td>
                                            <td><input class="form-control"style="min-width:100px" type="number" id="jumlah20" name="jumlah20" value="{{ old('jumlah20') }}"></td>
                                            <td><div class="mb-3">
                                                <select type="text" class="form-select" id="satuan20" name="satuan20" value="{{ old('satuan20') }}">
                                                    <option selected></option>
                                                    <option value="Unit" @if (old('satuan20') == "Unit ") {{ 'selected' }} @endif>Unit</option>
                                                    <option value="Buah" @if (old('satuan20') == "Buah") {{ 'selected' }} @endif>Buah</option>
                                                    <option value="Set" @if (old('satuan20') == "Set") {{ 'selected' }} @endif>Set</option>
                                                </select>
                                            </div>
                                            </td>
                                            <td><input class="form-control" style="width:120px" type="text" id="kondisi20" name="kondisi20" value="{{ old('kondisi20') }}"></td>
                                        </tr>

                                        

                                        </tbody>
                                    </table>
                                </div>
                              </div>
                            </div>

      
      
      <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
  </div>
  
  <script>
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('change', function(){
        fetch('/dashboard/posts/checkSlug?title=' + title.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    });

    document.addEventListener ('trix-file-accept', function(e) {
      e.preventDefault();
    })

    function previewImage(){
    const image = document.querySelector('#image');
    const imgPreview = document.querySelector('.img-preview');
    
    imgPreview.style.display = 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function(oFREvent) {
      imgPreview.src = oFREvent.target.result;
    }
    }

  
        //     var rowIdx = 1;
        //     $("#addBtn").on("click", function ()
        //     {
        //         // Adding a row inside the tbody.
        //         $("#tableEstimate tbody").append(`
        //         <tr id="R${++rowIdx}">
        //             <td class="row-index text-center"><p> ${rowIdx}</p></td>
        //             <td><input class="form-control" type="text" style="min-width:150px" id="barang" name="barang[]"></td>
        //             <td><input class="form-control" type="text" style="min-width:150px" id="jumlah" name="jumlah[]"></td>
        //             <td><input class="form-control" style="width:100px" type="text" id="satuan" name="satuan[]"></td>
        //             <td><button type="button" class="btn btn-sm btn-primary float-end" title="Add" id="addBtn">Tambah Data</button></td>
        //         </tr>`);
        //     });
        //     $("#tableEstimate tbody").on("click", ".remove", function ()
        //     {
        //         // Getting all the rows next to the row
        //         // containing the clicked button
        //         var child = $(this).closest("tr").nextAll();
        //         // Iterating across all the rows
        //         // obtained to change the index
        //         child.each(function () {
        //         // Getting <tr> id.
        //         var id = $(this).attr("id");

        //         // Getting the <p> inside the .row-index class.
        //         var idx = $(this).children(".row-index").children("p");

        //         // Gets the row number from <tr> id.
        //         var dig = parseInt(id.substring(1));

        //         // Modifying row index.
        //         idx.html(`${dig - 1}`);

        //         // Modifying row id.
        //         $(this).attr("id", `R${dig - 1}`);
        //     });
    
        //         // Removing the current row.
        //         $(this).closest("tr").remove();
    
        //         // Decreasing total number of rows by 1.
        //         rowIdx--;
        //     });
        // </script>



       



<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    let dataRow = 0
        $('#add-input').click( () => {
            dataRow++
            inputRow(dataRow)
        })

        inputRow = (i) => {
            let tr = `<tr id="input-tr-${++i}">
                        <td>
                        ${i}
                        </td>
                        <td>
                          <input class="form-control" style="min-width:150px" type="text" id="barang" name="barang[]">
                        </td>
                        <td>
                          <input class="form-control"style="min-width:100px" type="text" id="jumlah" name="jumlah[]">
                        </td>
                        <td>
                          <input class="form-control" style="width:80px" type="text" id="satuan" name="satuan[]">
                        </td>
                        <td>
                        <input class="form-control" style="width:120px" type="text" id="kondisi" name="kondisi[]">
                        </td>
                        <td><button class="btn btn-sm btn-danger delete-record float-end" data-id="${i}">Hapus</button></td>
                    </tr>`
            $('#data').append(tr)
        }

        $('#data').on('click', '.delete-record', function() {
            let id = $(this).attr('data-id')
            $('#input-tr-'+id).remove()
        })
</script>



<!-- <script type="text/javascript">
  $('.addCustomer').on('click', function(){
      addCustomer();
  });
  function addCustomer(){
    var customer = '';
    $('.customer').append(customer);
  };

  $('.remove').live('click', function(){
    $(this).parent().parent().parent().remove();
  }); -->

</script>





@endsection