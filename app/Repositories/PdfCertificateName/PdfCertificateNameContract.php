<?php
namespace App\Repositories\PdfCertificateName;

interface PdfCertificateNameContract{

    public function find($id);

    public function listAllPDFName();

    public function create($request);

    public function update($id, $request);

    public function destroy($request);
}
