<?php
/*Controls registration form behavior on the front end*/
  $textdomain = 'ultimate-profile-builder';
  $path       =  plugin_dir_url(__FILE__);  // define path to link and scripts
  $pageURL    = get_permalink();
  $sign       = strpos($pageURL,'?')?'&':'?';
  global $wpdb;
  $upb_fields =$wpdb->prefix."upb_fields";
	extract($_REQUEST);
	if(isset($login2))
	{
		include('UPB_login_file.php');
	}
	else if(isset($login3))
	{
		include('UPB_recover_password_file.php');
	}
	else if(isset($login4))
	{
		include('UPB_view_profile_file.php');
	}
	else if(isset($changeavatar))
	{
		include 'UPB_edit_profile_image.php';
	}
	else if(isset($login5))
	{
		include('UPB_edit_profile_file.php');
	}
	else
	{
		
		global $wpdb;
		$upb_option=$wpdb->prefix."upb_option";
		$query="SELECT value FROM $upb_option WHERE fieldname='upb_autogeneratedepass'";
		$pwd_show = $wpdb->get_var($query);
		$qry="SELECT value FROM $upb_option WHERE fieldname='Registration_Custom_Text'";
		$Custom_Text = $wpdb->get_var($qry);
		
		$query="SELECT value FROM $upb_option WHERE fieldname='upb_recaptcha'";
		$captcha_show = $wpdb->get_var($query);
		
    if ( is_user_logged_in() ) // check if user logged in or not
    {
?>


<!--HTML when accessing registration form when user is already logged in-->
<div id="UPB-Standard-Form">
  <div id="UPB-Standard-Form-entry-content">
   <div class="UPB-Standard-Form-main-upb-form">
     <div class="already-logged">
      
      <div class="You-are-already-logged-in">
        <h3>You are already registered.</h3>
      </div><!--------------You-are-already-logged-in-------->
     
      <div class="clearfix text-center">
        <a  href="<?php echo site_url(); ?>">Go back to Home-Page</a> 
        <div class="clear"></div> 
      </div>

      <div class="clearfix text-center">
        <a  href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Logout">Logout</a>
        <div class="clear"></div> 
      </div>
    
      <div class="clear"></div>
    </div>
  </div>
  
  <div class="clear"></div>
  
  </div><!--------UPB-Standard-Form-entry-content-------->
  
 <div class="clear"></div>
</div><!------UPB-Standard-Form------>
<?php
		}
		else
		{
			
			if($captcha_show=='yes')
			{
			require_once('recaptchalib.php');//Displays recaptcha
			// Get a key from https://www.google.com/recaptcha/admin/create
			
			$qry="SELECT value FROM $upb_option WHERE fieldname='upb_public_key'";
			$publickey = $wpdb->get_var($qry);
			
			$qry="SELECT value FROM $upb_option WHERE fieldname='upb_private_key'";
			$privatekey = $wpdb->get_var($qry);
			/*$publickey = "6LfLhOESAAAAAPWB64QP-rxYyuE2DcxfQZd0Anot";
			$privatekey = "6LfLhOESAAAAAIu-Y4ySfijTeb_yVAdv28fVXS-p";*/
			# the response from reCAPTCHA
			$resp = null;
			# the error code from reCAPTCHA, if any
			$error = null;
			}
			else
			{
				$submit=1;	
			}
			# was there a reCAPTCHA response?
			if (isset($_POST["recaptcha_response_field"]))
			{
				$resp = recaptcha_check_answer ($privatekey,
				$_SERVER["REMOTE_ADDR"],
				$_POST["recaptcha_challenge_field"],
				$_POST["recaptcha_response_field"]);
				
				if ($resp->is_valid)
				{
					$submit = 1;
				}
				else
				{
?>
<style type="text/css">
.error
{
		border: 1px solid #00529B;
		padding-bottom:15px;
		padding-top:15px;
		color: #D8000C;
		background-color: #FFBABA;
}
</style>
<!--HTML for showing error when recaptcha does not matches-->
<div class="error" align="center"> Sorry, you didn't enter the correct captcha code. </div>
<br />
<br />
<br />
<?php
$submit = 0;
	}
}
if(isset($_POST['submit']) && $submit==1 ) // Checks if the submit button is pressed or not
{
	$retrieved_nonce = $_REQUEST['_wpnonce'];
	if (!wp_verify_nonce($retrieved_nonce, 'upb_register_form' ) ) die( 'Failed security check' );

$user_name             = trim($_POST['user_name']); // receiving username
$user_email            = trim($_POST['user_email']); // receiving email address
$inputPassword         = trim($_POST['inputPassword']); // receiving password
$user_confirm_password = trim($_POST['user_confirm_password']); // receiving confirm password
$user_id               = username_exists( $user_name ); // Checks if username is already exists.

if ( !$user_id and email_exists($user_email) == false )//Creates password if password auto-generation is turned on in the settings
{
	if($pwd_show != "no")
	{
		$random_password = $inputPassword;
	}
	else
	{
		$random_password = $inputPassword;
	}

$qry="SELECT value FROM $upb_option WHERE fieldname='upb_welcome_email_subject'";//Fetches registration email Subject from dashboard settings
$subject = $wpdb->get_var($qry);
$user_id = wp_create_user( $user_name, $random_password, $user_email );//Creates new WP user after successful registration

  if($subject == "")
  {
	$subject = get_bloginfo('name');//Auto inserts email Subject if it is not defined in dashboard settings
	$subject .= " - Registration";
  }
$qry1="SELECT value FROM $upb_option WHERE fieldname='upb_welcome_email_message'";//Fetches registration email body from dashboard settings
$message = $wpdb->get_var($qry1);
if($message == "")
{
	$message = "Thank you for registration.";//Auto inserts this text as email body if it is not defined in dashboard settings
}
if($pwd_show != "no")//Inserts password into registration email body if auto-generation of password is enabled
{
  $message .= "You can use following details for login.
  Username: ".$user_name."
  password : ".$random_password;
}
if(is_array($content) && $content['role']!="")
{
	$role = $content['role'];//Assigns the new user a role based on registration form shortcode
}
else
{
	$role = 'subscriber';//Defines default role if there is not shortcode in registration form
}
/*Insert custom field values if displayed in registration form*/
$qry1 = "select * from $upb_fields where registration = '1' and user_group like '%".$role."%' and Type not in('heading','paragraph') order by ordering asc";
$reg1 = $wpdb->get_results($qry1);
if(!empty($reg1))
{
 foreach($reg1 as $row1)
 {
	if(!empty($row1))
	{
		$Customfield = @str_replace(" ","_",$row1->Name);
		if(!isset($prev_value)) $prev_value='';
		add_user_meta( $user_id, $Customfield, $_POST[$Customfield], true );
		update_user_meta( $user_id, $Customfield, $_POST[$Customfield], $prev_value );
	}
 }
}
/*Assigns user role to newly registered user*/
if(is_array($content) && $content['role']!="")
{		 
	if($content['role']=='Subscriber' || $content['role']=='Administrator' || $content['role']=='Editor' || $content['role']=='Author' || $content['role']=='Contributor')
	{
		$role = strtolower($content['role']);
	}
	else
	{
		$role =  $content['role'];	
	}
	$user_id = wp_update_user( array( 'ID' => $user_id, 'role' => $role ) );
}
wp_mail( $user_email, $subject, $message );//Sends email to user on successful registration
?>
<style type="text/css">
.success
{
	border: 1px solid #00529B;
	padding-bottom:15px;
	padding-top:15px;
	color: #4F8A10;
	background-color: #DFF2BF;
}
</style>
<!--HTML for page displayed on registration successful-->
<div id="UPB-Standard-Form">
  <div id="UPB-Standard-Form-entry-content">
     <div class="UPB-Standard-Form-main-upb-form">
     
        <div class="already-logged">
         <div class="You-are-already-logged-in">
         <div class="info-text-success"> Registration successful. Please check your email for password. <br />
         <span style="font-style:italic;"> To resend the password, go to <a href="<?php echo $pageURL; ?><?php echo $sign; ?>login3=1" title="Lost Password">forgot password</a> page. </span></div>
         </div>
         <div class="UPB-Button-input">
     <a class="UPB-Button" href="<?php echo $pageURL; ?><?php echo $sign; ?>login2=1" title="Registration"> Login Now. </a>         </div>
        <div class="clear"></div>
        </div>
    
    </div><!-----------UPB-Standard-Form-main-upb-form-------->
    <div class="clear"></div>
  </div><!-------------UPB-Standard-Form-entry-content----------->
  <div class="clear"></div>
</div><!------------UPB-Standard-Form--------->
<?php
}
else
{
	$random_password = __('User already exists.  Password inherited.');
?>
<!--HTML for displaying error when username already exists (This is different from error shown by jQuery validation.)-->
<div id="UPB-Standard-Form">
  <div id="UPB-Standard-Form-entry-content">
     <div class="UPB-Standard-Form-main-upb-form">
       <div class="already-logged">
        <div class="You-are-already-logged-in"><h3>Sorry, the username or e-mail is already taken.</h3></div>
        <div class="UPB-Button-input">
        <a class="UPB-Button" href="javascript:void(0);" onclick="javascript:history.back();" title="Registration">
        Go back to Registration.</a>
        <a class="UPB-Button" href="<?php echo site_url(); ?>">Go back to Home-Page</a>
        <div class="clear"></div>
    </div>
      <div class="clear"></div>
    </div>
    
    </div><!-----------UPB-Standard-Form-main-upb-form-------->
    <div class="clear"></div>
  </div><!-------------UPB-Standard-Form-entry-content----------->
  <div class="clear"></div>
</div><!------------UPB-Standard-Form--------->
<?php
	}
}
else
{
?>
<!--HTML for displaying registration form-->
  
  <form method="post" action="" class="UPB-login-form form-horizontal" id="registerform" name="registerform">
    <div >
    <div class="text-info-heading"><?php echo $Custom_Text;?></div>
    <div id="UPB-Standard-Form-entry-content">
      <div class="UPB-Standard-Form-main-upb-form">
        <div class="login-form registration-form">
           
          <div class="form-group"  style="padding-left:15px; padding-right:15px;">
            <label for="user_login"><?php _e('Username',$textdomain);?></label>
            <div class="upb_required">
              <input type="text" class="form-control" onblur="javascript:validete_userName();" onkeyup="javascript:validete_userName();" onfocus="javascript:validete_userName();" onchange="javascript:validete_userName();" value="<?php echo (!empty($_POST['user_name']))?  $_POST['user_name']: ''; ?>"  id="user_name" name="user_name">
              <div class="reg_frontErr upb_error_text custom_error" style="display:none;" id="nameErr"></div>
            </div>
          </div>

          <div class="form-group"  style="padding-left:15px; padding-right:15px;">
            <label for="user_email"><?php _e('E-mail',$textdomain);?></label>
            <div class="upb_required upb_email">
              <input type="text" class="form-control" onblur="javascript:validete_email();" onkeyup="javascript:validete_email();" onfocus="javascript:validete_email();" onchange="" value="<?php echo (!empty($_POST['user_email']))?  $_POST['user_email']: ''; ?>" id="user_email" name="user_email">
              <div class="reg_frontErr upb_error_text custom_error" style="display:none;" id="emailErr"></div>
            </div>
          </div>
          
      <?php
if($pwd_show == "no")//Shows password field if the user is allowed to chose password during registration
{
?>
      <div class="form-group"  style="padding-left:15px; padding-right:15px;">
        <label for="user_password"><?php _e('Password',$textdomain);?></label>
        <div class="upb_required upb_password">
          <input id="inputPassword" class="form-control" name="inputPassword" type="password" onfocus="javascript:document.getElementById('user_confirm_password').value = '';" />
          <!-- <div id="complexity" class="default" style="display:none; width:100%; margin-left:0px; margin-top:5px; color:#b94a48 !important; border:none !important; background-color:transparent !important;"></div>
           --><div id="password_info" class="reg_frontErr"><?php _e('At least 7 characters please!',$textdomain);?></div>
          <div class="reg_frontErr upb_error_text custom_error" style="display:none;"></div>
        </div>
      </div>
      
      <div class="form-group" style="padding-left:15px; padding-right:15px;">
        <label for="user_confirm_password"><?php _e('Confirm Password',$textdomain);?></label>
    
        <div class="upb_required upb_confirmpassword">
          <input id="user_confirm_password" class="form-control" name="user_confirm_password" type="password"/>
          <div class="reg_frontErr upb_error_text custom_error" style="display:none;"></div>
          <!--<div class="reg_frontErr upb_error_text" id="divuser_confirm_password" style="display:none;"><?php _e('Enter the password again to confirm',$textdomain);?></div>-->
        </div>
      </div>

      <?php
}
else//If auto password generation is enabled then this will create a random password
{
  $random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
?>
          <input id="inputPassword" name="inputPassword" type="hidden" value="<?php echo $random_password; ?>" />             
          <input id="user_confirm_password" name="user_confirm_password" value="<?php echo $random_password; ?>" type="hidden"/>
<?php
}
?>     
      <!-- HTML for displaying custom fields in Registration form -->
        <?php 
if(is_array($content) && $content['role']!="")
{
  $role = $content['role'];
}
else
{
  $role = "subscriber"; 
}
$qry1 = "select * from $upb_fields where registration = '1' and user_group like '%".$role."%' order by ordering asc";
$reg1 = $wpdb->get_results($qry1);
   foreach($reg1 as $row1)
   {
     $key = str_replace(" ","_",$row1->Name);
     $value = $row1->Value;
     if($row1->Type=='heading')
     {?>
        <div class="formtable upb_heading">
          <h1 name="<?php echo $key;?>" class="<?php echo $row1->Class;?>"><?php echo $row1->Value;?></h1>
        </div>
        <?php 
    }
    if($row1->Type=='paragraph')
     {?>
        <div class="formtable upb_paragraph">
          <p class="info-textt" name="<?php echo $key;?>" class="<?php echo $row1->Class;?>"><?php echo $row1->Option_Value;?></p>
        </div>
        <?php }
if($row1->Type=='term_checkbox')
     {?>
         <div class="clear"></div>
        <div class="formtable forgot-password">
          <label>&nbsp;</label>
          <div class="term-box <?php if($row1->Require==1)echo 'upb_termboxrequired';?>">
          <input type="checkbox" value="<?php echo 'yes';?>" id="<?php echo $key;?>" name="<?php echo $key;?>"  class="regular-text <?php echo $row1->Class;?>">
          <label class="term-label" for="<?php echo $key;?>"><?php echo $row1->Name;?><?php if($row1->Require==1)echo '<sup class="upb_estric">*</sup>';?></label>
          </div>
          <div class="reg_frontErr custom_error upb_error_text" style="display:none;"></div>
           <textarea disabled rows="3"><?php echo $row1->Description;?></textarea>
          
        </div>
        <?php }
    if($row1->Type=='DatePicker')
     {?>
        <div class="formtable">
          <div class="lable-text">
            <label for="<?php echo $key;?>"><?php echo $row1->Name;?></label>
          </div>
          <div class="input-box <?php if($row1->Require==1)echo 'upb_required';?>">
            <input type="text" class="MyDate regular-text <?php echo $row1->Class;?>" maxlength="<?php echo $row1->Max_Length;?>" value="<?php echo $value;?>" id="<?php echo $key;?>" name="<?php echo $key;?>" <?php if($row1->Readonly==1)echo 'readonly';?>>
            <div class="reg_frontErr custom_error upb_error_text" style="display:none;"></div>
          </div>
        </div>
        <?php }
     if($row1->Type=='text')
     {?>
        <div class="formtable">
          <div class="lable-text">
            <label for="<?php echo $key;?>"><?php echo $row1->Name;?></label>
          </div>
          <div class="input-box <?php if($row1->Require==1)echo 'upb_required';?>">
            <input type="text" class="regular-text <?php echo $row1->Class;?>" maxlength="<?php echo $row1->Max_Length;?>" value="<?php echo $value;?>" id="<?php echo $key;?>" name="<?php echo $key;?>" <?php if($row1->Readonly==1)echo 'readonly';?>>
            <div class="reg_frontErr custom_error upb_error_text" style="display:none;"></div>
          </div>
        </div>
        <?php }
    if($row1->Type=='email')
     {?>
        <div class="formtable">
          <div class="lable-text">
            <label for="<?php echo $key;?>"><?php echo $row1->Name;?></label>
          </div>
          <div class="input-box upb_email <?php if($row1->Require==1)echo 'upb_required';?>">
            <input type="text" class="regular-text <?php echo $row1->Class;?>" maxlength="<?php echo $row1->Max_Length;?>" value="<?php echo $value;?>" id="<?php echo $key;?>" name="<?php echo $key;?>" <?php if($row1->Readonly==1)echo 'readonly';?>>
            <div class="reg_frontErr custom_error upb_error_text" style="display:none;"></div>
          </div>
        </div>
        <?php }
    if($row1->Type=='number')
     {?>
        <div class="formtable">
          <div class="lable-text">
            <label for="<?php echo $key;?>"><?php echo $row1->Name;?></label>
          </div>
          <div class="input-box upb_number <?php if($row1->Require==1)echo 'upb_required';?>">
            <input type="text" class="upb_number regular-text <?php echo $row1->Class;?>" maxlength="<?php echo $row1->Max_Length;?>" value="<?php echo $value;?>" id="<?php echo $key;?>" name="<?php echo $key;?>" <?php if($row1->Readonly==1)echo 'readonly';?>>
            <div class="reg_frontErr custom_error upb_error_text" style="display:none;"></div>
          </div>
        </div>
        <?php }
    if($row1->Type=='textarea')
    {?>
        <div class="formtable">
          <div class="lable-text radio-label">
            <label for="<?php echo $key;?>"><?php echo $row1->Name;?></label>
          </div>
          <div class="input-box <?php if($row1->Require==1)echo 'upb_textarearequired';?>">
            <textarea  class="regular-text <?php echo $row1->Class;?>" maxlength="<?php echo $row1->Max_Length;?>" cols="<?php echo $row1->Cols;  ?>" rows="<?php echo $row1->Rows;  ?>" id="<?php echo $key;?>" name="<?php echo $key;?>" <?php if($row1->Readonly==1)echo 'readonly';?>><?php echo $value; ?></textarea>
            <div class="reg_frontErr custom_error upb_error_text" style="display:none;"></div>
          </div>
        </div>
        <?php }
    if($row1->Type=='radio')
    {
       $array_value = explode(',',$value);
      ?>
        <div class="formtable">
          <div class="lable-text radio-label">
            <label for="<?php echo $key;?>"><?php echo $row1->Name;?></label>
          </div>
          <div class="input-box radio-box <?php if($row1->Require==1)echo 'upb_radiorequired';?>">
            <?php 
                  $arr_radio = explode(',',$row1->Option_Value);
                  foreach($arr_radio as $radio)
                  {?>
            <div class="upb-check-text">
      <div class="Checkbox">
      <label><?php echo $radio; ?></label>
            <input type="radio" class="regular-text  <?php echo $row1->Class;?>" value="<?php echo $radio;?>" <?php if($value!=""){if(in_array($radio,$array_value))echo 'checked';} ?> id="<?php echo $key;?>" name="<?php echo $key;?>"  <?php if($row1->Readonly==1)echo 'disabled';?>>
            </div></div>
      <?php } ?>
            <br class="clear">
            <div class="reg_frontErr custom_error upb_error_text" style="display:none;"></div>
          </div>
        </div>
        <?php }
    if($row1->Type=='checkbox')
     {
       $array_value = explode(',',$value);
       ?>
        <div class="formtable">
          <div class="lable-text radio-label">
            <label for="<?php echo $key;?>"><?php echo $row1->Name; ?></label>
          </div>
          <div class="input-box upb_checkbox <?php if($row1->Require==1)echo 'upb_checkboxrequired';?>">
            <?php 
      $arr_radio = explode(',',$row1->Option_Value);
      $radio_count = 1;
      foreach($arr_radio as $radio)
      {?>
            <div class="upb-check-text">
      <div class="Checkbox">
      <label><?php echo $radio; ?></label>
            <input type="checkbox" class="regular-text <?php echo $row1->Class;?>" value="<?php echo $radio;?>" id="<?php echo $key;?>"  name="<?php echo $key.'[]';?>" <?php if($value!=""){if(in_array($radio,$array_value))echo 'checked';} ?> <?php if($row1->Readonly==1)echo 'disabled';?>></div></div>
            <?php $radio_count++; 
      } ?>
             <br class="clear">
            <div class="reg_frontErr custom_error upb_error_text" style="display:none;"></div>
          </div>
        </div>
        <?php }
    
     if($row1->Type=='select')
     {?>
        <div class="formtable">
          <div class="lable-text">
            <label for="<?php echo $key;?>"><?php echo $row1->Name;?></label>
          </div>
          <div class="input-box upb_select <?php if($row1->Require==1)echo 'upb_select_required';?>">
            <select class="regular-text <?php echo $row1->Class;?>" id="<?php echo $key;?>" name="<?php echo $key;?>" <?php if($row1->Readonly==1)echo 'disabled';?>>
              <?php
        $arr = explode(',',$row1->Option_Value);
        foreach($arr as $ar)
        {
          ?>
              <option value="<?php echo $ar;?>" <?php if($ar==$value)echo 'selected';?>><?php echo $ar;?></option>
              <?php 
        }
        ?>
            </select>
            <div class="reg_frontErr custom_error upb_error_text" style="display:none;"></div>
          </div>
        </div>
        <?php }
    /* country field */
    if($row1->Type=='country')
     {?>
        <div class="formtable">
          <div class="lable-text">
            <label for="<?php echo $key;?>"><?php echo $row1->Name;?></label>
          </div>
          <div class="input-box upb_select upb_country <?php if($row1->Require==1)echo 'upb_select_required';?>">
            <select class="regular-text <?php echo $row1->Class;?>" id="<?php echo $key;?>" name="<?php echo $key;?>" <?php if($row1->Readonly==1)echo 'disabled';?>>
      <?php include 'country_option_list.php'; ?>
            </select>
            <div class="reg_frontErr custom_error upb_error_text" style="display:none;"></div>
          </div>
        </div>
        <?php }
    
    /* timezone field */
    if($row1->Type=='timezone')
     {?>
        <div class="formtable">
          <div class="lable-text">
            <label for="<?php echo $key;?>"><?php echo $row1->Name;?></label>
          </div>
          <div class="input-box upb_select upb_country <?php if($row1->Require==1)echo 'upb_select_required';?>">
            <select class="regular-text <?php echo $row1->Class;?>" id="<?php echo $key;?>" name="<?php echo $key;?>" <?php if($row1->Readonly==1)echo 'disabled';?>>
      <?php include 'time_zone_option_list.php'; ?>
            </select>
            <div class="reg_frontErr custom_error upb_error_text" style="display:none;"></div>
          </div>
        </div>
        <?php }
    
     }
     ?>
    


      <!-- Custom fields in Registration form ends -->
      <?php if($captcha_show=='yes') : ?>
      <div class="formtablee"> 
        <div class="input-box_captcha" align="center"><?php echo recaptcha_get_html($publickey, $error); ?> </div>
        <div class="reg_frontErr custom_error upb_error_text" id="divrecaptcha_response_field" style="display:none;"></div>
        <?php /*?><div class="reg_frontErr"  style="display:none;width: 299px !important; margin-left: 170px !important;"> <?php _e('Please fill this to prove you aren\'t a robot.',$textdomain);?> </div><?php */?>
        <div class="clear"></div>
      </div>
      <?php endif; ?>
     
      
       <div class="clear"></div>
    </div><!-----------UPB-Standard-Form-main-upb-form-------->
      
      <div class="clear"></div>
      
    </div><!------------UPB-Standard-Form-entry-content---------->
    
    <div id="UPB-Button-area">
      <div class="UPB-Button-input forgot-passwordd">
      <?php wp_nonce_field('upb_register_form'); ?>

      <div class="pull-right" style="">
        <input type="submit" value="Submit" class="btn btn-default " id="submit" name="submit" >
        <input type="reset" value="Reset" class="btn btn-default " style="height: 30px; font-size:14px;" id="reset" name="reset" />
      </div>

            <?php
      $qry="SELECT value FROM $upb_option WHERE fieldname='upb_facebook_login'";
      $facebook_login = $wpdb->get_var($qry);
      if($facebook_login=='yes')
      {
        include 'facebook/upb_facebook.php';
        upb_fb_login_validate();
        upb_fb_loginForm();
      }
      ?>
       </div> 
    </div>
    
    <div class="clear"></div>
    
    <div class="customupberror" style="display:none"></div>
    </div>
    </div>
  </form>

<?php
			}	
		}
?>
<script language="javascript" type="text/javascript"> //AJAX username validation
      var name  =false;
      var email =false;

      var checkingRegex = false;

			function validete_userName()
			{

        var regexAN  = "/^([a-zA-Z0-9_-]+)$/";
        var userName = jQuery('#user_name').val();
        if(userName.length!==0){
          if (userName.match(/[^a-zA-Z0-9 ]/g)){
            jQuery('#user_name').parent().find('.custom_error').html('<?php _e('Please enter a valid username.',$textdomain);?>');
            jQuery('#user_name').parent().find('.custom_error').show();
          } else {

            jQuery.ajax(
            {
              type: "POST",
              url: '<?php echo get_option('siteurl').'/wp-admin/admin-ajax.php';?>?action=ajaxcalls&cookie=encodeURIComponent(document.cookie)&function=validateUser&name=' + jQuery("#user_name").val(),
              success : function (serverResponse)
              {
                    
                if (serverResponse == "true") {
                  jQuery("#nameErr").html("<?php _e('Sorry, username already exist',$textdomain);?>");
                  jQuery("#nameErr").css('display','block');
                  jQuery("#submit").attr('disabled', true);
                } else {
                  jQuery("#nameErr").html('');
                  jQuery("#nameErr").css('display','none');
                  jQuery("#submit").attr('disabled', false);
                }
                  
              }
            });
          }
        }
			}

			function validete_email() //AJAX email validation
			{
				jQuery.ajax(
				{
					type: "POST",
					url: '<?php echo get_option('siteurl').'/wp-admin/admin-ajax.php';?>?action=ajaxcalls&cookie=encodeURIComponent(document.cookie)&function=validateEmail&email=' + jQuery("#user_email").val(),
					success : function (serverResponse)
					{
						if (serverResponse == "true") {
                        email = false;
                        jQuery("#emailErr").html("<?php _e('Sorry, email already exist',$textdomain);?>");
                        jQuery("#emailErr").css('display','block');
                        jQuery("#submit").attr('disabled', true);
						} else {
							jQuery("#emailErr").html('');
							jQuery("#submit").attr('disabled', false);
							jQuery("#emailErr").css('display','none');
						}
					}
				})
			}

</script>
<?php
	}
