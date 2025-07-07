<?php

add_shortcode('wb-mm-banner-genaration', 'wb_mm_banner_form_shortcodes');
add_shortcode('wb-mm-banner-script-genaration', 'wb_mm_banner_script_shortcodes');


function wb_mm_banner_form_shortcodes()
{

$shortcode_html = '';
$shortcode_html .= '<form id="bgf244318" class="banner-generator-form">
<div class="elementor-field-group elementor-mark-required"><label class="elementor-field-label" for="field-stand"><b>Stand-Nr.:</b></label> <input id="field-stand" name="field-stand" required="" type="text" placeholder="Stand-Nr." /></div>
<div class="elementor-field-group"><label class="elementor-field-label" for="use"><b>Anwendung:</b></label>
    <div class="elementor-field elementor-select-wrapper">
        <select id="field-use" name="field-use">
            <option value="email">E-Mail Signatur</option>
            <!--<option value="instagram">Instagram</option>-->
            <option value="facebook">Facebook / Instagram</option>
            <option value="website-banner">Website-Banner</option> 
        </select>
    </div>
</div> 
<div class="elementor-field-group" style="display: none;"><label class="elementor-field-label" for="field-lang">Sprache:</label>
<div class="elementor-field elementor-select-wrapper"><select id="field-lang" name="field-lang">
<option value="de">Deutsch</option>
<!--<option value="en">Englisch</option>--></select></div>
</div>
<button class="elementor-button custom-based-on-website-color" type="submit" value="Banner generieren">Banner generieren</button></form><!--<p><button>Download</button></p>-->
<style type="text/css">

    button.custom-based-on-website-color{
        background-color: var(--mfn-button-bg) !important;
        border-color: var(--mfn-button-border-color) !important;
        color: var(--mfn-button-color) !important;
        box-shadow: var(--mfn-button-box-shadow) !important;
    }
    
    button.custom-based-on-website-color:hover{
        background-color: var(--mfn-button-bg-hover) !important;
        border-color: var(--mfn-button-border-color-hover) !important;
        color: var(--mfn-button-color-hover) !important;
    }
    
    .elementor-field-group input[type="text"],
    .elementor-field-group select{
        width: 100%;
    }
  .banner-generator-form .elementor-button { 
    font-weight: 400;
    text-transform: none;
    line-height: 32px;
    letter-spacing: 0.48px;
    color: var(--e-global-color-74062a0 ); 
    background: #003366;
    color: white;
    border: 0;
  }
  .banner-generator-form .elementor-button:hover,
  .banner-generator-form .elementor-button:focus {
    color: #ffffff;
    /*color: #ff6600;*/
    background: #ff6600;
  }

  .banner-generator-form .elementor-button .elementor-align-icon-left {
    margin-right: 18px;
  }

  .banner-generator-form .elementor-field-group {
    margin-bottom: 25px;
  }
  .banner-generator-form .elementor-field-group > label {
    font-family: "Compatil Fact W01 Regular",-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif;
    font-size: var(--e-global-typography-accent-font-size);
    font-weight: var(--e-global-typography-accent-font-weight);
    padding-bottom: 10px;
  }

  .banner-generator-form .elementor-field-group .elementor-field {
    color: var(--e-global-color-primary);
  }

  .banner-generator-form
    .elementor-field-group
    .elementor-select-wrapper
    select {
    background-color: #ffffff;
  }
</style>';
    return $shortcode_html;
}

function wb_mm_banner_script_shortcodes($attributes, $content = "")
{

    extract(shortcode_atts(array(
        'email' => 'hB25_Bannergenerator_02_580x150px_E_Mail',
        //'instagram' => 'm3b_RL_Banner-Generator-Instagram_n',
        'facebook' => 'hB25_Bannergenerator_02_1200x1500px_Facebook_instagram',
        'web_banner' => 'hB25_Bannergenerator_02_300x250px_Website'
    ), $attributes));

    $shortcode_html = '';
    $shortcode_html .= '<p class="banner-label"><b>Banner:</b></p>
<canvas id="banner" class="banner-image" width="580" height="150"> Your browser does not support the canvas element. </canvas>
<script type="text/javascript">  
  const form = document.getElementById("bgf244318")
  form.addEventListener("submit", function (event) {
    const canvas = document.getElementById("banner")
    const ctx = canvas.getContext("2d")
    const stand = document.getElementById("field-stand").value
    const use = document.getElementById("field-use").value
    const lang = document.getElementById("field-lang").value 
     
    let img = "' . $email . '"
    let posLeft = 126
    let posTop = 122
    let bannerWidth = 580
    let bannerHeight = 150
    let fontSize = 17
    if (use === "instagram") {
      bannerWidth = 1200
      bannerHeight = 1500
      img = "' . $instagram . '"
      posLeft = 800
      posTop = 350
      fontSize = 42
      
      
    } else if (use === "facebook") {
      bannerWidth = 1200
      bannerHeight = 1500
      img = "' . $facebook . '"
      posLeft = 630
      posTop = 1035
      fontSize = 54
    } else if (use === "website-banner") {
      bannerWidth = 300
      bannerHeight = 250
      img = "' . $web_banner . '"
      posLeft = 165
      posTop = 170
      fontSize = 16 
    }
     
    canvas.width = bannerWidth
    canvas.height = bannerHeight
    const bannerSrc =
      lang === "en"
        ? "/wp-content/themes/betheme-child/modules/banner-genaration/images-template/" + img + "_EN.jpg"
        : "/wp-content/themes/betheme-child/modules/banner-genaration/images-template/" + img + "_DE.jpg"
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    let bannerBgImage = new Image(bannerWidth, bannerHeight);
    bannerBgImage.src = bannerSrc;
    bannerBgImage.onload = drawBanner; // Draw when image has loaded
    function drawBanner() {
      ctx.drawImage(this, 0, 0, this.width, this.height) 
      ctx.font = "bold " + fontSize + "px system-ui";
      ctx.fillStyle = "#000000";
      const textformat = lang === "en" ? "Stand: {stand}" : "Stand: {stand}";
      const formatText = textformat.replaceAll("{stand}", stand);
      ctx.fillText(formatText, posLeft, posTop);
    }
    event.preventDefault()
  })

</script>
<style type="text/css"> 
    .banner-image {
        /*width: 100%;
        height: auto;
        border-radius: 0px; */
        width: max-content;
        height: auto;
        border-radius: 0px; 
        max-width: 100%;
    }
    .banner-image {
            background-color: rgba(255, 255, 255, 0.5) !important;
    }
</style>';
    return $shortcode_html;
}