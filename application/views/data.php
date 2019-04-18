<div class="row">
	<div class="col">
		<a href="<?=base_url('home/add')?>" class="btn btn-primary">Tambah</a>	
	</div>
</div>
<div class="row">
	<div class="col">
		<table class="table table-striped">
		  <thead>
		    <tr>
		      <th scope="col">ID Minuman</th>
		      <th scope="col">Nama Minuman</th>
		      <th scope="col">Harga</th>
		      <th scope="col">Stok</th>
		      <th scope="col">Action</th>
		    </tr>
		  </thead>
		  <tbody>
		    <?php foreach ($data as $dt) { ?>
				<tr>
					<td scope="row"><?=$dt->id_minuman?></td>
					<td><?=$dt->nama?></td>
					<td><?=$dt->harga?></td>
					<td><?=$dt->stok?></td>
					<td>
						<a href="<?=base_url("home/edit/$dt->id_minuman")?>" class="btn btn-warning" >Edit</a>
						<a href="<?=base_url("home/delete/$dt->id_minuman")?>" class="btn btn-danger">Hapus</a>
					</td>
				</tr>
			<?php } ?>
		  </tbody>
		</table>
	</div>
</div>