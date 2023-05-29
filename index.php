<?php
    $server = "localhost";
    $user = "root";
    $password = "";
    $db = "dbkelompok2";

    //buat koneksi
    $koneksi = mysqli_connect($server, $user, $password, $db) or die(mysqli_error($koneksi));


    //jika tombol simpan diklik
    if(isset($_POST['bsimpan'])){

        //Data baru akan disimpan kedalam variabel simpan
        $simpan_query = "INSERT INTO tbarang (kode, nama, asal, jumlah, satuan, tanggal_diterima) 
                         VALUE ( '$_POST[tkode]',
                                  '$_POST[tnama]',
                                  '$_POST[tasal]',
                                  '$_POST[tjumlah]',
                                  '$_POST[tsatuan]',
                                  '$_POST[ttanggal_diterima]')";
        $simpan = mysqli_query($koneksi, $simpan_query) or die ("Proses update data GAGAL! <br> ");

        //uji jika simpan data sukses
        if($simpan){
            echo "<script>
                        alert('Simpan Data Sukses!');
                        document.location = 'index.php';
                  </script>";
        }else{
            echo "<script>
                        alert('Simpan Data Sukses!');
                        document.location = 'index.php';
                  </script>";
        }
    }


    //deklarasi variabel untuk menampung data yang akan diedit
    $vkode = "";
    $vnama = "";
    $vasal = "";
    $vjumlah = "";
    $vsatuan = "";
    $vtanggal_diterima = "";

    //pengujian jika tombol edit / hapus diklik
    if(isset($_GET['hal'])){

        //jika edit data diklik
        if($_GET['hal'] == "edit"){
            //tampilkan data yang akan diedit
            $tampil = mysqli_query($koneksi, "SELECT * FROM tbarang where id_barang = '$_GET[id]' ");
            $data = mysqli_fetch_array($tampil);
            if($data){
                //Jika data ditemukan, maka data akan ditampung dalam variabel
                $vkode = $data['kode'];
                $vnama = $data['nama'];
                $vasal = $data['asal'];
                $vjumlah = $data['jumlah'];
                $vsatuan = $data['satuan'];
                $vtanggal_diterima = $data['tanggal_diterima'];
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD PHP & MySQL + Bootstrap 5</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>

  <body>
    <!-- ini awal container -->
    <div class="container">
        <h3 class="text-center">Data Inventaris</h3>
        <h3 class="text-center">Kantor Ngoding Pintar</h3>

        <!-- awal row -->
        <div class="row">
            <!-- awal col -->
            <div class="col-md-8 mx-auto">
                <!-- Awal Card -->
                <div class="card">
                    <div class="card-header bg-info text-light">
                        Form Input Data Barang
                    </div>
                    <div class="card-body">
                        <!-- awal form -->
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Kode Barang</label>
                                <input type="text" name="tkode" value="<?= $vkode?>"class="form-control" placeholder="Masukkan Kode Barang">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Barang</label>
                                <input type="text" name="tnama" value="<?= $vnama?>" class="form-control" placeholder="Masukkan Nama Barang">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Asal Barang</label>
                                <select class="form-select" name="tasal" value="<?= $vasal?>">
                                    <option>-Pilih-</option>
                                    <option value="Pembelian">Pembelian</option>
                                    <option value="Hibah">Hibah</option>
                                    <option value="Sumbangan">Sumbangan</option>
                                    <option value="Bantuan">Bantuan</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Jumlah</label>
                                        <input type="number" name="tjumlah" value="<?= $vjumlah?>" class="form-control" placeholder="Masukkan Jumlah Barang">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Satuan</label>
                                        <select class="form-select" name="tsatuan" value="<?= $vsatuan?>">
                                            <option>-Pilih-</option>
                                            <option value="Unit">Unit</option>
                                            <option value="Kotak">Kotak</option>
                                            <option value="Pcs">Pcs</option>
                                            <option value="Pak">Pak</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Diterima</label>
                                        <input type="date" name="ttanggal_diterima" value="<?= $vtanggal_diterima?>"  class="form-control" placeholder="Masukkan Jumlah Barang">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <hr>
                                    <button class="btn btn-primary" name="bsimpan" type="submit">Simpan</button>
                                    <button class="btn btn-danger" name="bkosongkan" type="reset">Kosongkan</button>
                                </div>
                            </div>

                        </form>

                        <!-- akhir form -->
                    </div>
                    <div class="card-footer bg-info">
                       
                    </div>
                </div>
                <!-- Akhir Card -->
            </div>
            <!--Akhir col -->
        </div>
        <!-- Akhir row -->
        
        <!-- Awal Card -->
                <div class="card mt-3">
                    <div class="card-header bg-info text-light">
                        Data Barang
                    </div>
                    <div class="card-body">
                        <div class="col-md-8 mx-auto">
                            <form method="POST"">
                                <div class="input-group mb-3">
                                    <input type="text" name="tcari" class="rounded-pill form-control" placeholder="Masukan Kata Pencarian Anda!">
                                    <img src="image.png" alt="">
                                    <button class="btn btn-primary rounded-pill col-md-2 mx-3" type="bcari">Cari</button>
                                    <button class="btn btn-danger rounded-pill col-md-2" type="breset">Reset</button>
                                </div>
                            </form>
                        </div>
                        <table class="table table-striped table-hover table-bordered"> 
                            <tr>
                                <th>No.</th>
                                <th>Kode barang</th>
                                <th>Nama Barang</th>
                                <th>Asal Barang</th>
                                <th>Jumlah</th>
                                <th>Tanggal Diterima</th>
                                <th>Aksi</th>
                            </tr>
                            <?php
                                //Persiapan menampilkan data
                                $no = 1;
                                $data_query = "SELECT * FROM tbarang order by id_barang desc";
                                $tampil = mysqli_query($koneksi, $data_query);
                                while($data = mysqli_fetch_array($tampil)) :
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data['kode'] ?></td>
                                <td><?= $data['nama'] ?></td>
                                <td><?= $data['asal'] ?></td>
                                <td><?= $data['jumlah'] ?> <?= $data['satuan'] ?></td>
                                <td><?= $data['tanggal_diterima'] ?></td>
                                <td>
                                    <a href="index.php?hal=edit&id=<?= $data['id_barang'] ?>" class="btn btn-warning">Edit</a>
                                    <a href="index.php?hal=hapus&id=<?= $data['id_barang'] ?>" class="btn btn-danger">Hapus</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </table>
                    </div>
                    <div class="card-footer bg-info">
                       
                    </div>
                </div>
        <!-- Akhir Card -->
    


    </div>
    <!-- ini akhir container -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>

</html>