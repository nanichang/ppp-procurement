<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PLBPPA</title>
</head>
<body>
    <div>
        <center>
            <h1>Plateau State Government <br> {{$data->mda->name}}</h1>
            <h3>Certificate of Award</h3>
            <div>
                <p>This certificate of award is presented to <b>{{ $data->contractor->company_name }}</b> on this day <i>{{$data->award_letter_date}}</i>  having fulfilled the requirement for the following</p>
            </div>
        </center>
        <div style="padding-top: 20px;">
            <table style="margin-left: auto; margin-right: auto;">
                <tr>
                    <td><b>Advert:</b></td>
                    <td>{{$data->planAdvert->name}}</td>
                </tr>
                <tr>
                    <td><b>Category:</b></td>
                    <td>{{$data->advertLot->category_name}}</td>
                </tr>
                <tr>
                    <td><b>Package No:</b></td>
                    <td>{{$data->advertLot->package_no}}</td>
                </tr>
                <tr>
                    <td><b>Lot No:</b></td>
                    <td>{{$data->advertLot->lot_no}}</td>
                </tr>
            </table>
            <div style="text-align: center;"><p>{{$data->advertLot->description}}</p></div>
        </div>
</body>
</html>