<style>

    div.wrapper {
        overflow: hidden;

    }
    div.wrapper div.empform{
        float: left;

    }

    div.wrapper div.employees{
        margin: 0 auto;
        width: 700px;
    }

    form.app_form{
        width: 500px;
        margin: 20px;
    }

    form.app_form fieldset{
        padding: 10px;
        background: #f1f1f1;
        border: solid 1px #e4e4e4;
    }
    form.app_form fieldset legend{
        font: 1em 'Arial, Helvetice, sans-serif';
        color: #666;
        background: #e4e4e4;
        padding: 5px;
    }

    form.app_form fieldset p.message{
        background: #9adc81;
        border: #5daf00;
        color: #000000;
        padding: 5px;
        margin: 3px;
        border-radius: 3px;
    }
    form.app_form fieldset p.message.error{
        background: #dc8181;
        border: #af0000;
        color: #000000;
        padding: 5px;
        margin: 3px;
    }

    form.app_form table {
        width: 100%;
    }
    form.app_form label {
        font-family: Arial;
        color: #666666;
    }
    form.app_form table tr td input/*[type=text]*/{
        width: 90%;
        padding: 2%;
        font-size: 1em;

    }
    form.app_form table tr td input[type=submit]{
        padding: 8px;
        border-radius: 3px;
        background: darkcyan;
        color: #fff;
        font-family: Arial;
        font-size: 1em;
        cursor: pointer;
    }
    form.app_form table tr td{
        padding: 4px;
    }

    div.wrapper div.employees table{
        width: 780px;
        margin: 20px 20px 0 0;
        border-collapse: collapse;
    }

    div.wrapper div.employees table thead th{
        text-align: left;
        padding: 5px;
        border-left: solid 2px #e4e4e4;
        border-bottom: solid 2px #e4e4e4;
        font: bold 0.9em Arial Helvetica, sans-serif;
    }

    div.wrapper div.employees table thead th:last-of-type{
        border-right: none;
    }

    div.wrapper div.employees table tbody td{
        text-align: left;
        padding: 5px;
        border: solid 1px #e4e4e4;
        font: bold 0.9em Arial Helvetica, sans-serif;
    }

    div.wrapper div.employees table tbody td a:link,
    div.wrapper div.employees table tbody td a:visited{
        color: darkcyan;
    }
</style>

<link rel="stylesheet" href="../../public/main.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">



<div class="wrapper">
    <?php if (isset($_SESSION['message'])) { ?>
        <p class="message <?= isset($error) ? 'error' : '' ?>"> <?= $_SESSION['message'] ?></p>
        <?php
        unset($_SESSION['message']);
    }
    ?>
    <div class="employees">
        <a href="/employee/add"
           style="background-color: darkcyan; color: #FFF; padding: 10px; font-family: Arial;
                  font-size: 1em; cursor: pointer; border-radius: 3px; text-decoration: none;" ><?= $text_add_employee ?></a>
        <table>
            <thead>
            <th><?= $text_table_employee_name ?></th>
            <th><?= $text_table_employee_age ?></th>
            <th><?= $text_table_employee_address ?></th>
            <th><?= $text_table_employee_salary ?></th>
            <th><?= $text_table_employee_tax ?> (%)</th>
            <th><?= $text_table_employee_controller ?></th>
            </thead>
            <tbody>
            <?php
            if (false !== $employees) {
                foreach ($employees as $employee) {
                    ?>
                    <tr>
                        <td><?= $employee->name?></td>
                        <td><?= $employee->age?></td>
                        <td><?= $employee->address?></td>
                        <td><?= $employee->calculateSalary()?> LE</td>
                        <td><?= $employee->tax?></td>
                        <td>
                            <a href="/employee/edit/<?= $employee->id?>"><i class="fa fa-edit"></i></a>
                            <a href="/employee/delete/<?= $employee->id?>" onclick="if (!confirm('<?= $text_delete_confirm ?>')) return false"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>

                    <?php
                }
            } else {
                ?>
                <td colspan="5"><p>Sorry no employees in this list</p></td>
                <?php
            }
            ?>

            </tbody>
        </table>
    </div>
</div>

