<?php
include 'koneksi.php';
include 'navbar.php';

// Retrieve list of available mahasiswa from the database
$query = mysqli_query($conn, "SELECT nim, nama FROM tb_mahasiswa");
$mahasiswaList = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>Data Mahasiswa</title>
  <style>
    .student-info {
      display: flex;
      align-items: flex-start;
    }

    .student-info img {
      margin-left: 20px;
      max-width: 200px;
      max-height: 200px;
    }
  </style>
</head>

<body>
  <div class="container">
    <br>
    <h3>
      <center> Data Mahasiswa dan KRS </center>
    </h3>
  </div>

  <div class="container">
    <form method="post" action="">
      <div class="form-group">
        <label for="mahasiswaDropdown">Pilih Mahasiswa:</label>
        <select class="form-control" id="mahasiswaDropdown" name="mahasiswa_nim">
          <?php foreach ($mahasiswaList as $mahasiswa) : ?>
            <option value="<?php echo $mahasiswa['nim']; ?>"><?php echo $mahasiswa['nama']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Tampilkan Data</button>
      </div>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $mahasiswaNIM = $_POST['mahasiswa_nim'];

      // Retrieve the selected mahasiswa data from the database
      $query = mysqli_query($conn, "SELECT * FROM tb_mahasiswa WHERE nim = '$mahasiswaNIM'");
      $selectedMahasiswa = mysqli_fetch_assoc($query);
    ?>
      <div class="student-info">
        <table class="table table-striped">
          <tbody>
            <tr>
              <th width="30%">Tahun</th>
              <td width="70%">: 2022/2023</td>
            </tr>
            <tr>
              <th>Semester</th>
              <td>: Genap</td>
            </tr>
            <tr>
              <th>Nama</th>
              <td>: <?php echo $selectedMahasiswa["nama"]; ?></td>
            </tr>
            <tr>
              <th>NIM</th>
              <td>: <?php echo $selectedMahasiswa["nim"]; ?></td>
            </tr>
            <tr>
              <th>Program Studi</th>
              <td>: <?php echo $selectedMahasiswa["prodi"]; ?></td>
            </tr>
          </tbody>
        </table>
        <img src="uploads/<?php echo $selectedMahasiswa['photo']; ?>" alt="Student Photo">
      </div>
    <?php } ?>
  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>