?>
<script>
    jQuery(document).ready(function () {
        //for date picker
        jQuery('.MyDate').datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });
    jQuery('#registerform').submit(function () {
        //email validation start for custom field	
        var email_val = "";
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var regexAN = "/^([a-zA-Z0-9 _-]+)$/";
        jQuery('.custom_error').html('');
        jQuery('.custom_error').hide();
        jQuery('.customupberror').html('');
		
		<?php if(isset($pwd_show) && $pwd_show == "no"): ?>
    var password        = jQuery('#inputPassword').val();
    var confirmpassword = jQuery('#user_confirm_password').val();
    var passwordlength  = password.length;
    var userName        = jQuery('#user_name').val();

    if(password !="")
		{
			if(passwordlength < 7)
			{
				jQuery('.upb_password').children('.custom_error').html('<?php _e('Your password should be at least 7 characters long.',$textdomain);?>');
				jQuery('.upb_password').children('.custom_error').show();
			}
			if(password != confirmpassword)
			{
				jQuery('.upb_confirmpassword').children('.custom_error').html('<?php _e('Password and confirm password do not match.',$textdomain);?>');
				jQuery('.upb_confirmpassword').children('.custom_error').show();
			}
		}

		<?php endif; ?>
		
        jQuery('.upb_email').each(function (index, element) {
            var email = jQuery(this).children('input').val();
            var isemail = regex.test(email);
            if (isemail == false && email != "") {
                jQuery(this).children('.custom_error').html('<?php _e('Please enter a valid e-mail address.',$textdomain);?>');
                jQuery(this).children('.custom_error').show();
            }
        });
		
		
		/*file addon start */
		 jQuery('.upb_file').each(function (index, element) {
			var val = jQuery(this).children('input').val().toLowerCase();
			var allowextensions = jQuery(this).children('input').attr('data-filter-placeholder');
			if(allowextensions=='')
			{
				allowextensions = '<?php echo get_option('ucf_allowfiletypes','jpg|jpeg|png|gif|doc|pdf|docx|txt|psd'); ?>';
			}
			var regex = new RegExp("(.*?)\.(" + allowextensions + ")$");
			if(!(regex.test(val)) && val!="") {
			
				jQuery(this).children('.custom_error').html('<?php _e('This file type is not allowed.',$textdomain);?>');
                jQuery(this).children('.custom_error').show();
			}
        });
		/*file addon end */
		
		jQuery('.upb_date').each(function (index, element) { //Validation for number type custom field
            var date = jQuery(this).children('input').val();
			var datepattern = /^\d{4}-\d{2}-\d{2}$/;
 			 is_date = date.match(datepattern);
            if (is_date == null && date !="") {
                jQuery(this).children('.custom_error').html('<?php _e('Please enter a valid date(yyyy-mm-dd).',$textdomain);?>');
                jQuery(this).children('.custom_error').show();
            }
        });
		
        jQuery('.upb_number').each(function (index, element) { //Validation for number type custom field
            var number = jQuery(this).children('input').val();
            var isnumber = jQuery.isNumeric(number);
            if (isnumber == false && number != "") {
                jQuery(this).children('.custom_error').html('<?php _e('Please enter a valid number',$textdomain);?>');
                jQuery(this).children('.custom_error').show();
            }
        });
		
		jQuery('.upb_required').each(function (index, element) { //Validation for number type custom field
            var value = jQuery(this).children('input').val();
			var value2 = jQuery.trim(value);
            if (value == "" || value2== "") {
                jQuery(this).children('.custom_error').html('<?php _e('This is a required field.',$textdomain);?>');
                jQuery(this).children('.custom_error').show();
            }
        });
		
		jQuery('.upb_select_required').each(function (index, element) { //Validation for number type custom field
            var value = jQuery(this).children('select').val();
			var value2 = jQuery.trim(value);
            if (value == "" || value2== "") {
                jQuery(this).children('.custom_error').html('<?php _e('This is a required field.',$textdomain);?>');
                jQuery(this).children('.custom_error').show();
            }
        });
		
		jQuery('.upb_textarearequired').each(function (index, element) { //Validation for number type custom field
            var value = jQuery(this).children('textarea').val();
			var value2 = jQuery.trim(value);
            if (value == "" || value2== "") {
                jQuery(this).children('.custom_error').html('<?php _e('This is a required field.',$textdomain);?>');
                jQuery(this).children('.custom_error').show();
            }
        });
		
		jQuery('.upb_checkboxrequired').each(function (index, element) { //Validation for number type custom field
		var checkboxlenght = jQuery(this).children('.upb-check-text').children('.Checkbox').children('input[type="checkbox"]:checked');
		
        var atLeastOneIsChecked = checkboxlenght.length > 0;
        if (atLeastOneIsChecked == true) {
		}else{
                jQuery(this).children('.custom_error').html('<?php _e('This is a required field.',$textdomain);?>');
                jQuery(this).children('.custom_error').show();
            }
		
		});
		
		jQuery('.upb_termboxrequired').each(function (index, element) { //Validation for number type custom field
		var checkboxlenght = jQuery(this).children('.term-box').children('input[type="checkbox"]:checked');
		
        var atLeastOneIsChecked = checkboxlenght.length > 0;
        if (atLeastOneIsChecked == true) {
		}else{
                jQuery(this).children('.custom_error').html('<?php _e('This is a required field.',$textdomain);?>');
                jQuery(this).children('.custom_error').show();
            }
		
		});
		
		jQuery('.upb_radiorequired').each(function (index, element) { //Validation for number type custom field
		var radiolenght = jQuery(this).children('.upb-check-text').children('.Checkbox').children('input[type="radio"]:checked');
		
        var atLeastOneIsChecked = radiolenght.length > 0;
        if (atLeastOneIsChecked == true) {
		}else{
                jQuery(this).children('.custom_error').html('<?php _e('This is a required field.',$textdomain);?>');
                jQuery(this).children('.custom_error').show();
            }
		
		});
		
        var b = '';
        b = jQuery('.custom_error').each(function () {
            var a = jQuery(this).html();
            b = a + b;
            jQuery('.customupberror').html(b);
        });
        var error = jQuery('.customupberror').html();
        if (error == '') {
            return true;
        } else {
            return false;
        }

    });
jQuery('.upb_required').parent('.formtable').children('.lable-text').children('label').append('<sup class="upb_estric">*</sup>');
jQuery('.upb_select_required').parent('.formtable').children('.lable-text').children('label').append('<sup class="upb_estric">*</sup>');
jQuery('.upb_radiorequired').parent('.formtable').children('.lable-text').children('label').append('<sup class="upb_estric">*</sup>');
jQuery('.upb_checkboxrequired').parent('.formtable').children('.lable-text').children('label').append('<sup class="upb_estric">*</sup>');
jQuery('.upb_textarearequired').parent('.formtable').children('.lable-text').children('label').append('<sup class="upb_estric">*</sup>');
</script>
<style>
.upb_estric{ color:red;}
</style>