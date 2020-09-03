<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
	</head>
<body style="background-color: black; font-family: Poppins-Regular, sans-serif;">
	<div class="page-wrapper">
		<div class="sticky-header animated slideInDown">
	        <div class="auto-container clearfix" style="position: static; max-width: 1200px; padding: 0px 15px; margin: 0 auto;">
	            <div class="logo pull-left" style="float: left;">
	                <a href="{{ route('home.show') }}" style="font-size: 14px; line-height: 1.7; color: #666666;margin: 0px;"><img src="{{ asset('images/logo-white.png') }}" alt="" title=""></a>
	            </div>
	        </div>
	    </div>
		<section style="position: relative; padding: 0px 0px 0px; display: block; padding-top: 100px; padding-left: 20px;">
			<div class="auto-container" style="position: relative; padding-top: 110px; max-width: 1200px; padding: 0px 15px; margin: 0 auto;">
				<div class="row clearfix" style="display: flex;flex-wrap: wrap; margin-right: -15px; margin-left: -15px;">
					<div class="title-column" style="position: relative; margin-bottom: 40px; flex: 0 0 100%; max-width: 100%;">
						<div class="sec-title" style="margin-bottom: 30px; position: relative; z-index: 1;">
							<div class="title" style="    position: relative; display: block; font-size: 20px; color: #3786ff; font-weight: 400; margin-bottom: 10px; letter-spacing: 1px; text-transform: uppercase;">Recibiste un mensaje de</div>
							<h2 style="position: relative;
									    display: block;
									    font-size: 60px;
									    line-height: 1.1em;
									    color: #ffffff;
									    font-weight: 700;
									    text-transform: uppercase;">
											{{ $msg['name'] }}
							</h2>
						</div>
						<div style="position: relative;
								    color: #848484;
								    font-size: 20px;
								    line-height: 1.7em;
								    margin-bottom: 45px;">
										{{ $msg['content'] }}
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</body>
</html>

