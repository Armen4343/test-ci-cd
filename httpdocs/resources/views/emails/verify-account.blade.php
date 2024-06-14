
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
							<strong>Benvenuto su ZeepUp!</strong>
						</div>
						<div style="padding-bottom: 30px">Ciao <b> {{ $details['name'] }} </b>, per attivare il tuo account, fai clic sul link in basso per verificare il tuo indirizzo email. Una volta attivato, avrai pieno accesso a ZeepUp.</div>
						<div style="padding-bottom: 40px; text-align:center;">
							<a href="{{ route('user.verify', $details['token']) }}" rel="noopener" style="text-decoration:none;display:inline-block;text-align:center;padding:0.75575rem 1.3rem;font-size:0.925rem;line-height:1.5;border-radius:0.35rem;color:#ffffff;background-color:#50CD89;border:0px;margin-right:0.75rem!important;font-weight:600!important;outline:none!important;vertical-align:middle" target="_blank">Attiva account</a>
						</div>
						<div style="border-bottom: 1px solid #eeeeee; margin: 15px 0"></div>
						<div style="padding-bottom: 50px; word-wrap: break-all;">
							<p style="margin-bottom: 10px;">Il link non funziona? Prova a incollare questo URL nel tuo browser:</p>
							<a href="{{ route('user.verify', $details['token']) }}" rel="noopener" target="_blank" style="text-decoration:none;color: #50CD89">{{ route('user.verify', $details['token']) }}</a>
						</div>
						<!--end:Email content-->
						<div style="padding-bottom: 10px">Cordiali saluti,
						<br>Il team di ZeepUp.
						<tr>
							<td align="center" valign="center" style="font-size: 13px; text-align:center;padding: 20px; color: #6d6e7c;">
								<p>VIA SANTA RADEGONDA 11, 20121 MILANO</p>
								<p>Copyright ©
								<a href="{{URL::to('/');}}" rel="noopener" target="_blank">it.zeepup.com</a>.</p>
							</td>
						</tr></br></div>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</div>
