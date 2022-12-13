<h1><?= $text_header ?></h1>
<div class="container">
    <a href="/usersgroups/create" class="button"><i class="fa fa-plus"></i><?= $text_new_item ?></a>
    <table class="data">
        <thead>
        <th><?= $text_table_group_name ?></th>
        <th><?= $text_table_controller ?></th>
        </thead>
        <tbody>
        <?php if (false !== $groups): foreach ($groups as $group): ?>
                <tr>
                    <td><?= $group->GroupName?></td>
                    <td>
<!--                        <a href="/employee/edit/--><?//= $user->id?><!--"><i class="fa fa-edit"></i></a>-->
<!--                        <a href="/employee/delete/--><?//= $user->id?><!--" onclick="if (!confirm('--><?//= $text_delete_confirm ?>//')) return false"><i class="fa fa-times"></i></a>
                    </td>
                </tr>

                <?php endforeach; endif; ?>


        </tbody>
    </table>

</div>