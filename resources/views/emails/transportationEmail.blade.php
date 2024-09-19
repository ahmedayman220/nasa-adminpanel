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
                        <img src="{{ url('images/Bootcamp-Innovation.jpg') }}" alt="NASA Space Apps Cairo 2024" width="100%" height="auto" style="color: #f3ffff;border-radius: 25px;display: block;box-shadow:0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                    </td>
                </tr>
                <!-- Greeting Section -->
                <tr>
                    <td style="padding: 20px; font-family: 'CabinetGrotesk', sans-serif; color: #09131c; line-height: 1.5;">
                        <h1 style="text-align:center; font-size: 24px; margin: 0 0 10px 0; color: #09131c;">Welcome to NASA Space Apps Cairo 2024!</h1>
                        <p style="font-size: 14px; color: #09131c;margin: 0 0 20px 0;"><strong>Dear {{$name}},</strong></p>

                    </td>
                </tr>
                <!--

                @if($workshop && $workshop != "None")
                    <!-- Workshop Section -->
                <tr>
                    <td style="padding: 0 20px 20px 20px; font-family: Arial, sans-serif; color: #09131c;">

                        <p style="text-align: justify; text-justify: inter-word; font-size: 14px; color: #09131c; margin: 0 0 5px 0; font-size: 14px;">
                            We hope you’re as excited as we are for the upcoming NASA Space Apps Cairo 2024 Bootcamp. We are reaching out to extend our sincerest apologies for not being able to accommodate your request for a seat in our transportation routes. Unfortunately, due to limited availability, we were unable to allocate a seat for you this time.
                        </p>
                        <p style="text-align: justify; text-justify: inter-word; font-size: 14px; color: #09131c; margin: 0 0 14px 0; font-size: 14px;">
                            We have shared several alternative options to reach the event location on our Facebook page. We encourage you to check out the post for detailed information on these alternatives.
                        </p>
                    </td>
                </tr>
                <!-- Workshop Details Section -->
                <tr>
                    <td style="padding: 0 20px 20px 20px; font-family: Arial, sans-serif; color: #f3ffff;">
                        <table style="margin-right: auto; margin-left: auto; min-width: 60%;" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td style="background: #202e42; padding: 15px; border-radius: 25px; box-shadow:0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                    <h2 style="font-size: 22px; margin: 0 0 10px 0; color: #f3ffff; text-align: center">Transportation Details</h2>

                                    <p style="font-size: 14px; margin: 5px 0; color: #f3ffff;"><strong>Transportation Post:</strong> <a href="https://bit.ly/NASA2024-TransportationDetails" style="color: #f3ffff; text-decoration: underline"><em>https://bit.ly/NASA2024-TransportationDetails</em></p>

                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                @else
                @endif


                <!-- Closing Section -->
                <tr>
                    <td style="padding: 0 20px 0px 20px; font-family: Arial, sans-serif; color: #09131c;">
                        <p style="text-align: justify; text-justify: inter-word; font-size: 14px; margin: 0 0 15px 0;">
                            Thank you for your understanding, and we can’t wait to see you at the event. Please feel free to reach out to us if you have any further questions or need additional assistance.!
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
