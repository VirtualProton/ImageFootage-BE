@extends('email.layouts.master')
@section('content')
<!-- Display name : Start -->
<tr>
    <td align="center" style="background-color:#FFFAFA;padding: 0px 32px;">
        <table cellpadding="0" cellspacing="0" border="0" style="width:100%">
            <tbody>
                <tr>
                    <td align="center">
                        <table cellpadding="0" cellspacing="0" border="0" style="width:100%">
                            <tbody>
                                <tr>
                                    <td style="padding-top: 0px;padding-bottom: 24px;padding-left:32px;padding-right:40px;font-family: 'Poppins', sans-serif;font-size: 16px;line-height:30px;color:#010101;text-align:left;font-weight: 500;">
                                        Hello Srinivas,
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
<!-- Display name: End -->
<tr>
    <td align="center" style="background-color:#FFFAFA;padding: 0px 32px;">
        <table cellpadding="0" cellspacing="0" border="0" style="width:100%">
            <tbody>
                <tr>
                    <td align="center">
                        <table cellpadding="0" cellspacing="0" border="0" style="width:100%">
                            <tbody>
                                <tr>
                                    <td style="padding-top: 0px;padding-bottom: 24px;padding-left:32px;padding-right:40px;font-family: 'Poppins', sans-serif;font-size: 20px;line-height:30px;color:#010101;text-align:left;font-weight: 500;">
                                        Team, Got one contact support request from the website.
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
<tr>
    <td align="center" style="background-color: #fffafa;padding: 0px 32px 32px;">
        <table cellpadding="0" cellspacing="0" border="0" style="width:100%">
            <tbody>
                <tr>
                    <td align="center">
                        <table cellpadding="0" cellspacing="0" border="0" style="width:100%">
                            <tbody>
                                <tr>
                                    <td align="center">
                                        <table cellpadding="0" cellspacing="0" border="0" style="width:100%">
                                            <tbody>
                                                <tr>
                                                    <td align="center" style="padding: 24px 32px 16px;background-color: #ffffff;">
                                                        <table cellpadding="0" cellspacing="0" border="0" style="width:100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="font-size:0;vertical-align:middle">
                                                                        <div style="vertical-align:top;width:100%;max-width:100%;display:inline-block">
                                                                            <table border="0" cellspacing="0" cellpadding="0" style="width:100%">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="left" style="font-family: 'Poppins', sans-serif;font-size: 16px;line-height:26px;color: #000000;text-align:left;font-weight:500;padding-bottom: 8px;padding-right: 10px;">Below are the details:</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td align="left" style="font-family: 'Poppins', sans-serif;font-size: 15px;line-height:26px;color:#3F4246;text-align:left;font-weight:400;padding-bottom: 8px;white-space: normal;word-break: break-all;padding-right: 10px;">
                                                                                            <span style="font-family: 'Poppins', sans-serif;font-size: 15px;line-height:26px;color:#3F4246;text-align:left;font-weight:500;">Name : </span>{{$name ?? ''}}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td align="left" style="font-family: 'Poppins', sans-serif;font-size: 15px;line-height:26px;color:#3F4246;text-align:left;font-weight:400;padding-bottom: 8px;white-space: normal;word-break: break-all;padding-right: 10px;">
                                                                                            <span style="font-family: 'Poppins', sans-serif;font-size: 15px;line-height:26px;color:#3F4246;text-align:left;font-weight:500;">Mobile : </span>{{$mobile ?? ''}}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td align="left" style="font-family: 'Poppins', sans-serif;font-size: 15px;line-height:26px;color:#3F4246;text-align:left;font-weight:400;padding-bottom: 8px;white-space: normal;word-break: break-all;padding-right: 10px;">
                                                                                            <span style="font-family: 'Poppins', sans-serif;font-size: 15px;line-height:26px;color:#3F4246;text-align:left;font-weight:500;">Email : </span>{{$email ?? ''}}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td align="left" style="font-family: 'Poppins', sans-serif;font-size: 15px;line-height:26px;color:#3F4246;text-align:left;font-weight:400;padding-bottom: 8px;white-space: normal;word-break: break-all;padding-right: 10px;">
                                                                                            <span style="font-family: 'Poppins', sans-serif;font-size: 15px;line-height:26px;color:#3F4246;text-align:left;font-weight:500;">Subject : </span>{{$user_subject ?? ''}}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td align="left" style="font-family: 'Poppins', sans-serif;font-size: 15px;line-height:26px;color:#3F4246;text-align:left;font-weight:400;padding-bottom: 8px;white-space: normal;word-break: break-all;padding-right: 10px;">
                                                                                            <span style="font-family: 'Poppins', sans-serif;font-size: 15px;line-height:26px;color:#3F4246;text-align:left;font-weight:500;">Message : </span>{{$user_message ?? ''}}
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
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
    </td>
</tr>
@endsection