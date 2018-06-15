
<style type="text/css">
    /* What it does: Remove spaces around the email design added by some email clients. */
    /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
    html, body {
        margin: 0 !important;
        padding: 0 !important;
        height: 100% !important;
        width: 100% !important;
    }
    /* What it does: Stops email clients resizing small text. */
    * {
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
    }
    /* What it does: Forces Outlook.com to display emails full width. */
    .ExternalClass {
        width: 100%;
    }
    /* What is does: Centers email on Android 4.4 */
    div[style*="margin: 16px 0"] {
        margin: 0 !important;
    }
    /* What it does: Stops Outlook from adding extra spacing to tables. */
    table, td {
        mso-table-lspace: 0pt !important;
        mso-table-rspace: 0pt !important;
    }
    /* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */
    table {
        border-spacing: 0 !important;
        border-collapse: collapse !important;
        table-layout: fixed !important;
        margin: 0 auto !important;
    }
    table table table {
        table-layout: auto;
    }
    /* What it does: Uses a better rendering method when resizing images in IE. */
    img {
        -ms-interpolation-mode: bicubic;
    }
    /* What it does: Overrides styles added when Yahoo's auto-senses a link. */
    .yshortcuts a {
        border-bottom: none !important;
    }
    /* What it does: Another work-around for iOS meddling in triggered links. */
    a[x-apple-data-detectors] {
        color: inherit !important;
    }
</style>

<!-- Progressive Enhancements -->
<style type="text/css">
    /* What it does: Hover styles for buttons */
    .button-td, .button-a {
        transition: all 100ms ease-in;
    }
    .button-td:hover, .button-a:hover {
        background: #555555 !important;
        border-color: #555555 !important;
    }
</style>
<table cellpadding="0" cellspacing="0" border="0" height="100%" width="100%" bgcolor="#e0e0e0" style="border-collapse:collapse;">
    <tr>
        <td style="vertical-align: top;"><center style="width: 100%;">

                <div style="max-width: 600px;">
                    <!--[if (gte mso 9)|(IE)]>
                    <table cellspacing="0" cellpadding="0" border="0" width="600" align="center">
                        <tr>
                            <td>
                    <![endif]-->

                    <!-- Email Header : BEGIN -->
                    <table cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 600px;">
                        <tr>
                            <td style="padding: 20px 0; text-align: center"><img src="<?php echo Yii::app()->params->base_url ; ?>assets/pages/img/login_logo.png" alt="MyMudra" border="0" style="width: 260px; height: 150px;"></td>
                        </tr>
                    </table>
                    <!-- Email Header : END -->

                    <!-- Email Body : BEGIN -->
                    <table cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#ffffff" width="100%" style="max-width: 600px;">

                        <!-- Hero Image, Flush : BEGIN -->
                        <tr>
                            <td class="full-width-image" align="center" ><img src="<?php echo Yii::app()->params->base_url ; ?>assets/images_email/lock.png" width="600" alt="MyMudra" border="0" style="width: 100%; max-width: 600px; height: auto;"></td>
                        </tr>
                        <!-- Hero Image, Flush : END -->

                        <!-- 1 Column Text : BEGIN -->

                        <tr>
                            <td>
                                <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                    <tr>
                                        <td style="padding:10px 40px; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 12px; color: #555555;text-align: center;">
                                            <h3 style="text-align: center;">##_EMAIL_TMP_FORGOT_PASSWORD_HELLO_##</h3>

                                    <tr>
                                        <td align="center" style="padding:10px 40px; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 12px; color: #555555;text-align: center;"><h3>##_EMAIL_TMP_FORGOT_PASSWORD_VERIFICATION_CODE_##</h3><b> _PASSWORD_CODE_ </b><br /></td>
                                    </tr>
                                    <tr>

                                    </tr>


                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>

                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>

                                    <br>
                                    <br>

                                    <!-- Button : Begin -->

                                    <table cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto;">
                                        <tr>
                                            <!--<td style="border-radius: 3px; background: #c19f65; text-align: center;" class="button-td"><a href="_TMP_USER_CONFIRM_LINK_" style="background: #c19f65; border: 15px solid #c19f65; padding: 0 10px;color: #ffffff; font-family: sans-serif; font-size: 13px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;" class="button-a">-->

                                            <td style="border-radius: 3px; background: #c19f65; text-align: center;" class="button-td"><a href="_TMP_USER_CONFIRM_LINK_" style="background: #FF8C00; border: 15px solid #FF8C00; padding: 0 10px;color: #ffffff; font-family: sans-serif; font-size: 13px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;" class="button-a">
                                                    <!--[if mso]>&nbsp;&nbsp;&nbsp;&nbsp;<![endif]-->Recover Password<!--[if mso]>&nbsp;&nbsp;&nbsp;&nbsp;<![endif]-->
                                                </a></td>
                                        </tr>
                                    </table>

                                    <!-- Button : END -->
                                    <br>
                                    </td>
                                    </tr>
                                </table></td>
                        </tr>
                        <!-- 1 Column Text : BEGIN -->



                    </table>
                    <!-- Email Body : END -->



                    <!--[if (gte mso 9)|(IE)]>
                    </td>
                    </tr>
                    </table>
                    <![endif]-->
                </div>
            </center></td>
    </tr>
</table>




