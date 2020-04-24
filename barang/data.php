<?php
include_once("../_header.php");
include 'action.php';
?>
<div>
    <hr>
    <?php
    if (isset($_SESSION['response'])) { ?>
    <div class="alert alert-<?= $_SESSION['res_type']; ?> alert-dismissable" text-center>
        <button type="button" class="close" data_dismiss="alert">&times;</button>
        <b><?= $_SESSION['response']; ?></b>
    </div>
    <?php }
    unset($_SESSION['response']) ?>
</div>
<a href="#menu-toggle" class="btn btn-primary" id="menu-toggle">Hide</a>

<div class="row">
    <div class="col-md-4">
        <?php
        $query = "SELECT * FROM crud";
        $stmt = $con->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        ?>
        <h3 class="text-center text-info">Tambah Data</h3>
        <form action="action.php" method="post" enctype="multipart/from-data">

            <input type="hidden" name="id" value="<?= $id; ?>">
            <div class="form-group">
                <input type="text" name="name" value="<?= $name; ?>" class="form-control" placeholder="Nama Barang"
                    required>
            </div>
            <div class="form-group">
                <input type="text" name="email" value="<?= $email; ?>" class="form-control" placeholder="Keterangan"
                    required>
            </div>
            <div class="form-group">
                <input type="text" name="phone" value="<?= $phone; ?>" class="form-control" placeholder="Stock"
                    required>
            </div>
            <div class="form-group">
                <input type="hidden" name="oldimage" value="<?= $photo; ?>">
                <input type="file" name="image" class="custom-file">
                <img src="<?= $photo; ?>" width="120" class="img-thumbnail">
            </div>
            <div class="form-group">
                <?php if ($update == true) { ?>
                <input type="submit" name="update" class="btn btn-success btn-block" value="update Record">
                <?php } else { ?>
                <input type="submit" name="add" class="btn btn-primary btn-block" value="Add Record">
                <?php } ?>
            </div>
        </form>
        <h3 class="text-center text-info">Data Barang Miniso</h3>
    </div>
    <div class="col-md-8">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID barang</th>
                    <th scope="col">Image</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">stock</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><img src="" width="25"></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['phone'] ?></td>
                    <td>
                        <a href="details.php?details=<?= $row['id']; ?>" class="badge badge-primary">Details</a>
                        <a href="action.php?delete=<?= $row['id']; ?>" class="badge badge-danger"
                            onclick="return confirm('apakah anda yakin menghapus');">Delete</a>
                        <a href="data.php?edit=<?= $row['id']; ?>" class="badge badge-success">Edit</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php
include_once("../_footer.php"); ?>