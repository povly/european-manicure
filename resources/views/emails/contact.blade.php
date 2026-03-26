<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ __('New Contact Form Submission') }}</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h1 style="color: #333; border-bottom: 2px solid #eee; padding-bottom: 10px;">
            {{ __('New Contact Form Submission') }}
        </h1>

        <table style="width: 100%; border-collapse: collapse;">
            @isset($data['name'])
                <tr>
                    <td style="padding: 10px 0; font-weight: bold; width: 30%;">{{ __('Name') }}:</td>
                    <td style="padding: 10px 0;">{{ $data['name'] }}</td>
                </tr>
            @endisset

            @isset($data['email'])
                <tr>
                    <td style="padding: 10px 0; font-weight: bold;">{{ __('Email') }}:</td>
                    <td style="padding: 10px 0;">
                        <a href="mailto:{{ $data['email'] }}" style="color: #0066cc;">{{ $data['email'] }}</a>
                    </td>
                </tr>
            @endisset

            @isset($data['phone'])
                <tr>
                    <td style="padding: 10px 0; font-weight: bold;">{{ __('Phone') }}:</td>
                    <td style="padding: 10px 0;">{{ $data['phone'] }}</td>
                </tr>
            @endisset
        </table>

        <p style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee; color: #666; font-size: 12px;">
            {{ __('This email was sent from the contact form on') }} {{ config('app.name') }}
        </p>
    </div>
</body>
</html>
