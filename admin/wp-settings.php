<?php
wp_enqueue_style('lostyle');
?>
<div class="wrap">
    <?php
    global $wpdb;
    $name="";
    $description="";
    $table_name=$wpdb->prefix . "wsf_target";
    
    if (isset($_POST["target"])){
        ?>
        
        <div class='updated'>
            <p>
                <?php
                $name=sanitize_text_field($_POST["target"]);
                $description=sanitize_text_field($_POST["description"]);
                $table_name=$wpdb->prefix . "wsf_target";
                
                // insert or update target, only one target is possible in this version
            
            $target=$wpdb->get_row("SELECT * FROM " . $table_name);
            if ($target==null){
                $wpdb->insert (
                    $table_name,
                    array(
                        'name' => $name,
                        'description' => $description,
                        'active' => true
                        )
                    );
            }
            
            else {
                $id=$target->id;
                $wpdb->update(
                    $table_name,
                    array(
                        'name' => $name,
                        'description' => $description,
                        'active' => true
                        ),
                    array('id'=>$id)
                 );
            }
            
            _e('Settings saved.',PLUGIN_NAME);
            ?>
            </p>
        </div>
    <?php     }
    else {
        $target=$wpdb->get_row("SELECT * FROM " . $table_name);
        if ($target != null) {
            $name=$target->name;
            $description=$target->description;
        }
        
    }
    ?>
    
    <h2><?php _e('Target Settings',PLUGIN_NAME);?></h2>
    <form method="post" action="">
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row">
                        <label for="target"> <?php _e('Name', PLUGIN_NAME);?>:</label>
                    </th>
                    <td>
                        <input id="target" name="target" size='30' maxlength='30' value="<?php print($name);?>">
                    </td>
                </tr>
                <<tr valign="top">
                    <th scope="row">
                        <label for="description"><?php _e('Description', PLUGIN_NAME);?>:</label>
                    </th>
                    <td>
                        <textarea id="description" name="description"><?php print($description); ?></textarea>
                    </td>
                </tr>
            </tbody>
        </table>
        <input type='submit' class='button button-primary' value='<?php _e('Save',PLUGIN_NAME) ?>'>
    </form>
    
</div>

