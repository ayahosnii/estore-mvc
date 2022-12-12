<h1><?= $text_header ?></h1>
<div class="container">
    <a href="/users/create" class="button"><i class="fa fa-plus"></i><?= $text_new_item ?></a>
    <table class="data">
        <thead>
        <th><?= $text_table_username ?></th>
        <th><?= $text_table_group ?></th>
        <th><?= $text_table_email ?></th>
        <th><?= $text_table_subscription_date ?></th>
        <th><?= $text_table_last_login ?></th>
        <th><?= $text_table_controller ?></th>
        </thead>
        <tbody>
        <?php if (false !== $users): foreach ($users as $user): ?>
                <tr>
                    <td><?= $user->Username?></td>
                    <td><?= $user->GroupName?></td>
                    <td><?= $user->Email?></td>
                    <td><?= $user->SubscriptionDate?></td>
                    <td><?= $user->LastLogin?></td>
                    <td>
<!--                        <a href="/employee/edit/--><?//= $user->id?><!--"><i class="fa fa-edit"></i></a>-->
<!--                        <a href="/employee/delete/--><?//= $user->id?><!--" onclick="if (!confirm('--><?//= $text_delete_confirm ?>//')) return false"><i class="fa fa-times"></i></a>
                    </td>
                </tr>

                <?php endforeach; endif; ?>


        </tbody>
    </table>

</div>