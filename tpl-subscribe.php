<div id="subscribe">

<div id="intro">The Weekly Filet brings you the best of the web right into your inbox. <span class="mobile-hide">Intriguing articles, stunning photographs, telling visualisations, excellent songs, smart videos. </span><span class="highlight">5 recommended links, every Friday, free home-delivery.</span> Brought to you by journalist David Bauer. <a href="/about">Learn more</a>.</div>


<!-- Begin MailChimp Signup Form -->
<!--[if IE]>
<style type="text/css" media="screen">
	#mc_embed_signup fieldset {position: relative;}
	#mc_embed_signup legend {position: absolute; top: -1em; left: .2em;}
</style>
<![endif]--> 
<!--[if IE 7]>
<style type="text/css" media="screen">
	.mc-field-group {overflow:visible;}
</style>
<![endif]-->

<div id="mc_embed_signup">
<form action="http://davidbauer.us2.list-manage.com/subscribe/post?u=a37fb2cb8c141270ee0dd9c10&amp;id=32913f2c60" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" style="font: normal 100% Arial, sans-serif;font-size: 10px;">
	<fieldset style="width:60%;margin:0 auto;">
	
<div class="mc-field-group" style="margin: 1.3em 5%;float:left;width:95%;clear: both;overflow: hidden;">
<input type="text" value="" placeholder="email address" name="EMAIL" class="required email" id="mce-EMAIL" style="font-size:20px;margin-right: 1.5em;padding: .2em .3em;width: 90%;float: left;z-index: 999;">
</div>
<!--
<div class="mc-field-group" style="margin: 1.3em 5%;clear: both;overflow: hidden;">
<label for="mce-FNAME" style="display: block;margin: .3em 0;line-height: 1em;font-weight: bold;">First Name</label>
<input type="text" value="" name="FNAME" class="" id="mce-FNAME" style="margin-right: 1.5em;padding: .2em .3em;width: 90%;float: left;z-index: 999;">
</div>
<div class="mc-field-group" style="margin: 1.3em 5%;clear: both;overflow: hidden;">
<label for="mce-LNAME" style="display: block;margin: .3em 0;line-height: 1em;font-weight: bold;">Last Name</label>
<input type="text" value="" name="LNAME" class="" id="mce-LNAME" style="margin-right: 1.5em;padding: .2em .3em;width: 90%;float: left;z-index: 999;">
</div>
-->
		<div id="mce-responses" style="float: left;top: -1.4em;padding: 0em .5em 0em .5em;overflow: hidden;width: 90%;margin: 0 5%;clear: both;">
			<div class="response" id="mce-error-response" style="font-size:14px;display: none;margin: 0.2em auto;padding: 1em .5em .5em 0;font-weight: bold;top: -1.5em;z-index: 1;width: 80%;background: FBE3E4;color: #D12F19;"></div>
			<div class="response" id="mce-success-response" style="font-size:14px;display: none;margin: 1em auto;padding: 1em .5em .5em 0;top: -1.5em;z-index: 1;width: 80%;background: #E3FBE4;color: #529214;"></div>
		</div>
		<div><input type="submit" value="Subscribe now" name="subscribe" id="mc-embedded-subscribe" class="btn" style="clear: both;font-size:21px; display:block;margin: 1em auto 0.5em;width:200px;"></div>
	</fieldset>	
	<a href="#" id="mc_embed_close" class="mc_embed_close" style="display: none;">Close</a>
</form>
</div>
<script type="text/javascript">
var fnames = new Array();var ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';
try {
    var jqueryLoaded=jQuery;
    jqueryLoaded=true;
} catch(err) {
    var jqueryLoaded=false;
}
var head= document.getElementsByTagName('head')[0];
if (!jqueryLoaded) {
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js';
    head.appendChild(script);
    if (script.readyState && script.onload!==null){
        script.onreadystatechange= function () {
              if (this.readyState == 'complete') mce_preload_check();
        }    
    }
}
var script = document.createElement('script');
script.type = 'text/javascript';
script.src = 'http://downloads.mailchimp.com/js/jquery.form-n-validate.js';
head.appendChild(script);
var err_style = '';
try{
    err_style = mc_custom_error_style;
} catch(e){
    err_style = 'margin: 1em 0 0 0; padding: 1em 0.5em 0.5em 0.5em; background: ERROR_BGCOLOR none repeat scroll 0% 0%; font-weight: bold; float: left; z-index: 1; width: 80%; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial; color: ERROR_COLOR;';
}
var head= document.getElementsByTagName('head')[0];
var style= document.createElement('style');
style.type= 'text/css';
if (style.styleSheet) {
  style.styleSheet.cssText = '.mce_inline_error {' + err_style + '}';
} else {
  style.appendChild(document.createTextNode('.mce_inline_error {' + err_style + '}'));
}
head.appendChild(style);
setTimeout('mce_preload_check();', 250);

