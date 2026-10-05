<?php 

require '../function.php';

$keyword 	= $_GET['keyword'];
$query 		= ("SELECT * FROM harbingers WHERE
			nama LIKE '%$keyword%' OR
			gelar LIKE '%$keyword%' OR
			vision LIKE '%$keyword%' OR
			region LIKE '%$keyword%'");
$harbingers = select($query);

?>
<table border="1" cellpadding="10" cellspacing="0" style="margin-bottom: 10px">
		<tr>
			<th>No.</th>
			<th>Aksi</th>
			<th>Image</th>
			<th>Nama</th>
			<th>Gelar</th>
			<th>Vision</th>
			<th>Region</th>
		</tr>
		<?php $i = 1; ?>
		<?php foreach ($harbingers as $hr) : ?>
			<tr>
				<td><?= $i; ?></td>
				<td><a href="update.php?id=<?= $hr['id'] ?>">update</a> | 
					<a href="delete.php?id=<?= $hr['id'] ?>" onClick="return confirm('yakin ingin menghapus data?');">delete</a></td>
				<td><img src="image/<?= $hr["image"]; ?>" alt="harbingers"></td>
				<td><?= htmlspecialchars($hr["nama"]); ?></td>
				<td><?= htmlspecialchars($hr["gelar"]); ?></td>
				<td><?= htmlspecialchars($hr["vision"]); ?></td>
				<td><?= htmlspecialchars($hr["region"]); ?></td>
			</tr>
			<?php $i++; ?>
		<?php endforeach; ?>
</table>