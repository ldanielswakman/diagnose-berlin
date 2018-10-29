<div class="comparison isHidden">

    <?php

    // get Tablepress table ID based on passed $table_no variable
    $table_no = (isset($table_no)) ? $table_no : 1;
    $table_id = get_field('group_' . $table_no . '_table');

    // get Tablepress table
    $table = tablepress_get_table([
        'id' => $table_id,
        'use_datatables' => false,
        'print_name' => false,
        'alternating_row_colors' => false,
        'first_column_th' => true,
    ]);

    // parse table data (custom) and echo result
    echo parseTablePressTable(utf8_decode($table));
    ?>

</div>
