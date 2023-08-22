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
                                        Hello {{ $data['name'] ?? '' }},
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
                                                    <td align="center" style="padding: 50px 24px 50px;background-color: #ffffff;">
                                                        <table cellpadding="0" cellspacing="0" border="0" style="width:100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="font-size:0;vertical-align:middle">
                                                                        <div style="vertical-align:top;width:100%;max-width:100%;display:inline-block">
                                                                            <table border="0" cellspacing="0" cellpadding="0" style="width:100%">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td style="font-family: 'Poppins', sans-serif;font-size: 31px;line-height:40px;color:#000000;text-align:center;font-weight: 500;">Phone number Changed!</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="font-size:0;vertical-align:middle;text-align: center;height: 79px;">
                                                                        <div style="vertical-align:top;max-width:100%;display:inline-block;text-align: center;width: 97px;height: 1px;">
                                                                            <table border="0" cellspacing="0" cellpadding="0" style="width:100%">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td style="background: #D9D9D9;width: 97px;height: 1px;">
                                                                                            &nbsp;</td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="font-size:0;vertical-align:middle;">
                                                                        <div style="vertical-align:top;width:100%;max-width:100%;display:inline-block">
                                                                            <table border="0" cellspacing="0" cellpadding="0" style="width:100%">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td style="font-family: 'Poppins', sans-serif;font-size: 14px;line-height:29px;color:#3F4246;text-align:center;font-weight: 500;padding-bottom: 39px;">
                                                                                            Your phone number has been changed successfully.
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