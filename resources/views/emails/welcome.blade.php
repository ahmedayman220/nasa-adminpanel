<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NASA Space Apps Cairo 2024 BootCamp</title>
    <style>
        @font-face {
            font-family: 'CabinetGrotesk';
            src: url('fonts/CabinetGrotesk-Extrabold.woff2') format('woff2'),
            url('fonts/CabinetGrotesk-Extrabold.woff') format('woff');
            font-weight: 800; /* Use the appropriate weight for Extrabold */
            font-style: normal;
        }
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            background-color: #f3ffff;
            font-family: Arial, sans-serif;
        }
        table {
            border-spacing: 0;
        }
    </style>
</head>
<body>
<!-- Outer Table for Background Image -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-image: url('{{ url('images/email-template.jpg') }}'); background-size: cover; background-position: center; width: 100%; padding: 40px 0; background-repeat: no-repeat;">
    <tr>
        <td align="center">
            <!-- Main Container -->
            <table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#f3ffff" style="border-radius: 25px; overflow: hidden; margin-top: 75px;">
                <!-- Header Section -->
                <tr>
                    <td align="center" style="background-color: #f3ffff; padding: 10px 10px 0 10px;">
                        <img src="{{ url('images/email-cover.jpg') }}" alt="NASA Space Apps Cairo 2024" width="100%" height="auto" style="color: #f3ffff;border-radius: 25px;display: block;box-shadow:0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                    </td>
                </tr>
                <!-- Greeting Section -->
                <tr>
                    <td style="padding: 20px; font-family: 'CabinetGrotesk', sans-serif; color: #09131c; line-height: 1.5;">
                        <h1 style="text-align:center; font-size: 24px; margin: 0 0 10px 0; color: #09131c;">Welcome to NASA Space Apps Cairo 2024!</h1>
                        <p style="font-size: 14px; color: #09131c;margin: 0 0 20px 0;"><strong>Dear {{$name}},</strong></p>
                        <p style="font-size: 14px; color: #09131c; margin: 0 0 20px 0; font-size: 14px; text-align: justify; text-justify: inter-word;">
                            Thank you for your interest in attending <strong>NASA Space Apps Cairo Bootcamp 2024.</strong> We are excited to invite you to join us and experience the great moments we have prepared for you! This email contains essential information, so please ensure you read it thoroughly.
                        </p>
                    </td>
                </tr>
                <!--
               <!-- Event Details Section -->
                <tr>
                    <td style="padding: 0 20px 20px 20px; font-family: Arial, sans-serif; color: #f3ffff;">
                        <table style="margin-right: auto; margin-left: auto; min-width:60%;" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td style="margin:auto; float:center; background: #202e42; padding: 15px; border-radius: 25px; box-shadow:0 6px 20px 0 rgba(0, 0, 0, 0.19)">
                                    <h2 style="font-size: 22px; margin: 0 0 10px 0; color: #f3ffff; text-align: center">Event Details</h2>
                                    <p style="font-size: 14px; margin: 5px 0; color: #f3ffff;"><strong>Date:</strong> <em>Saturday, September 14th</em></p>
                                    <p style="font-size: 14px; margin: 5px 0; color: #f3ffff;"><strong>Registration Time:</strong><em> 8 AM</em></p>
                                    <p style="font-size: 14px; margin: 5px 0; color: #f3ffff;"><strong>Location:</strong> <a href="https://maps.app.goo.gl/d6nZRQKrbFWeQcYQ7?g_st=com.google.maps.preview.copy" style="color: #f3ffff; text-decoration: underline"><em>AUC - New Cairo Campus</em></p>
                                    <p style="font-size: 14px; margin: 5px 0; color: #f3ffff;"><strong>Entrance:</strong> <em>Gate 4 - Pepsi Gate</em></p>
                                    <p style="font-size: 14px; margin: 5px 0; color: #f3ffff;"><strong>Note:</strong> <em>Don't forget to bring a paper and a pen!</em></p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                @if($workshop && $workshop != "None")
                <!-- Workshop Section -->
                <tr>
                    <td style="padding: 0 20px 20px 20px; font-family: Arial, sans-serif; color: #09131c;">
                        <h2 style="font-size: 22px; margin: 0 0 10px 0; color: #09131c;"> Workshop Details</h2>
                        <p style="text-align: justify; text-justify: inter-word; font-size: 14px; color: #09131c; margin: 0 0 5px 0; font-size: 14px;">
                            We are pleased to confirm your reserved seat for the workshop. Please note that you will not be able to attend any other workshop or session during the event.
                        </p>
                        <p style="text-align: justify; text-justify: inter-word; font-size: 14px; color: #09131c; margin: 0 0 14px 0; font-size: 14px;">
                            When your workshop time comes, our organizers will guide you to the location and help you register, so please be sure to follow their instructions and have your QR code ready.
                        </p>
                    </td>
                </tr>
                <!-- Workshop Details Section -->
                <tr>
                    <td style="padding: 0 20px 20px 20px; font-family: Arial, sans-serif; color: #f3ffff;">
                        <table style="margin-right: auto; margin-left: auto; min-width: 60%;" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td style="background: #202e42; padding: 15px; border-radius: 25px; box-shadow:0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                    <h2 style="font-size: 22px; margin: 0 0 10px 0; color: #f3ffff; text-align: center">Workshop Details</h2>
                                    <p style="font-size: 14px; margin: 5px 0; color: #f3ffff;"><strong>Workshop Title:</strong> <em> {{ $workshop }}</em></p>
                                    <p style="font-size: 14px; margin: 5px 0; color: #f3ffff;"><strong>Time:</strong><em> {{ $time }}</em></p>
                                    <p style="font-size: 14px; margin: 5px 0; color: #f3ffff;">To get the most out of this workshop, you will need the following:<br>
                                        {!!  $workshop_description !!}
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                @else
                @endif

                <!-- Ticket Details Section -->
                <tr>
                    <td style="padding: 0 20px 20px 20px; font-family: Arial, sans-serif; color: #09131c;">
                        <h2 style="font-size: 22px; margin: 0 0 10px 0; color: #09131c;">Ticket Details</h2>
                        <p style="text-align: justify; text-justify: inter-word; font-size: 14px; color: #09131c; margin: 0 0 5px 0; font-size: 14px;">
                            Your QR code and ticket ID are required for a smooth registration process at the bootcamp and workshops. Please note that our organizers will not be able to assist you without your ticket details.
                        </p>
                        <p style="text-align: justify; text-justify: inter-word; font-size: 14px; color: #09131c; margin: 0 0 14px 0; font-size: 14px;">
                            You will need to present the 4-digit ticket ID at the gate to register for the bootcamp. For workshops and sessions, please have your QR code ready.
                        </p>
                    </td>
                </tr>
                <!-- Workshop Details Section -->
                <tr>
                    <td style="padding: 0 20px 20px 20px; font-family: Arial, sans-serif; color: #f3ffff;">
                        <table style="margin-right: auto; margin-left: auto; min-width: 60%; max-width: 100%;" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td style="background: #202e42; padding: 15px 15px 5px 15px; border-radius: 25px; box-shadow:0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                    <h2 style="font-size: 20px; margin: 0 0 15px 0; color: #f3ffff; text-align: center">QR Code</h2>
                                    <img src="https://{{ $path }}" alt="QR Code" style="display:block; border-radius:25px; width:250px; height:250px; margin-right: auto; margin-left: auto; outline: 10px #fff solid;">
                                    <br />
                                    <h2 style="font-size: 20px; color: #f3ffff; text-align: center">Ticket ID: {{ $uuid }}</h2>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- Closing Section -->
                <tr>
                    <td style="padding: 0 20px 0px 20px; font-family: Arial, sans-serif; color: #09131c;">
                        <p style="text-align: justify; text-justify: inter-word; font-size: 14px; margin: 0 0 10px 0;">
                            Please make sure to follow the instructions provided in this email to ensure the best possible experience at the bootcamp. If you have any questions or require further assistance, feel free to reach out to us.
                        </p>
                        <p style="text-align: justify; text-justify: inter-word; font-size: 14px; margin: 0 0 15px 0;">
                            We look forward to seeing you at the bootcamp and collaborating to make a difference in the world!
                        </p>
                    </td>
                </tr>
                <!-- Footer Section -->
                <tr>
                    <td style="background-color: #f3ffff; padding: 20px; font-family: Arial, sans-serif; color: #09131c;">
                        <p style="font-size: 14px; margin: 0 0 10px 0;">
                            Best Regards,
                        </p>
                        <p style="font-size: 14px;">
                            <strong>NASA Space Apps Cairo Team</strong>
                            <br>
                            Email: <a href="mailto:info@spaceappscairo.com" style="color: blue; text-decoration: underline">info@spaceappscairo.com</a>
                            <br>
                            Website: <a href="www.spaceappscairo.com" style="color: blue; text-decoration: underline">www.spaceappscairo.com</a>
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
