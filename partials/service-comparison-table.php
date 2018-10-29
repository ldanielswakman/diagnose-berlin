<div class="comparison">

    <?php
    echo $table_no;
    $table_id = get_field('group_' . $table_no . '_table');

    $table = tablepress_get_table([
        'id' => $table_id,
        'use_datatables' => false,
        'print_name' => false,
        'alternating_row_colors' => false,
        'first_column_th' => true,
    ]);
    ?>

    <?php echo parseTablePressTable($table) ?>

</div>
