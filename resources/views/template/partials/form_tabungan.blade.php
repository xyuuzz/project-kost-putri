<div class="form-row">
    <div class="form-group col-md-6">
        <label>Pemasukan</label>
        <input type="number" class="form-control" name="pemasukan" value="{{ $data->pemasukan ?? old('pemasukan')}}">
    </div>
    <div class="form-group col-md-6">
        <label>Pengeluaran</label>
        <input type="number" class="form-control" name="pengeluaran" value="{{$data->pengeluaran ?? old('pengeluaran')}}">
    </div>
    @error('pemasukan')
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p><i class="icon fas fa-ban"></i> {{$message}}</p>
        </div>
    @enderror
  </div>

<div class="form-group" class="row">
    <label for="deskripsi">Deskripsi</label>
    <textarea id="deskripsi" class="form-control h-auto" rows="7" placeholder="Deskripsi" name="deskripsi">{{$data->deskripsi ?? old('deskripsi')}}</textarea>

    @error('deskripsi')
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p><i class="icon fas fa-ban"></i> {{$message}}</p>
        </div>
    @enderror
</div>
<div class="form-group">
    <label>Tanggal</label>
    <input type="date" class="form-control" rows="3" name="tanggal" value="{{ $data->tanggal ?? old('tanggal')}}">
    @error('tanggal')
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p><i class="icon fas fa-ban"></i> {{$message}}</p>
        </div>
    @enderror
</div>