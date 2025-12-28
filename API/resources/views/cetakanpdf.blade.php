<style>
    table, th, td {
        border: 1px solid;
        padding: 5px;
    }
    .warna {
        background-color: maroon;
        color: white;
    }
</style>

<h1 style="text-align: center">Daftar Pelanggan</h1>

<table style="border-collapse: collapse; width: 100%;">
    <tr>
        <td style="width: 5%;" class="warna">ID</td>
        <td style="width: 25%;" class="warna">Nama</td>
        <td style="width: 15%;" class="warna">Jenis Kelamin</td>
        <td style="width: 40%;" class="warna">Alamat</td>
        <td style="width: 15%;" class="warna">Telp</td>
    </tr>

    <?php foreach ($dtpel as $k) {
        $id = $k->id_pelanggan;
        $nama = $k->nama_pelanggan;
        $jk = $k->jenis_kelamin == "L" ? "Laki-Laki" : "Perempuan";
        $alamat = $k->alamat;
        $telp = $k->no_telp;

        echo "<tr>
            <td>$id</td>
            <td>$nama</td>
            <td>$jk</td>
            <td>$alamat</td>
            <td>$telp</td>
        </tr>";
    } ?>
</table>
