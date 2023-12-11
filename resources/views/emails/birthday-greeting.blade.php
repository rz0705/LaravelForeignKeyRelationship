<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Happy Birthday</title>

    <style>
        :root {
            color-scheme: light dark;
            supported-color-schemes: light dark;
        }

        body {
            font-family: Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
            word-spacing: normal;
            height: 100% !important;
            margin: 0 auto !important;
            padding: 0 !important;
            width: 100% !important;
        }

        table,
        td {
            border-collapse: collapse !important;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        img {
            border: 0;
            line-height: 100%;
            outline: none;
            text-decoration: none;
            display: block;
        }

        p,
        h1,
        h2,
        h3 {
            padding: 0;
            margin: 0;
        }

        .tPad-0 {
            padding-top: 0 !important;
        }

        .wFull {
            width: 600px;
        }

        .cta {
            background-color: #ff6f61; /* Bright red */
            font-size: 18px;
            font-family: 'Trebuchet MS', Arial, sans-serif;
            font-weight: bold;
            text-decoration: none;
            padding: 14px 20px;
            color: #ffffff;
            display: inline-block;
            transition: 0.3s !important;
        }

        .cta:hover {
            transition: 0.5s !important;
            background-color: #ff2e00 !important; /* Darker red on hover */
            transform: scale(1.05);
        }

        .footer {
            padding: 50px 0;
            font-size: 14px;
            line-height: 24px;
            mso-line-height-rule: exactly;
            color: #0a080b;
            margin-bottom: 20px;
        }

        .link {
            color: #0a080b;
            text-decoration: underline;
        }

        /* Additional styles for a more colorful look */
        h1 {
            color: #ff6f61; /* Bright red */
        }

        p.std {
            color: #009688; /* Teal */
        }

        .fadeimg:hover {
            opacity: 0.8;
        }
    </style>
</head>

<body class="darkmode body-fix" bgcolor="#ffffff">
    <table class="darkmode" bgcolor="#eeeeee" cellpadding="0" cellspacing="0" border="0" role="presentation"
        style="width:100%;">
        <tr>
            <td class="tPad-0" align="center" valign="top" style="padding-top: 20px;">
                <table class="wFull" cellpadding="0" cellspacing="0" border="0" role="presentation"
                    style="width:600px;background-color: #ffffff;">
                    <tr>
                        {{-- @dd($notifiable); --}}
                        <td align="center" valign="top" style="padding:50px 0;">
                                <img src="https://mir-s3-cdn-cf.behance.net/project_modules/disp/6b3fe963030867.5aa3707f0c627.gif" alt="" srcset="">
                            <h1 style="margin: 0 20px;font-size: 50px; line-height: 60px; text-align: center; color: #0a080b; font-weight: normal;">
                                <a href="https://www.example.com/***utm***" target="_blank"
                                    style="color: #0a080b; text-decoration: none;">Happy Birthday&nbsp;{{$name}}!</a>
                            </h1>
                            <p class="std" style="margin: 50px 20px; font-size: 30px; line-height: 40px; color: #0a080b;">Wishing
                                you a fantastic birthday filled with joy and success. May this year bring you even more
                                happiness and achievements.</p>
                            <a href="https://example.com/***utm***" class="cta">Get a birthday treat on us</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="footer" align="center" valign="top">
                <p>© 2023 Myapp, Inc.<br><br>
                    <a href="https://example.com/***utm***" class="link" target="_blank">Unsubscribe</a>&nbsp;
                </p>
            </td>
        </tr>
    </table>
</body>

</html>
