<?php
wp_enqueue_style('lostyle');

global $wpdb;

$description="";
$name="";
$time="";
$feedback_value="";
$feedback_text="";
$disabled="";

$table_name=$wpdb-> prefix . "wsf_target";
$target=$wpdb->get_row("SELECT * FROM " . $table_name);

if($target!=null) {
    $description=$target->description;
    $name=$target->name;
}

if(isset($_POST["feedback_value"])) {
?>

<div class='updated'>
    <p>
        
    <?php
    
    $feedback_value=($_POST["feedback_value"]);
    $feedback_text=sanitize_text_field($_POST["feedback_text"]);
    
    if($target!=null) {
        $target_id=$target->id;
        $table_name=$wpdb->prefix . "wsf_feedback";
        
        $wpdb->insert (
            $table_name,
            array(
                'time' => ($time=date('Y-m-d H:i:s')),
                'feedback_value' => $feedback_value,
                'feedback_text' => $feedback_text,
                $wpdb->prefix . 'wsf_target_id' => $target_id
                )
                );
                
                _e('Thank you for your feedback.',PLUGIN_NAME);
                $disabled= "disabled";
    }
    
    else {
        _e('There is no target that you can give feedback.',PLUGIN_NAME);
    }
    ?>
    </p>
</div>
  
  <?php  
}
?>


<div class="entry_content">
    <h3><?php print $name;?>
    <?php print $description; ?>
    </h3>
   
    
    <form method="post" action="">
        
       
        
        <label for=""><?php _e('Feedback', PLUGIN_NAME); ?>:</label>
        <input type="radio" name="feedback_value"
        <?php if (isset($feedback_value) && $feedback_value=="excellent") echo $feedback_value;?>
        value="5">Excellent
        <br />
        <input type="radio" name="feedback_value"
        <?php if (isset($feedback_value) && $feedback_value=="good") echo "checked";?>
        value="4">Good
        <br />
        <input type="radio" name="feedback_value"
        <?php if (isset($feedback_value) && $feedback_value=="moderate") echo "checked";?>
        value="3">Moderate
        <br />
        <input type="radio" name="feedback_value"
        <?php if (isset($feedback_value) && $feedback_value=="satisfactory") echo "checked";?>
        value="2">Satisfactory
        <br />
        <input type="radio" name="feedback_value"
        <?php if (isset($feedback_value) && $feedback_value=="poor") echo "checked";?>
        value="1">Poor
        <br />
        
        <label for=""><?php _e('Freeword',PLUGIN_NAME); ?>:</label>
        <textarea id="feedback_text" name="feedback_text"><?php echo $feedback_text; ?></textarea>
        <div class = "button">
            <input type="submit" value="<?php _e('Send',PLUGIN_NAME);?>">
 
 
        </div>
        
    </form>
    </div>
    

