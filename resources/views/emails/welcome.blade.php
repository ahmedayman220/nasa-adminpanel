<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NASA Space Apps Cairo 2024 BootCamp</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f4;">
<!-- Wrapper Table -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#f4f4f4" style="padding: 20px 0;">
    <tr>
        <td align="center">
            <!-- Main Container -->
            <table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" style="border-radius: 8px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.15);">
                <!-- Header Section -->
                <tr>
                    <td align="center" style="background-color: #0b3d91; padding: 20px;">
                        <img src="https://cdn.mos.cms.futurecdn.net/baYs9AuHxx9QXeYBiMvSLU.jpg.webp" alt="NASA Space Apps Cairo 2024" width="100%" height="auto" style="display: block;">
                    </td>
                </tr>
                <!-- Greeting Section -->
                <tr>
                    <td style="padding: 20px; font-family: Arial, sans-serif; color: #333333; line-height: 1.5;">
                        <h1 style="font-size: 24px; margin: 0 0 10px 0; color: #0b3d91;">You're Invited to NASA Space Apps Cairo 2024!</h1>
                        <p style="margin: 0 0 10px 0;">Dear {{$name}},</p>
                        <p style="margin: 0 0 20px 0;">
                            We are thrilled to invite you to join us for <strong>NASA Space Apps Cairo Bootcamp 2024</strong> which will be held on Saturday, September 14th, at the AUC New Cairo Branch. Your enthusiasm and commitment to this event are greatly appreciated, and we are excited to share some important details with you.
                        </p>
                    </td>
                </tr>
                <!-- Event Details Section -->
                <tr>
                    <td style="padding: 0 20px 20px 20px; font-family: Arial, sans-serif; color: #333333;">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td style="background-color: #f4f4f4; padding: 15px; border-radius: 8px;">
                                    <h2 style="font-size: 20px; margin: 0 0 10px 0; color: #0b3d91;">Event Details</h2>
                                    <p style="margin: 5px 0;"><strong>Date:</strong> on Saturday, September 14th</p>
                                    <p style="margin: 5px 0;"><strong>Registration Time:</strong> 9 AM </p>
                                    <p style="margin: 5px 0;"><strong>Location:</strong>  at the AUC New Cairo Branch </p>
                                    <p style="margin: 5px 0;"><strong>Ticket ID:</strong> {{ $uuid }} </p>
                                    @if($workshop)
                                        <p style="margin: 5px 0;"><strong>Workshop:</strong> {{$workshop}} at <strong>{{$time}}</strong> </p>
                                    @else
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td align="center" style="background-color: #0b3d91; padding: 20px;">
                                    <img src="{{ $path }}" alt="NASA Space Apps Cairo 2024" width="70%" height="auto" style="display: block;">
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- Why Participate Section -->
                <tr>
                    <td style="padding: 0 20px 20px 20px; font-family: Arial, sans-serif; color: #333333;">
                        <h2 style="font-size: 20px; margin: 0 0 10px 0; color: #0b3d91;">Why Participate?</h2>
                        <ul style="margin: 0; padding-left: 20px;">
                            <li style="margin: 10px 0;"><strong>Global Collaboration:</strong> Connect and collaborate with participants from around the world.</li>
                            <li style="margin: 10px 0;"> <strong>Innovative Challenges:</strong> Tackle real-world problems using cutting-edge data and technology.</li>
                            <li style="margin: 10px 0;"><strong>Exciting Prizes:</strong> Stand a chance to win awards and recognition from NASA.</li>
                            <li style="margin: 10px 0;"><strong>Networking Opportunities:</strong> Meet and learn from experts in various fields.</li>
                        </ul>
                    </td>
                </tr>
                <!-- Agenda Section -->
                <tr>
                    <td style="padding: 0 20px 20px 20px; font-family: Arial, sans-serif; color: #333333;">
                        <h2 style="font-size: 20px; margin: 0 0 10px 0; color: #0b3d91;">Event Agenda</h2>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
                            <tr>
                                <th align="left" style="background-color: #0b3d91; color: #ffffff; padding: 10px; border: 1px solid #ddd;">Time</th>
                                <th align="left" style="background-color: #0b3d91; color: #ffffff; padding: 10px; border: 1px solid #ddd;">Activity</th>
                            </tr>
                            <tr>
                                <td style="padding: 10px; border: 1px solid #ddd;">09:00 AM</td>
                                <td style="padding: 10px; border: 1px solid #ddd;">Registration & Welcome</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px; border: 1px solid #ddd;">10:00 AM</td>
                                <td style="padding: 10px; border: 1px solid #ddd;">Kick-off & Challenge Briefing</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px; border: 1px solid #ddd;">11:00 AM</td>
                                <td style="padding: 10px; border: 1px solid #ddd;">Hacking Begins!</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px; border: 1px solid #ddd;">01:00 PM</td>
                                <td style="padding: 10px; border: 1px solid #ddd;">Lunch Break</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px; border: 1px solid #ddd;">02:00 PM</td>
                                <td style="padding: 10px; border: 1px solid #ddd;">Continued Hacking</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px; border: 1px solid #ddd;">05:00 PM</td>
                                <td style="padding: 10px; border: 1px solid #ddd;">Submission Deadline</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px; border: 1px solid #ddd;">06:00 PM</td>
                                <td style="padding: 10px; border: 1px solid #ddd;">Presentations & Judging</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px; border: 1px solid #ddd;">08:00 PM</td>
                                <td style="padding: 10px; border: 1px solid #ddd;">Award Ceremony & Closing</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- Closing Section -->
                <tr>
                    <td style="padding: 0 20px 20px 20px; font-family: Arial, sans-serif; color: #333333;">
                        <p style="margin: 0 0 10px 0;">
                            Please familiarize yourself with the Bootcamp regulations attached. These guidelines are essential to maintain a productive and respectful learning environment for all participants.

                        </p>
                        <p style="margin: 0 0 10px 0;">
                            If you have any questions or need further information, feel free to reach out to us at <a href="https://www.spaceappschallenge.org/nasa-space-apps-2024/2024-local-events/cairo/" style="color: #0b3d91; text-decoration: none;"> NASA Space Apps Cairo Website </a>.
                        </p>
                        <p style="margin: 0 0 10px 0;">
                            We look forward to seeing you at <strong>NASA Space Apps Cairo 2024</strong>!
                        </p>
                        <p style="margin: 0;">
                            Best regards,<br>
                            {{--                                [Your Name]<br>--}}
                            NASA Space Apps Cairo 2024 Team
                        </p>
                    </td>
                </tr>
                <!-- Social Media Section -->
                <tr>
                    <td align="center" style="padding: 20px; background-color: #f4f4f4;">
                        <p style="font-family: Arial, sans-serif; color: #333333; margin: 0 0 10px 0;">Stay Connected</p>
                        <p style="margin: 0;">
                            <a href="https://x.com/spaceappscairo" style="margin: 0 10px;"><img src="https://cdn.prod.website-files.com/5d66bdc65e51a0d114d15891/64cebdd90aef8ef8c749e848_X-EverythingApp-Logo-Twitter.jpg" alt="X" width="30" height="30" style="display: inline-block;"></a>
                            <a href="https://www.facebook.com/spaceappscairo/" style="margin: 0 10px;"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTQKrFhY-ljA-u7J5IMWeTv8zmpBx4PP9nQMw&s" alt="Facebook" width="30" height="30" style="display: inline-block;"></a>
                            <a href="https://www.instagram.com/nasaspaceappscairo/?hl=en" style="margin: 0 10px;"><img src="https://e7.pngegg.com/pngimages/48/304/png-clipart-new-instagram-logo-sharing-social-media-youtube-blog-logo-instagram-text-trademark.png" alt="Instagram" width="30" height="30" style="display: inline-block;"></a>
                            <a href="https://www.spaceappschallenge.org/nasa-space-apps-2024/2024-local-events/cairo/" style="margin: 0 10px;"><img src="https://cdn.mos.cms.futurecdn.net/baYs9AuHxx9QXeYBiMvSLU.jpg.webp" alt="Website" width="30" height="30" style="display: inline-block;"></a>
                        </p>
                    </td>
                </tr>
            </table>
            <!-- End Main Container -->
        </td>
    </tr>
</table>
<!-- End Wrapper Table -->
</body>
</html>
