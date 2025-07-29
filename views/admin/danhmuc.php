<?php
$edit_id = isset($_GET['id']) ? $_GET['id'] : null;
?>
<div class="container">
<div class="tk">
<p>Danh Mục</p>

<!-- Form thêm danh mục mới -->
<form action="<?= BASE_URL .'?act=adddmuc'?>" method="post" style="margin-bottom: 20px;" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Tên danh mục" required>
    <button type="submit">Thêm danh mục</button>
</form>

</div>
<table>
    <tr>
        <th>ID</th>
        <th>Tên Danh mục</th>
        <th>Hành động</th>
    </tr>
    <?php
    foreach($Categories as $item){
        if ($edit_id == $item['id']) {
            // Hiển thị form sửa trực tiếp trên dòng này
            ?>
            <form action="<?= BASE_URL.'?act=updatedmuc' ?>" method="post">
            <tr>
                <td><?= $item['id'] ?><input type="hidden" name="id" value="<?= $item['id'] ?>"></td>
                <td><input type="text" name="name" value="<?= htmlspecialchars($item['name']) ?>" required></td>
          
                <td>
                    <button type="submit">Lưu</button>
                    <a href="<?= BASE_URL.'?act=category' ?>">Hủy</a>
                </td>
            </tr>
            </form>
            <?php
        } else {
            ?>
            <tr>
                <td><?= $item['id'] ?></td>
                <td><?= $item['name'] ?></td>
                <td>
                    <a href="<?= BASE_URL.'?act=edit_id&id='.$item['id'] ?>">Sửa</a>
                    <a href="<?= BASE_URL.'?act=deletedmuc&id='.$item['id'] ?>" onclick="return confirm('Xác nhận xóa?')" class="delete">Xóa</a>
                </td>
            </tr>
            <?php
        }
    }
    ?>
</table>
</div>
<style>
    .container {
        width: 70%;
        margin-left: 10%;
    }
    p {
      font-size: 30px;
      margin-bottom: 20px;
    }


    /* Chỉ sửa phần table, th, td, a */
table {
  width: 100%;
  border-collapse: collapse;
  background: #fff;
  box-shadow: 0 2px 8px #d1d9e6;
  border-radius: 8px;
  overflow: hidden;

}

th, td {
  border: 1px solid #e1e4e8;
  padding: 12px 16px;
  text-align: center;
  font-size: 15px;
}

th {
  background: #2c3e50;
  color: #f1c40f;
  font-weight: bold;
  font-size: 16px;
  letter-spacing: 1px;
}

tr:nth-child(even) {
  background: #f8f9fa;
}

tr:hover td {
  background: #f1c40f22;
  transition: background 0.2s;
}

a {
  color:rgb(157, 193, 230);
  background: #34495e;
  padding: 6px 14px;
  border-radius: 4px;
  text-decoration: none;
  margin: 0 3px;
  font-weight: 500;
  transition: background 0.2s, color 0.2s;
  display: inline-block;
}

a:hover {
  background: #2c3e50;
  color: #f1c40f;
}
.delete {
    background-color: #e74c3c;
    color: white;
    margin-top: 5px;
}
</style>