<tbody>
            <?php if ($transactions->num_rows === 0) : ?>
                <tr>
                    <td colspan="7">No data found.</td>
                </tr>
            <?php else : ?>
                <?php $i = 1; ?>
                <?php while ($row = mysqli_fetch_assoc($transactions)) : ?>
                    <tr>
                        <th scope="row"><?= $i++; ?></th>
                        <td>
                            <a href="produk/view.php?=<?= $row['produk_id'] ?>">
                                <?= $row['produk_nama']; ?> | <?= $row['produk_sn']; ?>
                            </a>
                        </td>
                        <td><?= $row['serah_nama']; ?></td>
                        <td><?= $row['terima_nama']; ?></td>
                        <td><?= $row['keterangan']; ?></td>
                        <td><?= $row['kuantiti']; ?></td>
                        <td><?= (new DateTime($row['tanggal']))->format('d F Y'); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php endif; ?>
        </tbody>