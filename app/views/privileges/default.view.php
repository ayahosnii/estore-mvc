<h1><?= $text_header ?></h1>
<div class="container">
    <a href="/privileges/create" class="button"><i class="fa fa-plus"></i><?= $text_new_item ?></a>
    <table class="data">
        <thead>
        <th><?= $text_table_privilege ?></th>
        <th><?= $text_table_privilege ?></th>
        <th><?= $text_table_controller ?></th>
        </thead>
        <tbody>
        <?php if (false !== $privileges): foreach ($privileges as $privilege): ?>
                <tr>
                    <td><?= $privilege->PrivilegeTitle?></td>
                    <td><?= $privilege->Privilege?></td>
                    <td>
                        <a href="/privileges/edit/<?= $privilege->PrivilegeId?>"><i class="fa fa-edit"></i></a>
                        <a href="/privileges/delete/<?= $privilege->PrivilegeId?>" onclick="if (!confirm('<?= $text_delete_confirm ?>//')) return false"><i class="fa fa-times"></i></a>
                    </td>
                </tr>

                <?php endforeach; endif; ?>


        </tbody>
    </table>

</div>