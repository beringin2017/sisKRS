<?php
include 'koneksi.php';
include 'navbar.php';

if (isset($_POST['simpan'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $asal = $_POST['asal'];

    // Check if a file is selected for upload
    if ($_FILES['photo']['name']) {
        $photo_name = $_FILES['photo']['name'];
        $photo_tmp = $_FILES['photo']['tmp_name'];

        // Extract file extension from the original filename
        $extension = pathinfo($photo_name, PATHINFO_EXTENSION);

        // Generate a new filename using the 'NIM' input
        $new_filename = $nim . '.' . $extension;

        // Move the uploaded file to a desired directory with the new filename
        move_uploaded_file($photo_tmp, "uploads/" . $new_filename);
    } else {
        $new_filename = '';
    }

    // Insert the data into the database
    $insert = mysqli_query($conn, "INSERT INTO tb_mahasiswa (nim, nama, prodi, asal, photo) VALUES 
                ('$nim', '$nama', '$prodi', '$asal', '$new_filename')");

    if ($insert) {
        echo "Data successfully saved.";
    } else {
        echo "Failed to save data.";
    }
}
?>

<h3> <center>Input Data Mahasiswa</center>  </h3>
<div class="container">
    <a class="btn btn-primary" href="index.php"> Data Mahasiswa </a>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nim">NIM</label>
            <input type="text" name="nim" class="form-control" placeholder="Masukkan NIM" required>
        </div>
        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Lengkap" required>
        </div>
        <div class="form-group">
            <label for="prodi">Prodi</label>
            <input type="text" name="prodi" class="form-control" placeholder="Masukkan Prodi" required>
        </div>
        <div class="form-group">
            <label for="asal">Asal</label>
            <input type="text" name="asal" class="form-control" placeholder="Masukkan Asal" required>
        </div>
        <div class="form-group">
            <label for="photo">Upload Photo</label>
            <input type="file" name="photo" class="form-control-file" required>
        </div>
        <br>
        <input class="btn btn-success" type="submit" name="simpan" value="Simpan">
    </form>
</div>
