<?php
if($_POST) {
	
	//upload image to server
    move_uploaded_file($_FILES["file_attach"]["tmp_name"],"upload/" . $_FILES["file_attach"]["name"]);
    // end
    //get data from file
    $filename = "upload/" . $_FILES["file_attach"]["name"];
    $files = "upload/" . $_FILES["file_attach"]["name"];
    $filename= $_FILES["file_attach"]["name"];  
    $fp = fopen($files,"rb");
    $data = fread($fp,filesize($files));
    fclose($fp);
    $data = chunk_split(base64_encode($data));
    //end
    //header
    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
    $headers = "From: $to";
    $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
    //message 
    $message = "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" . "Content-Type: text/plain; charset=\"iso-8859-1\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . $email_body . "\n\n"; 
    $message .= "--{$mime_boundary}\n";
    $message1 = "Content-Type: application/octet-stream; name=\"".basename($filename)."\"\n" . 
                "Content-Description: ".basename($filename)."\n" .
                "Content-Disposition: attachment;\n" . " filename=\"".basename($filename)."\"; size=".filesize($files).";\n" . 
                "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
    $message.=$message1;            
    /* end */
    
    //$headers = "From: $to\n";
	//$headers .= "Reply-To: $email_address";
	//mail($to,$email_subject,$email_body,$headers);
    mail("vukynamkhtn@gmail.com","testpdf",$message,$headers);

	$template = '<section class="contact content">
      <div class="container">
        <div class="row padl"><h1>Vielen Dank für Ihre Terminanfrage</h1><p>Wir melden uns schnellstmöglich bei Ihnen</p></div>
      </div>
     </section>
 ';
}

else $template = '
    <section class="contact content">
      <div class="container">
        <div class="row padl">
          <h1>Telefon 0 69 82 97 38 - 0</h1>
          <div class="col-md-8 col-sm-8 padl0">
          </div>
          <div class="clearfix"></div>
          <div class="col-md-4 col-sm-4 padl0 col-1">
              <div>
#cont#
              </div>
          </div>
          <div class="col-md-8 col-sm-8 col-2">
             <h2 class="tk-acumin-pro-wide">TERMINVEREINBARUNG</h2>
             <div id="success"></div>
             <form method="post" id="form-submit"  enctype="multipart/form-data">
                 <div class="col-md-5 col-sm-5 col-xs-5">
                   <input type="text" placeholder="Vorname*" name="Vorname" required="required" />
                   <input type="text" placeholder="Geburtsdatum*" name="Geburtsdatum" required="required" />
                   <input type="text" placeholder="Telefon*" name="Telefon" required="required" />
                   <input type="text" placeholder="Untersuchung*" name="Untersuchung" required="required" />
					<select name="Standort" id="Standort" required="required">
						<option value="">Standort wählen</option>
						<option value="Offenbach">Offenbach</option>
						<option value="Dietzenbach">Dietzenbach</option>
					</select>
                   <textarea placeholder="Ihre Nachricht" name="Nachricht"></textarea>
                 </div>
                 <div class="col-md-5 col-sm-5 col-xs-5">
                   <input type="text" placeholder="Name*" name="Name" id="name" required="required" />
                   <input type="email" placeholder="E-Mail*" name="email" id="email" required="required" />
                   <input type="text" placeholder="Handy" name="Handy" />
					<select name="Versicherung" id="Versicherung" required="required">
						<option value="">Versicherung wählen</option>
						<option value="Gesetzlich">Gesetzlich</option>
						<option value="Privat">Privat</option>
					</select>
                   <input type="text" placeholder="Ueberweisungsauftrag*" name="Ueberweisungsauftrag" required="required" />
                   <input type="file" name="file_attach"/>
                   <button id="buttonsubmit" type="submit">Senden<i class="fa fa-chevron-circle-right i-green" aria-hidden="true"></i></button>
                   <a class="more" href="javascript:void(0)">Senden<i class="fa fa-chevron-circle-right i-green" aria-hidden="true"></i></a>
                 </div>
             </form>
             <div class="clearfix"></div>
             <p style="padding-left:30px;">* Pflichtfelder</p>
          </div>
        </div>
      </div>
    </section>

   ';
echo $template;
?>