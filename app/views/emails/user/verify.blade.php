<div marginwidth="0" marginheight="0" style="text-align:left;margin:0;font-family:Helvetica,'Helvetica Neue',Arial,sans-serif;padding:0" bgcolor="#ffffff">
	<div style="text-align:center">
		
		<table border="0" cellpadding="0" cellspacing="0" style="margin:0 auto 0 auto;padding:0;text-align:left;width:560px">
			<tbody>
				<tr>
					<td colspan="2" height="10" style="font-size:1px;line-height:10px">&nbsp;</td></tr>
				<tr>
					<td rowspan="8" align="right" valign="top">
						<a href="{{ URL::route('home-index') }}" title="{{ Lang::get('company.name') }}" target="_blank"></a></td>
					<td align="left" valign="top">
						<table border="0" cellpadding="0" cellspacing="0" style="margin:0 auto 0 auto;padding:0;width:510px">
							<tbody>
								<tr>
									<td>
										<h1 style="color:#000000!important;display:block;font-family:Helvetica,'Helvetica Neue',Arial,sans-serif;font-size:24px;font-weight:bold;line-height:26px;text-align:left;margin:0;padding:0;text-transform:none" align="left">{{ Lang::get('email.heading') }}</h1>
									</td>
								</tr>
							</tbody>
						</table></td></tr>
				<tr>
					<td height="10">
						<table border="0" cellpadding="0" cellspacing="0" style="margin:0 auto 0 auto;padding:0;width:510px">
							<tbody>
								<tr>
									<td style="font-size:1px;line-height:10px;border-bottom:1px solid #cecece">&nbsp;</td></tr>
							</tbody>
						</table></td></tr>
				<tr>
					<td height="14" style="font-size:8px;line-height:14px">&nbsp;</td></tr>
				<tr>
					<td align="left" valign="top" width="510" style="line-height:21px;text-align:left;text-transform:none;font-size:14px;margin:0;font-family:Helvetica,'Helvetica Neue',Arial,sans-serif;padding:0">
						<table border="0" cellpadding="0" cellspacing="0" style="margin:0 auto 0 auto;padding:0;width:498px;font-family:Helvetica,'Helvetica Neue',Arial,sans-serif;font-size:12px;line-height:18px">
							<tbody>
								<tr style="height:1px;font-size:1px;line-height:1px">
									<td>&nbsp;</td></tr>
								<tr>
									<td style="font-size:14px;line-height:20px">
										<h3>Please verify your account</h3>
										<p>To complete your registration process, please click on the following link to validate your email address: <a href="{{ URL::to('user/verify/'.$crypt_user_id) }}" target="_blank">{{ URL::to('user/verify/'.$crypt_user_id) }}</a>.</p></td></tr>
								<tr>
									<td style="font-size:1px;line-height:15px;height:15px">&nbsp;</td></tr>

							</tbody>
						</table>
				<tr>
					<td height="10" style="font-size:1px;line-height:10px;border-top:1px solid #cecece">&nbsp;</td></tr>
				<tr>
					<td align="left" valign="top" style="line-height:15px;text-align:left;text-transform:none;font-size:12px;margin:0;font-family:Helvetica,'Helvetica Neue',Arial,sans-serif;padding:0">
						
						<!-- TODO: create email management page in dashboard and link below -->
						<a href="#" style="color:#0088cc!important;font-weight:normal!important;text-decoration:none!important;border:0" target="_blank">Manage my GlobalTowerBrasil.com account settings</a><br>
						{{ Lang::get('email.footer') }}</td></tr>
			</tbody>
		</table>
	</div>
</div>
