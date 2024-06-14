
<style>html,body { padding: 0; margin:0; }</style>
<div style="font-family:Arial,Helvetica,sans-serif; line-height: 1.5; font-weight: normal; font-size: 15px; color: #2F3044; min-height: 100%; margin:0; padding:0; width:100%; background-color:#edf2f7">
	<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;margin:0 auto; padding:0; max-width:600px">
		<tbody>
			<tr>
				<td align="center" valign="center" style="text-align:center; padding: 40px">
					<a href="https://keenthemes.com" rel="noopener" target="_blank">
						<img alt="Logo" src="https://it.zeepup.com/front-end/images/logo.png" style="height:66px;width:164px;"/>
					</a>
				</td>
			</tr>
			<tr>
				<td align="left" valign="center">
					<div style="text-align:left; margin: 0 20px; padding: 40px; background-color:#ffffff; border-radius: 6px">
						<!--begin:Email content-->
						<div style="padding-bottom: 30px; font-size: 17px;">
							<strong>Hi there!</strong>
						</div>
						<div style="padding-bottom: 30px">
							A new support ticket has been created by <b>buyer</b> with following details:
</div>
						<div style="padding-bottom: 40px; text-align:center;">
							
<table style="font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;">
  <tr style="padding-top: 12px;padding-bottom: 12px;background-color: #ff0066;color: white;">
    <th style="border: 1px solid #ddd;padding: 8px;">Title</th>
    <th style="border: 1px solid #ddd;padding: 8px;">Value</th>
  </tr>
  <tr style="background-color: #f2f2f2;text-align: left;">
    <td style="border: 1px solid #ddd;padding: 8px;">Name</td>
    <td style="border: 1px solid #ddd;padding: 8px;">{{ $details['name'] }}</td>
  </tr>
  <tr style="background-color: #f2f2f2;text-align: left;">
    <td style="border: 1px solid #ddd;padding: 8px;">Email</td>
    <td style="border: 1px solid #ddd;padding: 8px;">{{ $details['email'] }}</td>
  </tr>
  <tr style="background-color: #f2f2f2;text-align: left;">
    <td style="border: 1px solid #ddd;padding: 8px;">Phone</td>
    <td style="border: 1px solid #ddd;padding: 8px;">{{ $details['phone'] }}</td>
  </tr>
  <tr style="background-color: #f2f2f2;text-align: left;">
    <td style="border: 1px solid #ddd;padding: 8px;">Country</td>
    <td style="border: 1px solid #ddd;padding: 8px;">{{ $details['country'] }}</td>
  </tr>
  <tr style="background-color: #f2f2f2;text-align: left;">
    <td style="border: 1px solid #ddd;padding: 8px;">State</td>
    <td style="border: 1px solid #ddd;padding: 8px;">{{ $details['state'] }}</td>
  </tr>
  <tr style="background-color: #f2f2f2;text-align: left;">
    <td style="border: 1px solid #ddd;padding: 8px;">City</td>
    <td style="border: 1px solid #ddd;padding: 8px;">{{ $details['city'] }}</td>
  </tr>
  <tr style="background-color: #f2f2f2;text-align: left;">
    <td style="border: 1px solid #ddd;padding: 8px;">Type of request</td>
    <td style="border: 1px solid #ddd;padding: 8px;">{{ $details['typeofrequest'] }}</td>
  </tr>
  <tr style="background-color: #f2f2f2;text-align: left;">
    <td style="border: 1px solid #ddd;padding: 8px;">About</td>
    <td style="border: 1px solid #ddd;padding: 8px;">{{ $details['selectedoption'] }}</td>
  </tr>
  <tr style="background-color: #f2f2f2;text-align: left;">
    <td style="border: 1px solid #ddd;padding: 8px;">Details</td>
    <td style="border: 1px solid #ddd;padding: 8px;">{{ $details['details'] }}</td>
  </tr>
	
  <tr style="background-color: #f2f2f2;text-align: left;">
    <td style="border: 1px solid #ddd;padding: 8px;">Attached File</td>
    <td style="border: 1px solid #ddd;padding: 8px;">
	  <img src="{{ asset(($details['file']) ? $details['file'] : 'images/no-image.png') }}" alt="No image" class="img rounded-1 shadow" style="width:120px; height:auto; object-fit:cover;box-shadow: 0 5px 15px 0 rgba(105, 103, 103, 0.5);" />
	  </td>
  </tr>
 
</table>
						
							
						</div>
						<div style="border-bottom: 1px solid #eeeeee; margin: 15px 0"></div>
						
						<!--end:Email content-->
						<div style="padding-bottom: 10px">Kind regards,
						<br>The zeepup Team.
						<tr>
							<td align="center" valign="center" style="font-size: 13px; text-align:center;padding: 20px; color: #6d6e7c;">
								<p>VIA SANTA RADEGONDA 11, 20121 MILANO</p>
								<p>Copyright ©
								<a href="{{URL::to('/');}}" rel="noopener" target="_blank">it.zeepup.com</a>.</p>
							</td>
						</tr><br></div>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</div>