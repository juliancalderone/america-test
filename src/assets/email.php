<?php
header('Content-type: application/json');
$errors = '';
if(empty($errors))
{
	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);
    
    $name = $request->name;
	$phone = $request->phone;
    $from_email = $request->email;
    
	$to_email .= 'julicalderone@hotmail.com';
	$contact = '
				<div style="color:#333;font-weight:300;">
                    <div style="padding:30px; background-color:#0050E4; color:#fff;">
                      <h2 style="color:#fff; font-weight: 300; width:auto">America Car Rental</h2>
                      <hr>
                      <h3 style="font-weight: 300; color: #fff;">Una persona ha completado el formulario de contacto.</h3>
											<h4 style="font-weight: 300; color: #fff;">Informacion de contacto:</h4>
										</div>
                                        <div style="background-color:#fff;color:#333;padding:30px">
											<p><strong>Nompre y apellido: </strong>'. $name.'</p>
											<p><strong>Telefono: </strong>'. $phone.'</p>
                                        	<p><strong>Email: </strong>'.$from_email.'</p>
										</div>
										<div style="background:#eaeaea;padding:30px;color:#333;">
											<h2 style="text-align:right;font-weight:300;color:#252525">America Car Rental</h2>
                      <p style="text-align:left;margin-left:20px"><a style="color:#333;" href="https://americacarrental.com.mx/">America Car Rental</a></p>
                    </div>
				</div>
										
				';
	$website = 'America Car Rental';
	$email_subject = "Nuevo formulario de contacto";
	$email_body = '<html><body>';
	$email_body .= "$contact";
	$email_body .= '</body></html>';
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "From: $from_email\n";
	$headers .= "Reply-To: $from_email";
  	$result = mail($to_email,$email_subject,$email_body,$headers);

	if(!$result) {
		//var_dump("error");
		//echo "Error";
		$response_array['status'] = 'success';
		$response_array['from'] = $from_email;
		header($response_array);
		echo json_encode($response_array);
	} else {
		//var_dump("Success");
		//echo "Success";
		$response_array['status'] = 'error';
		header($response_array);
		echo json_encode($response_array);
    }
} else {
	$response_array['status'] = 'error';
	echo json_encode($response_array);
	header('Location: /error.html');
}

?>