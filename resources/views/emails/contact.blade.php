<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Baja Property | Contact Request</title>
</head>

<body>
    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8">
        <tbody>
            <tr>
                <td>
                    <table style="background-color:#f2f3f8;max-width:470px;margin:0 auto" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td style="height:80px">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="height:20px">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" style="max-width:670px;background:#fff;border-radius:3px;text-align:center">
                                        <tbody>
                                            <tr>
                                                <td style="height:40px">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:center">
                                                    <a href="" target="_blank">
                                                        <img style="width:200px" src="{{ asset('assets/img/logo.png') }}" title="logo" alt="logo">
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="height:40px">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:start;padding:0 35px">
                                                    <p>Hi , <br><strong style="color: #83AE3E;"> {{$data['name']}} </strong>is
                                                        interested to get more info about these properties:
                                                    </p>
                                                    @foreach($properties as $property)
                                                    <strong>Propert Details:</strong>
                                                    <p style="margin:8px 10px">
                                                        Property Code : <strong> {{$property->code}} </strong> <br>
                                                        Property Title : <a href="{{url('admin/property-listings/details/' . $property->id )}}"><strong> {{$property->title}} </strong></a> <br>
                                                        Property Neighborhood : <strong> {{$property->neighborhood->title}} </strong> <br>
                                                    </p>
                                                    <br>
                                                    @endforeach

                                                    <strong>Client Details:</strong>
                                                    <p style="margin:8px 10px">

                                                        <span class="im">

                                                            <strong>Email: </strong>
                                                            <a href="mailto:{{$data['email']}}" target="_blank" style="color: #EF5A00;">{{$data['email']}}</a>
                                                            <br>
                                                        </span>
                                                        <strong>Phone:</strong>
                                                        <a href="tel:+{{$data['phone']}}" target="_blank" style="color: #EF5A00;">
                                                            +{{$data['phone']}}
                                                        </a>
                                                        <br> <br>
                                                    </p>
                                                    <strong>Client Message:</strong>
                                                    <p style="margin:8px 10px">
                                                        {{$data['message']}}
                                                    </p>
                                                    <br>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="height:40px">
                                                    <h4 style="color:#83AE3E;text-decoration:none!important;display:inline-block;font-weight:500;margin-top:24px;text-transform:uppercase;font-size:14px;display:inline-block">
                                                        Thank you!</h4>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="height:20px">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="text-align:center">
                                    <p style="font-size:14px;color:rgba(69,80,86,0.7411764705882353);line-height:18px;margin:0 0 0">
                                        Copyright © <strong>MyBajaProperty 2024</strong></p>
                                </td>
                            </tr>
                            <tr>
                                <td style="height:80px">&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>