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
            <h1>Plateau State <br> Bureau of Public Procurement</h1>
            <div>
                <p > Plateau State Bureau of Public Procurement Database of particulars, consultants and service providers.</p>
                  <div style="padding-top: 20px;">
                      <h4>Interim Registration Report (IRR)</h4>
                       <p >This is to acknowledge the ongoing registration of:</p>
                  </div>
               
            </div>
        </center>
        <section  style="margin: 10px;">
        <div>
            <h2 style="border-bottom: 1px solid #eee; margin: 40px;">{{$user->name}}</h2>
            <p style="text-align:justify"> In the Plateau State Bureau of Public Procurement Database of particulars, categorization and classification of contractors, consultants
                 and service poviders as follows:</p>
        </div>
        <div style=" margin-top: 10px;">
        <div style=" margin-top: 30px;">
            <p><b> Registration Type: {{$data->description}}</b></p>
            <p><b> Temporary Contractor ID: #{{$data->registration_id}}</b></p>
            <p><b> Category Fee: {{number_format($data->amount)}} NGN</b></p>
            <p><b> Renewal Fee: {{number_format($data->renewal_amount)}} NGN</b></p>
            <p><b> Date Of Registration: {{$data->created_at}}</b></p>
        </div>
        </div>
        <div style="font-size: 20px; border-bottom: 1px solid #eee; margin-top: 40px;">
            <p>This Report serves as evidence of Interim Registration with the Plateau State Bureau of Public Procurement Database 
                while the claim/information provided by the company is being verified </p>
            <center>  
                <div style="margin-top: 30px;">
                    <p>This Report is Valid til {{$data->expiration_date}}</p>
                </div>
            </center>
        </div>
        
    </div>
</section>
</body>
</html>