var mce_preload_checks = 0;
function mce_preload_check(){
    if (mce_preload_checks>40) return;
    mce_preload_checks++;
    try {
        var jqueryLoaded=jQuery;
    } catch(err) {
        setTimeout('mce_preload_check();', 250);
        return;
    }
    try {
        var validatorLoaded=jQuery("#fake-form").validate({});
    } catch(err) {
        setTimeout('mce_preload_check();', 250);
        return;
    }
    mce_init_form();
}
function mce_init_form(){
    jQuery(document).ready( function($) {
      var options = { errorClass: 'mce_inline_error', errorElement: 'div', onkeyup: function(){}, onfocusout:function(){}, onblur:function(){}  };
      var mce_validator = $("#mc-embedded-subscribe-form").validate(options);
      $("#mc-embedded-subscribe-form").unbind('submit');//remove the validator so we can get into beforeSubmit on the ajaxform, which then calls the validator
      options = { url: 'http://davidbauer.us2.list-manage.com/subscribe/post-json?u=a37fb2cb8c141270ee0dd9c10&id=32913f2c60&c=?', type: 'GET', dataType: 'json', contentType: "application/json; charset=utf-8",
                    beforeSubmit: function(){
                        $('#mce_tmp_error_msg').remove();
                        $('.datefield','#mc_embed_signup').each(
                            function(){
                                var txt = 'filled';
                                var fields = new Array();
                                var i = 0;
                                $(':text', this).each(
                                    function(){
                                        fields[i] = this;
                                        i++;
                                    });
                                $(':hidden', this).each(
                                    function(){
                                        if (fields.length == 2) fields[2] = {'value':1970};//trick birthdays into having years
                                    	if ( fields[0].value=='MM' && fields[1].value=='DD' && fields[2].value=='YYYY' ){
                                    		this.value = '';
									    } else if ( fields[0].value=='' && fields[1].value=='' && fields[2].value=='' ){
                                    		this.value = '';
									    } else {
	                                        this.value = fields[0].value+'/'+fields[1].value+'/'+fields[2].value;
	                                    }
                                    });
                            });
                        return mce_validator.form();
                    }, 
                    success: mce_success_cb
                };
      $('#mc-embedded-subscribe-form').ajaxForm(options);      
      
    });
}
function mce_success_cb(resp){
    $('#mce-success-response').hide();
    $('#mce-error-response').hide();
    if (resp.result=="success"){
        $('#mce-'+resp.result+'-response').show();
        $('#mce-'+resp.result+'-response').html(resp.msg);
        $('#mc-embedded-subscribe-form').each(function(){
            this.reset();
    	});
    } else {
        var index = -1;
        var msg;
        try {
            var parts = resp.msg.split(' - ',2);
            if (parts[1]==undefined){
                msg = resp.msg;
            } else {
                i = parseInt(parts[0]);
                if (i.toString() == parts[0]){
                    index = parts[0];
                    msg = parts[1];
                } else {
                    index = -1;
                    msg = resp.msg;
                }
            }
        } catch(e){
            index = -1;
            msg = resp.msg;
        }
        try{
            if (index== -1){
                $('#mce-'+resp.result+'-response').show();
                $('#mce-'+resp.result+'-response').html(msg);            
            } else {
                err_id = 'mce_tmp_error_msg';
                html = '<div id="'+err_id+'" style="'+err_style+'"> '+msg+'</div>';
                
                var input_id = '#mc_embed_signup';
                var f = $(input_id);
                if (ftypes[index]=='address'){
                    input_id = '#mce-'+fnames[index]+'-addr1';
                    f = $(input_id).parent().parent().get(0);
                } else if (ftypes[index]=='date'){
                    input_id = '#mce-'+fnames[index]+'-month';
                    f = $(input_id).parent().parent().get(0);
                } else {
                    input_id = '#mce-'+fnames[index];
                    f = $().parent(input_id).get(0);
                }
                if (f){
                    $(f).append(html);
                    $(input_id).focus();
                } else {
                    $('#mce-'+resp.result+'-response').show();
                    $('#mce-'+resp.result+'-response').html(msg);
                }
            }
        } catch(e){
            $('#mce-'+resp.result+'-response').show();
            $('#mce-'+resp.result+'-response').html(msg);
        }
    }
}

</script>
<!--End mc_embed_signup-->
<p style="font-size:14px;">Other ways to follow: <a href="http://www.weeklyfilet.com/feed" target="_blank">RSS</a>, <a href="http://flip.it/eY4hS" target="_blank">Flipboard</a>.</p>
</div>