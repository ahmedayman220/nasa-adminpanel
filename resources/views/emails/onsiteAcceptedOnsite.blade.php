<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to NASA Space Apps Cairo 2024!</title>
    <style>
        @font-face {
            font-family: 'CabinetGrotesk';
            src: url('fonts/CabinetGrotesk-Extrabold.woff2') format('woff2'),
            url('fonts/CabinetGrotesk-Extrabold.woff') format('woff');
            font-weight: 800;
            /* Use the appropriate weight for Extrabold */
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
<table width="100%" border="0" cellspacing="0" cellpadding="0"
       style="background-image: url('{{ url('images/email-template.jpg') }}'); background-size: cover; background-position: center; width: 100%; padding: 40px 0; background-repeat: no-repeat;">
    <tr>
        <td align="center">
            <!-- Main Container -->
            <table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#f3ffff"
                   style="border-radius: 25px; overflow: hidden; margin-top: 75px;">
                <!-- Header Section -->
                <tr>
                    <td align="center" style="background-color: #f3ffff; padding: 10px 10px 0 10px;">
                        <img src="{{ url('images/hackathon-cover.jpg') }}"
                             alt="NASA Space Apps Cairo 2024" width="100%" height="auto"
                             style="color: #f3ffff;border-radius: 25px;display: block;box-shadow:0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                    </td>
                </tr>
                <!-- Greeting Section -->
                <tr>
                    <td
                        style="padding: 20px; font-family: 'CabinetGrotesk', sans-serif; color: #09131c; line-height: 1.5;">
                        <h1 style="text-align:center; font-size: 24px; margin: 0 0 10px 0; color: #09131c;">Welcome
                            to NASA Space Apps Cairo 2024!</h1>
                        <p style="font-size: 14px; color: #09131c;margin: 0 0 20px 0;"><strong>Dear {{ $name  }}
                                ,</strong></p>
                        <p
                            style="font-size: 14px; color: #09131c; margin: 0 0 20px 0; font-size: 14px; text-align: justify; text-justify: inter-word;">
                            We are pleased to announce that <strong>your application to participate in NASA Space
                                Apps Cairo 2024 has been approved!</strong> Congratulations to you and your team
                            <strong>{{ $team->team_name }}</strong> for securing a spot in one of the most esteemed
                            space
                            hackathons in the world. Your dedication and enthusiasm for space exploration and
                            technology distinguished your application from the many we received. We are confident
                            that your distinctive skills and insights will greatly enhance the event's success.
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
                        style="padding: 20px; font-family: 'CabinetGrotesk', sans-serif; color: #09131c; line-height: 1.5;">
                        <h2 style="font-size: 22px; margin: 0 0 10px 0; color: #09131c;">Important Notes</h2>
                        <p
                            style="font-size: 14px; color: #09131c; margin: 0 0 14px 0; font-size: 14px; text-align: justify; text-justify: inter-word;">
                            To ensure you are well-prepared, we recommend reading our comprehensive Hackathon Guide
                            below. It contains answers to many of your questions and provides essential information
                            about the hackathon.
                        </p>
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
                                    <p style="font-size: 14px; margin: 5px 0; color: #f3ffff;"><strong>Hackathon
                                            Guide:</strong> <em><a
                                                href="https://docs.google.com/document/d/1N9076zTK5R5qCRaha9G2V76ouVqPhcP8A8qIKgspQ5s/edit">Document
                                                Link</a></em></p>
                                    <p style="font-size: 14px; margin: 5px 0; color: #f3ffff;"><strong>Before going
                                            to the hackathon, make sure to:</strong>
                                    <ul>
                                        <li>Fully charge your laptops and power banks.</li>
                                        <li>Install or update any necessary software.</li>
                                        <li>Download and backup any files, datasets, or resources you'll need.</li>
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Ticket Details Section -->
                <tr>
                    <td style="padding: 0 20px 20px 20px; font-family: Arial, sans-serif; color: #09131c;">
                        <h2 style="font-size: 22px; margin: 0 0 10px 0; color: #09131c;">Personal Ticket Details
                        </h2>
                        <p
                            style="text-align: justify; text-justify: inter-word; font-size: 14px; color: #09131c; margin: 0 0 5px 0; font-size: 14px;">
                            You will need your personal ticket details to register for the event. Please note that
                            this ticket is for your use only and cannot be transferred to anyone else. Make sure to
                            have your <strong> QR Code</strong> and <strong>Ticket ID</strong> ready when
                            approaching the registration desk for quick and easy entry.
                        </p>
                        <p
                            style="text-align: justify; text-justify: inter-word; font-size: 14px; color: #09131c; margin: 0 0 14px 0; font-size: 14px;">
                            Please keep your ticket details with you throughout the two days of the event, as our
                            organizers may need to check them at any time.
                        </p>
                    </td>
                </tr>
                <!-- QR Code & Ticket ID -->
                <tr>
                    <td style="padding: 0 20px 20px 20px; font-family: Arial, sans-serif; color: #f3ffff;">
                        <table style="margin-right: auto; margin-left: auto; min-width: 60%; max-width: 100%;"
                               border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td
                                    style="background: #202e42; padding: 15px 15px 5px 15px; border-radius: 25px; box-shadow:0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                    <h2
                                        style="font-size: 20px; margin: 0 0 15px 0; color: #f3ffff; text-align: center">
                                        QR Code</h2>
                                    <img
                                        src="https://drive.google.com/uc?export=view&id=1ieZ11zvzUv3_p5XTNGyam6_w4xeihpRk"
                                        alt="QR Code"
                                        style="display:block; border-radius:25px; width:250px; height:250px; margin-right: auto; margin-left: auto; background-image:url('https://img.freepik.com/free-photo/cement-texture_1194-5331.jpg'); padding:10px">
                                    <br/>
                                    <h2 style="font-size: 20px; color: #f3ffff; text-align: center; margin: 5px;">
                                        {{ $name }}</h2>
                                    <h2 style="font-size: 20px; color: #f3ffff; text-align: center; margin: 5px;">
                                        Ticket ID: {{ $currentMember->uuid }}</h2>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Closing Section -->
                <tr>
                    <td style="padding: 0 20px 0px 20px; font-family: Arial, sans-serif; color: #09131c;">
                        <p
                            style="text-align: justify; text-justify: inter-word; font-size: 14px; margin: 0 0 10px 0;">
                            We are pleased to welcome you to NASA Space Apps Cairo 2024, and we are confident that
                            our collaboration will significantly influence the future of space exploration. Please
                            keep an eye out for upcoming emails, as we will provide you with all the necessary
                            information to fully engage with this remarkable opportunity. Should you have any
                            inquiries or require support, please feel free to contact us.
                        </p>
                        <p
                            style="text-align: justify; text-justify: inter-word; font-size: 14px; margin: 0 0 10px 0;">
                            Once again, congratulations on being part of this remarkable event! Your journey into
                            the cosmos begins now.
                        </p>
                    </td>
                </tr>
                <!-- Footer Section -->
                <tr>
                    <td
                        style="background-color: #f3ffff; padding: 20px; font-family: Arial, sans-serif; color: #09131c;">
                        <p style="font-size: 14px; margin: 0 0 10px 0;">
                            Best Regards,
                        </p>
                        <p style="font-size: 14px;">
                            <strong>NASA Space Apps Cairo Team</strong>
                            <br>
                            Email: <a href="mailto:info@spaceappscairo.com"
                                      style="color: blue; text-decoration: underline">info@spaceappscairo.com</a>
                            <br>
                            Website: <a href="www.spaceappscairo.com"
                                        style="color: blue; text-decoration: underline">www.spaceappscairo.com</a>
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>

</html>
