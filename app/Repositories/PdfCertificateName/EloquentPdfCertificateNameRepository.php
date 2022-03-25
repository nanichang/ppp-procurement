<?php
namespace App\Repositories\PdfCertificateName;

use App\PdfCertificateName;

class EloquentPdfCertificateNameRepository implements PdfCertificateNameContract
{
    public function create($requestData)
    {
       return PdfCertificateName::create($requestData);
    }

    public function find($id)
    {
       return PdfCertificateName::find($id);
    }


    public function listAllPDFName()
    {
        return PdfCertificateName::all();
    }


    public function destroy($request){

        $data = $request->nids;
        for($i = 0; $i < sizeof($data); $i++ ){
         $client = PdfCertificateName::where('id', $data[$i])->delete();
        }
        return $client;

    }

    public function update($id, $requestData)
    {
       return PdfCertificateName::find($id)->update($requestData);
    }

}
