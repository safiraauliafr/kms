<html>

<head>
    <title>Cetak PDF</title>
    <style>
    table {
        border-collapse: collapse;
        table-layout: fixed;
        width: 630px;
    }

    table td {
        word-wrap: break-word;
        width: 20%;
    }
    </style>
</head>

</html>

<body>
    <!-- <b><?php echo $ket; ?></b><br /><br /> -->

    <table border="1" cellpadding="8">
        <tr>
            <th>Tanggal</th>
            <th>ID Notulensi</th>
            <th>Nama User</th>
            <th>Isi Notulensi</th>
        </tr>
        <?php
    if (!empty($notulensi)) {
      $no = 1;
      foreach ($notulensi as $data) {
        $tgl = date('d-m-Y', strtotime($data->tgl));
        echo "<tr>";
        echo "<td>" . $tgl . "</td>";
        echo "<td>" . $data->id_notulensi . "</td>";
        echo "<td>" . $data->nama_user . "</td>";
        echo "<td>" . $data->isi_notulensi . "</td>";
        echo "</tr>";
        $no++;
      }
    }
    ?>
    </table>

</body>

</html>