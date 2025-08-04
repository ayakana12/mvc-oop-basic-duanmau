<div class="container">
    <h1 class="bl-heading">Quản lý Tài Khoản</h1>
    
    <div class="table-wrapper">
        <table border="1" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo htmlspecialchars($user['name']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><span class="masked-password">********</span> </td>
                    
                    <td><?php echo htmlspecialchars($user['role']); ?></td>
                    <td>
                        <a href="<?php echo BASE_URL . '?act=edit_user&id=' . $user['id']; ?>" class="btn-edit">Khóa</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
.container {
    max-width: 100%; /* Cho phép chiếm toàn bộ chiều ngang */
    width: 100%;
    padding: 20px;
    font-family: Arial, sans-serif;
}

.bl-heading {
    font-size: 1.8rem;
    margin: 20px auto;
    text-align: center;
    font-weight: bold;
    color: #333;
}

.table-wrapper {
    max-height: 600px; /* Chiều cao tối đa trước khi có thanh cuộn */
    overflow-y: auto;
    overflow-x: auto;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    background-color: #fff;
}

.table {
    width: 100%;
    border-collapse: collapse;
    min-width: 1000px; /* Giúp bảng luôn đủ rộng */
}

.table thead th {
  
    color: white;
    font-weight: bold;
    text-align: center;
    padding: 16px 24px;
    position: sticky;
    top: 0;
    z-index: 1;
    border-bottom: 2px solid #ddd;
    font-size: 1.05rem;
     background: #2c3e50;
}

.table th,
.table td {
    padding: 16px 24px;
    text-align: center;
    border-bottom: 1px solid #ddd;
    font-size: 1.05rem;
}

.table-striped tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

.table-striped tbody tr:hover {
    background-color: #f1f1f1;
}

.btn-edit {
    padding: 8px 14px;
    background-color: #e74c3c;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    font-size: 0.95rem;
    transition: background-color 0.3s ease;
}

.btn-edit:hover {
    background-color: #c0392b;
}
</style>
