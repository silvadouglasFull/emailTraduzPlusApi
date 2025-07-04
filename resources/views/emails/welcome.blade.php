<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" style="background-color: #ffffff; padding: 40px;">
                    <tr>
                        <td style="text-align: center; font-size: 24px; font-weight: bold; color: #333;">
                            Hy, {{ $data['name'] }}!
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 20px; font-size: 16px; color: #555;">
                            {{$data['message']}}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 30px; text-align: center;">
                            <a href="https://solucoesgreatwall.com" style="background-color: #081a48; color: #fff; padding: 12px 24px; text-decoration: none; border-radius: 5px; display: inline-block;">Visit Site</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 40px; font-size: 12px; color: #999; text-align: center;">
                            &copy; {{ date('Y') }} Great Wall Soluções Linguisticas. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
