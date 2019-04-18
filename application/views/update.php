<form method="POST">
	<input type="hidden" name="id_minuman" value="<?=$data->id_minuman?>">
	<div class="form-group">
	    <label>Nama Minuman</label>
		<input type="text" name="nama" class="form-control" placeholder="Nama Minuman" value="<?=$data->nama?>">
	</div>
	<div class="form-group">
		<label>Harga</label>
		<input type="text" name="harga" class="form-control" placeholder="Harga Minuman" value="<?=$data->harga?>">
	</div>
	<div class="form-group">
		<label>Stok</label>
		<input type="text" name="stok" class="form-control" placeholder="Stok" value="<?=$data->stok?>">
	</div>
	<button type="submit" class="btn btn-primary" name="submit" value="1!1">Simpan</button>
</form>