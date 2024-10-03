<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to NASA Space Apps Cairo 2024 Hackathon!</title>
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
                        <img src="{{ url('images/hackathon-cover.jpg') }}" alt="NASA Space Apps Cairo 2024" width="100%" height="auto" style="color: #f3ffff;border-radius: 25px;display: block;box-shadow:0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                    </td>
                </tr>
                <!-- Greeting Section -->
                <tr>
                    <td style="padding: 20px; font-family: 'CabinetGrotesk', sans-serif; color: #09131c; line-height: 1.5;">
                        <h1 style="text-align:center; font-size: 24px; margin: 0 0 10px 0; color: #09131c;">Welcome to NASA Space Apps Cairo 2024 Hackathon!</h1>
                        <p style="font-size: 14px; color: #09131c;margin: 0 0 20px 0;"><strong>Dear {{$name}},</strong></p>
                        <p style="font-size: 14px; color: #09131c; margin: 0 0 20px 0; font-size: 14px; text-align: justify; text-justify: inter-word;">
                            We are pleased to see you participate in <strong>NASA Space Apps Cairo 2024 Hackathon.</strong> This email contains essential information, so please ensure you read it thoroughly.
                        </p>
                    </td>
                </tr>
                <!-- Event Details Section -->
                <tr>
                    <td style="padding: 0 20px 20px 20px; font-family: Arial, sans-serif; color: #f3ffff;">
                        <table style="margin-right: auto; margin-left: auto; min-width:60%;" border="0"
                               cellspacing="0" cellpadding="0">
                            <tr>
                                <td
                                    style="margin:auto; float:center; background: #202e42; padding: 15px; border-radius: 25px; box-shadow:0 6px 20px 0 rgba(0, 0, 0, 0.19)">
                                    <h2
                                        style="font-size: 22px; margin: 0 0 10px 0; color: #f3ffff; text-align: center">
                                        Event Details</h2>
                                    <p style="font-size: 14px; margin: 5px 0; color: #f3ffff;">
                                        <strong>Date:</strong> <em>Friday and Saturday, October 4th and 5th</em>
                                    </p>
                                    <p style="font-size: 14px; margin: 5px 0; color: #f3ffff;">
                                        <strong>Time:</strong> <em>8:00 AM</em>
                                    </p>
                                    <p style="font-size: 14px; margin: 5px 0; color: #f3ffff;">
                                        <strong>Location:</strong> <a
                                            href="https://maps.app.goo.gl/jZHdr4WFSwffjp1V7"
                                            style="color: #f3ffff; text-decoration: underline"><em>Innovation
                                                University, 10th of Ramadan</em></p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- Important Notes Section -->
                <tr>
                    <td
                        style="padding: 20px; font-family: 'CabinetGrotesk', sans-serif; color: #09131c; line-height: 1.5; text-align: center">
                        <h2 style="font-size: 22px; margin: 0 0 10px 0; color: #09131c;">Team Code: {{ $team->uuid }}</h2>
                    </td>
                </tr>

                <!-- Important notes box -->
                <tr>
                    <td style="padding: 0 20px 20px 20px; font-family: Arial, sans-serif; color: #f3ffff;">
                        <table style="margin-right: auto; margin-left: auto; min-width:60%;" border="0"
                               cellspacing="0" cellpadding="0">
                            <tr>
                                <td
                                    style="margin:auto; float:center; background: #202e42; padding: 15px; border-radius: 25px; box-shadow:0 6px 20px 0 rgba(0, 0, 0, 0.19)">
                                    <h2
                                        style="font-size: 22px; margin: 0 0 10px 0; color: #f3ffff; text-align: center">
                                        Important Notes</h2>

                                    <p style="font-size: 14px; margin: 5px 0; color: #f3ffff;"><strong>Before going
                                            to the hackathon, make sure to:</strong>
                                    <ul>
                                        <li>Fully charge your laptops and power banks, as power sockets are limited per
                                            team!
                                        </li>
                                        <li>Only 2 power strips (مشترك) are allowed to be brought/used per team.</li>
                                        <li>Install/update any necessary software/tool before the hackathon.</li>
                                        <li>Download and backup any files, datasets, models, or resources you'll need.
                                        </li>
                                        <li>Bring your own MiFi, to avoid any internet access/speed issues!</li>
                                        <li>Bring your prayer rug (مصليه) for the jummah prayer.</li>
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Workshop Section -->
                <tr>
                    <td style="padding: 0 20px 20px 20px; font-family: Arial, sans-serif; color: #09131c;">

                    </td>
                </tr>
                <!-- Workshop Details Section -->
                <tr>
                    <td style="padding: 0 20px 20px 20px; font-family: Arial, sans-serif; color: #f3ffff;">
                        <table style="margin-right: auto; margin-left: auto; min-width: 60%;" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td style="background: #202e42; padding: 15px; border-radius: 25px; box-shadow:0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                    <h2 style="font-size: 22px; margin: 0 0 10px 0; color: #f3ffff; text-align: center">Transportation Details</h2>
                                    <p style="font-size: 14px; margin: 5px 0; color: #f3ffff;"><strong>Transportation Routes:</strong> <em> El-Remaya Square </em></p>
                                    <p style="font-size: 14px; margin: 5px 0; color: #f3ffff;"><strong>Telegram Group:</strong> <a href="https://t.me/+dbnatmARVxM0MDJk" style="color: #f3ffff; text-decoration: underline"><em>https://t.me/+6WpjZGT2RUYzZjI0</em></a></p>
                                    <p > </p>
                                    <p style="font-size: 14px; margin: 5px 0; color: #f3ffff;"><strong>Transportation Routes:</strong> <em> Adly Mansour Station </em></p>
                                    <p style="font-size: 14px; margin: 5px 0; color: #f3ffff;"><strong>Telegram Group:</strong> <a href="https://t.me/+K_V6XYKX9eVkYTVk" style="color: #f3ffff; text-decoration: underline"><em>https://t.me/+6WpjZGT2RUYzZjI0</em></a></p>
                                    <p > </p>
                                    <p style="font-size: 14px; margin: 5px 0; color: #f3ffff;"><strong>Transportation Routes:</strong> <em> Abdelmoneam Reyad Bus Stop - Tahrir </em></p>
                                    <p style="font-size: 14px; margin: 5px 0; color: #f3ffff;"><strong>Telegram Group:</strong> <a href="https://t.me/+rd8g81tdoHdkMGE0" style="color: #f3ffff; text-decoration: underline"><em>https://t.me/+6WpjZGT2RUYzZjI0</em></a></p>
                                    <p > </p>
                                    <p style="font-size: 14px; margin: 5px 0; color: #f3ffff;"><strong>Note:</strong> <em>Please make sure to join the Telegram group of your submitted route to know the exact pickup location and departure time. Kindly do not share this email/group with anyone, as no one other than those who received this confirmation mail will get onto the bus!</em></p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Closing Section -->
                <tr>
                    <td style="padding: 0 20px 0px 20px; font-family: Arial, sans-serif; color: #09131c;">
                        <p style="text-align: justify; text-justify: inter-word; font-size: 14px; margin: 0 0 10px 0;">
                            Our organizers will guide you to the location and help you jump on your bus, so please be sure to follow their instructions and have your National ID ready.

                            Please make sure to follow the instructions provided in this email to ensure the best possible experience at the Hackathon. If you have any questions or require further assistance, feel free to reach out to us.
                        </p>
                        <p style="text-align: justify; text-justify: inter-word; font-size: 14px; margin: 0 0 15px 0;">
                            We look forward to seeing you at the hackathon and collaborating to make a difference in the world!
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
