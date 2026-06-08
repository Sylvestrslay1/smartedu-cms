<div class="admin-head">
    <div><span>CMS</span><h1>O‘qituvchilar</h1></div>
    <a class="btn primary" href="?r=admin/teacher-form">Yangi o‘qituvchi</a>
</div>
<table>
    <thead><tr><th>F.I.O</th><th>Mutaxassislik</th><th>Tajriba</th><th>Telefon</th><th>Amal</th></tr></thead>
    <tbody>
    <?php foreach ($teachers as $teacher): ?>
        <tr>
            <td><?= $this->e($teacher['full_name']) ?></td>
            <td><?= $this->e($teacher['specialty']) ?></td>
            <td><?= (int) $teacher['experience'] ?> yil</td>
            <td><?= $this->e($teacher['phone']) ?></td>
            <td class="actions">
                <a href="?r=admin/teacher-form&id=<?= (int) $teacher['id'] ?>">Tahrirlash</a>
                <a class="danger-link" onclick="return confirm('O‘chirishni tasdiqlaysizmi?')" href="?r=admin/teacher-delete&id=<?= (int) $teacher['id'] ?>">O‘chirish</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
