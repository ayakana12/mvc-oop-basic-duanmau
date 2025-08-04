<style>
    .bl-container {
  width: 95%;
  max-width: 1200px;
  margin: 20px auto;
  text-align: center;
}

.bl-heading {
  font-size: 1.3rem;
  margin-bottom: 12px;
  text-align: center;
}

.table-vertical-scroll {
    width: 95%;
    max-height: 480px;
    overflow-y: auto;
    overflow-x: hidden;
    margin: 60px auto;
  
    padding-bottom: 4px;
    border-radius: 8px;
    box-shadow: 0 2px 8px #0001;
    background: #fff;
}
.table-vertical-scroll table {
    border-collapse: collapse;
    width: 100%;
    min-width: 1100px;
    table-layout: fixed;
}
.table-vertical-scroll thead th {
    position: sticky;
    top: 0;
    background: #2c3e50;
    color: #f1c40f;
    z-index: 2;
    font-weight: bold;
}
.table-vertical-scroll th, .table-vertical-scroll td {
    border: 1px solid #e1e1e1;
    padding: 8px 10px;
    text-align: center;
}
.table-vertical-scroll td img {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    object-fit: cover;
    border: 1px solid #eee;
}
.btn-delete-cmt {
    background: #e74c3c;
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 4px 12px;
    cursor: pointer;
    font-size: 13px;
    transition: background 0.2s;
}
.btn-delete-cmt:hover {
    background: #c0392b;
}

</style>
<div class="bl-container">
<h1 style="font-size:1.3rem;margin:8px auto 8px auto; text-align: center;" class="bl-heading">Quản lý bình luận</h1>

<div class="table-vertical-scroll">
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>Tên người dùng</th>
            <th>Avatar</th>
            <th>Nội dung</th>
            <th>Ngày</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
    <?php if (!empty($binhluan)) foreach ($binhluan as $cmt): ?>
    <tr>
        <td><?= $cmt['id'] ?></td>
        <td><?= htmlspecialchars($cmt['product_name'] ?? '') ?></td>
        <td><?= htmlspecialchars($cmt['user_name'] ?? $cmt['name']) ?></td>
        <td>
            <?php if (!empty($cmt['avata'])): ?>
                <img src="<?= BASE_ASSETS_UPLOADS . $cmt['avata'] ?>" alt="avatar">
            <?php else: ?>
                <span style="color:#888;">(No avatar)</span>
            <?php endif; ?>
        </td>
        <td style="text-align:left;max-width:320px;word-break:break-word;white-space:pre-line;">
            <?= htmlspecialchars($cmt['noidung']) ?>
        </td>
        <td><?= $cmt['date'] ?></td>
        <td>
            <a href="<?= BASE_URL.'?act=deletecomment&id='.$cmt['id'] ?>" class="btn-delete-cmt" onclick="return confirm('Xác nhận xóa bình luận này?')">Xóa</a>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>


</div>

