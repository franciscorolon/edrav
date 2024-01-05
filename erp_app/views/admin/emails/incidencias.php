<html><head></head>
<body>
<style >
    @media screen and (max-width: 767px){
        table{width:100%;}
    }
</style>
<table bgcolor=#eaeaea>
	<div class="content">
		<table width="520" align="center" border="0" cellspacing="0" cellpadding="0" style="width:520px; color:#454545; font-size:12px; border-collapse:collapse; background-color:#ffffff">
			<tbody>
				<tr height="90" style="height:90px">
					<td height="90" style="height:90px">
						<table bgcolor="#0078D7" width="100%" height="90" cellspacing="0" cellpadding="0" style="height:90px">
							<tbody>
								<tr height="90" style="height:90px">
									<td width="90" height="90" style="width:90px; height:90px; margin:0; padding:0">
										<div height="90" width="90" border="0" style="width:90px; height:90px; margin:0; padding:0">
										</div>
									</td>
									<td bgcolor="#0078D7" height="90" style="height:90px">
										<div style="color: rgb(255, 255, 255); font-family: &quot;Segoe UI Light&quot;, &quot;Segoe WP Light&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, serif, EmojiFont; margin: 0px 30px; font-size: 18px;">
			Incidencia de la Orden No. <?=$incidencia['no_orden']?>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="color:#454545; font-size:12px; border-collapse:collapse; background-color:#ffffff; margin:0; padding:0">
							<tbody>
								<tr>
									<td>
										<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse">
											<tbody>
												<tr>
													<td style="vertical-align:top; margin:0">
														<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse">
															<tbody>
																<?php if(strlen($incidencia['status']) > 0):?>
																<tr>
																	<td width="46" style="width:46px">
																		<div style="margin:20px 10px 8px 20px; padding:0; width:16px; height:16px"><img src="https://www.pix2byte.com/assets/edrav/images/estado.png" width="16" height="16" alt="Estado" style="width: 16px; height: auto; display: inline; margin: 0px; cursor: pointer; max-width: 100%;" crossorigin="use-credentials">
																		</div>
																	</td>
																	<td>
																		<div style="margin:20px 20px 10px 10px; padding:0; line-height:20px; vertical-align:middle; font-weight:bold">
			<?=$incidencia['status']?>
																		</div>
																	</td>
																</tr>
																<?php endif;?>
																<tr>
																	<td width="46" style="width:46px">
																		<div style="margin:20px 10px 8px 20px; padding:0; width:16px; height:16px"><img src="https://www.pix2byte.com/assets/edrav/images/calendario.png" width="16" height="16" alt="Fecha" style="width: 16px; height: auto; display: inline; margin: 0px; cursor: pointer; max-width: 100%;" crossorigin="use-credentials">
																		</div>
																	</td>
																	<td>
																		<div style="margin:20px 20px 10px 10px; padding:0; line-height:20px; vertical-align:middle; font-weight:bold">
			<?=$this->functions->fecha_incidencia($incidencia['fecha_incidencia'])?>
																		</div>
																	</td>
																</tr>
																<tr>
																	<td width="46" style="width:46px">
																		<div style="margin:10px 10px 8px 20px; padding:0; width:16px; height:16px">
																			<img src="https://www.pix2byte.com/assets/edrav/images/usuario.png" width="16" height="16" alt="Hora" style="width: 16px; height: auto; display: inline; margin: 0px; cursor: pointer; max-width: 100%;" crossorigin="use-credentials">
																		</div>
																	</td>
																	<td>
																		<div style="margin:7px 20px 10px 10px; padding:0; line-height:20px; vertical-align:middle">
			<?=$incidencia['generado_por']?>
																		</div>
																	</td>
																</tr>
																<tr>
																	<td width="46" style="width:46px">
																		<div style="margin:10px 10px 8px 20px; padding:0; width:16px; height:16px">
																			<img src="https://www.pix2byte.com/assets/edrav/images/llamada.png" width="16" height="16" alt="Hora" style="width: 16px; height: auto; display: inline; margin: 0px; cursor: pointer; max-width: 100%;" crossorigin="use-credentials">
																		</div>
																	</td>
																	<td>
																		<div style="margin:7px 20px 10px 10px; padding:0; line-height:20px; vertical-align:middle">
			<?=($incidencia['llamada'])?'Si':'No'?>
																		</div>
																	</td>
																</tr>
																<tr>
																	<td width="46" style="width:46px">
																		<div style="margin:10px 10px 8px 20px; padding:0; width:16px; height:16px">
																			<img src="https://www.pix2byte.com/assets/edrav/images/chat.png" width="16" height="16" alt="Hora" style="width: 16px; height: auto; display: inline; margin: 0px; cursor: pointer; max-width: 100%;" crossorigin="use-credentials">
																		</div>
																	</td>
																	<td>
																		<div style="margin:7px 20px 10px 10px; padding:0; line-height:20px; vertical-align:middle">
			<?=$incidencia['incidencia']?>
																		</div>
																	</td>
																</tr>
															</tbody>
														</table>
			</td>
			</tr>
			</tbody>
			</table>
			</td>
			</tr>
			</tbody>
			</table>
			</td>
			</tr>
			</tbody>
			</table>
	</div>
</table>
</body>
</html>