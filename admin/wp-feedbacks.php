

<div class="wrap">
    <h3>Feedbacks</h3>
<table class="wp-list-table">
    
    <!--<thead>-->
    <!--<tr>-->
    <!--    <th class="manage-column check-column"></th>-->
    <!--    <th class="column-title"><?php _e('Feedback value',PLUGIN_NAME); ?></th>-->
    <!--    <th><?php _e('Feedback text',PLUGIN_NAME); ?></th>-->
    <!--</tr>-->
    <!--</thead>-->
    <!--<tfoot>-->
    <!--    <tr class="">-->
    <!--        <th></th>-->
    <!--        <th><?php _e('Feedback value',PLUGIN_NAME); ?></th>-->
    <!--        <th><?php _e('Feedback text',PLUGIN_NAME); ?></th>-->
    <!--    </tr>-->
    <!--</tfoot>-->
    <tbody>
        
        <?php
        global $wpdb;
        $table_name=$wpdb->prefix . "wsf_feedback";
        
        $sql="SELECT * FROM " . $table_name;
        
        $feedbacks=$wpdb->get_results($sql);
        
        if($feedbacks) {
            foreach($feedbacks as $feedback) {
                print "<tr>";
                // print "<td><input type='checkbox' name='id[] value='" . $feedback->id . "'></td>";
                print "<td>" . sanitize_text_field($feedback->feedback_value) . "</td>";
                print "<td>" . sanitize_text_field($feedback->feedback_text) . "</td>";
                print "</tr>";
            }
        }
        ?>
    </tbody>
</table>

    </div>
    
