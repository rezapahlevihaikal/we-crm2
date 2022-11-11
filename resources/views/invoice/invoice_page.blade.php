<!DOCTYPE html>
<html>
<head>
    <title>INV-{{$dataInvoice->inv_number}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<style type="text/css">
    body{
        font-family: 'Roboto Condensed', sans-serif;
    }
    .m-0{
        margin: 0px;
    }
    .p-0{
        padding: 0px;
    }
    .pt-5{
        padding-top:5px;
    }
    .mt-10{
        margin-top:10px;
    }
    .text-center{
        text-align:center !important;
    }
    .w-100{
        width: 100%;
    }
    .w-10{
        width: 10%;
    }
    .w-25{
        width: 25%;
    }
    .W35{
        width: 35%;
    }
    .w-40{
        width: 40%;
    }
    .w-50{
        width:50%;   
    }
    .w-75{
        width:75%;   
    }
    .w-15{
        width:15%;   
    }
    .w-5{
        width: 5%;
    }
    .logo img{
        width:200px;
        height:45px;
        margin
    }
    .logo span{
        margin-left:8px;
        top:19px;
        position: absolute;
        font-weight: bold;
        font-size:25px;
    }
    .gray-color{
        color:#5D5D5D;
    }
    .text-bold{
        font-weight: bold;
    }
    .border{
        border:1px solid black;
    }
    table tr,th,td{
        /* border: 1px solid #d2d2d2; */
        border-collapse:collapse;
        padding:7px 8px;
    }
    table tr th{
        background: #F4F4F4;
        font-size:15px;
    }
    table tr td{
        font-size:13px;
    }
    table{
        border-collapse:collapse;
    }
    .box-text p{
        line-height:10px;
    }
    .float-left{
        float:left;
    }
    .float-center{
        float: center;
    }
    .total-part{
        font-size:16px;
        line-height:12px;
    }
    .total-right p{
        padding-right:20px;
    }
    .no-break{
        page-break-before: always;
    }
    hr.dashed {
  border-top: 0px dotted #bbb;
}
</style>
<body>
{{-- Invoice --}}
<div class="head-title" style="">
    <p style="text-align:center;"><img src="https://quadrant1komunika.co.id/wp-content/uploads/2021/10/cropped-logo-Q1-02-01.png" style="width: 230px; height: 45px;"></p>
    <h5 style="text-align: center;"><i> a member of </i> <img src="https://wartaekonomi.co.id/img/logo.png" alt="" style="width: 130px; height: 20px; vertical-align:sub;"></h5>
</div>
<div class="add-detail mt-10">
    <div class="w-50 float-left mt-10">
        <p class="m-0 pt-5 text-bold w-100">INVOICE</p>
        <p class="m-0 pt-5 text-bold w-100">Tanggal - <span class="gray-color">{{ date('d-m-Y', strtotime($dataInvoice->inv_date)) }}</span></p>
        <p class="m-0 pt-5 text-bold w-100">Nomor Invoice - <span class="gray-color">{{$dataInvoice->inv_number}}</span></p>
        <p class="m-0 pt-5 text-bold w-100">Kode Sales - <span class="gray-color">{{$dataInvoice->sales_code}}</span></p>
        <p class="m-0 pt-5 text-bold w-100">Nomor Order - <span class="gray-color">{{$dataInvoice->no_order}}</span></p>
    </div>
    {{-- <div class="w-50 float-left logo mt-10">
        <img src="https://www.nicesnippets.com/image/imgpsh_fullsize.png"> <span>Nicesnippets.com</span>     
    </div> --}}
    <div style="clear: both;"></div>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10" style="border: 1px solid #d2d2d2;">
        <tr>
            <th class="w-50" style="border: 1px solid #d2d2d2;">Dari</th>
            <th class="w-50" style="border: 1px solid #d2d2d2;">Kepada</th>
        </tr>
        <tr>
            <td style="border: 1px solid #d2d2d2;">
                <div class="box-text">
                    <p> <b>PT. Kuadran Satu Komunika</b></p>
                    <p>Jl. Tebet Raya No. 85A</p>
                    <p>Tebet - Jakarta Selatan 12820</p>
                    <p>Telp: +62 21 82850466</p>
                    <p>NPWP 82.417.388.4-015.000</p>
                </div>
            </td>
            <td style="border: 1px solid #d2d2d2;">
                <div class="box-text">
                    <p style="line-height: normal"><b>{{$dataInvoice->getCompany->company_name}}</b></p>
                    <p style="line-height: normal">@nl2br($dataInvoice->address_npwp)</p>
                    <p>{{$dataInvoice->getCompany->zipcode}}</p>
                </div>
            </td>
        </tr>
    </table>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10" style="border: 1px solid #d2d2d2;">
        <tr style="border: 1px solid #d2d2d2;">
            <th style="border: 1px solid #d2d2d2;" class="w-40">Keterangan</th>
            <th style="border: 1px solid #d2d2d2;" class="w-10">Unit</th>
            <th style="border: 1px solid #d2d2d2;" class="w-25">Harga Satuan</th>
            <th style="border: 1px solid #d2d2d2;" class="w-25">Jumlah Harga</th>
           
        </tr>
        <tr align="center" style="border: 1px solid #d2d2d2;">
            <td style="border: 1px solid #d2d2d2;">{{$dataInvoice->getProduct->name}}</td>
            <td style="border: 1px solid #d2d2d2;">{{$dataInvoice->getProduct->quantity}}</td>
            <td style="border: 1px solid #d2d2d2;">@currency($dataInvoice->based_value)</td>
            <td style="border: 1px solid #d2d2d2;">@currency($dataInvoice->based_value)</td>
            
        </tr>
        <tr style="border: 1px solid #d2d2d2;">
            <td colspan="4">
                <div class="total-part">
                    <div class="total-left w-75 float-left" align="right">
                        <p>Sub Total</p>
                        <p>PPN 11%</p>
                        @if ($dataInvoice->pph_23 == null || $dataInvoice->pph_23 == 0)
                            
                        @else
                            <p>PPH 23</p>
                        @endif
                        <p>Total Keseluruhan</p>
                    </div>
                    <div class="total-right w-25 float-left text-bold" align="right">
                        <p>@currency($dataInvoice->based_value)</p>
                        <p>@currency($dataInvoice->ppn)</p>
                        @if ($dataInvoice->pph_23 == null || $dataInvoice->pph_23 == 0)
                            
                        @else
                            <p>(@currency($dataInvoice->pph_23))</p>
                        @endif
                        <p>@currency($dataInvoice->based_value + $dataInvoice->ppn - $dataInvoice->pph_23)</p>
                    </div>
                    <div style="clear: both;"></div>
                </div> 
            </td>
        </tr>
        <tr style="border: 1px solid #d2d2d2;">
            <td colspan="4">
                <p>Terbilang : <b>"<i>{{ucwords($dataInvoice->terbilang)}}</i>"</b></p>
            </td>

        </tr>
    </table>
</div>
{{-- <div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-50 mt-10" style="border: 1px solid #d2d2d2;">
        <tr>
            <th class="w-50">Metode Pembayaran</th>
        </tr>
        <tr>
            <td>
                <p>Transfer Atas Nama :</p>
                <p> <b>PT. Kuadran Satu Komunika</b></p>
                <p>Bank BRI</p>
                <p><b>Acc No. 0335.01.00224430.8</b></p>
                <p style="line-height: normal">
                    Transfer Atas Nama : <br>
                    <b>PT. Kuadran Satu Komunika</b> <br>
                    Bank BRI <br>
                    <b>Acc No. 0335.01.00224430.8</b>
                </p>
            </td>
        </tr>
    </table>
</div> --}}
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10" style="border: 1px solid #d2d2d2;">
        <tr style="border: 1px solid #d2d2d2;">
            <th style="border: 1px solid #d2d2d2;" class="w-30">Metode Pembayaran</th>
            <th style="border: 1px solid #d2d2d2;" class="w-70">Homat Kami</th>
           
        </tr>
        <tr align="center" style="border: 1px solid #d2d2d2;">
            <td style="border: 1px solid #d2d2d2;">
                <p style="line-height: normal">
                    Transfer Atas Nama : <br>
                    <b>PT. Kuadran Satu Komunika</b> <br>
                    Bank BRI <br>
                    <b>Acc No. 0335.01.00224430.8</b>
                </p>
            </td>
            <td style="border: 1px solid #d2d2d2;">
                <p></p>
                <p></p>
                <p></p>
                <p></p>
                <p>Ayu Wanda</p>
            </td>           
        </tr>
    </table>
</div>


{{------------------------------------------ Kwitansi --------------------------------------------}}
<div class="no-break">
    <div class="head-title" style="">
        <p style="text-align:center;"><img src="https://quadrant1komunika.co.id/wp-content/uploads/2021/10/cropped-logo-Q1-02-01.png" style="width: 230px; height: 45px;"></p>
        <h5 style="text-align: center; margin-top: 5px"><i> a member of </i> <img src="https://wartaekonomi.co.id/img/logo.png" alt="" style="width: 130px; height: 20px; vertical-align:sub;"></h5>
    </div>
    <div class="add-detail mt-10">
        <div class="w-50 float-left mt-10">
            <p class="m-0 pt-5 text-bold w-100">KWITANSI</p>
            <p class="m-0 pt-5 text-bold w-100">Nomor Kwitansi - <span class="gray-color">{{$dataInvoice->receipt_number}}</span></p>
        </div>
        {{-- <div class="w-50 float-left logo mt-10">
            <img src="https://www.nicesnippets.com/image/imgpsh_fullsize.png"> <span>Nicesnippets.com</span>     
        </div> --}}
        <div style="clear: both;"></div>
    </div>
    <div class="table-section bill-tbl w-100 mt-10">
        <table class="table w-100 mt-10" style="border: 1px solid #d2d2d2;">
            <tr>
                <th style="border: 1px solid #d2d2d2;" class="w-35">SUDAH DITERIMA DARI</th>
                <td style="border: 1px solid #d2d2d2;">
                    <div class="box-text">
                        <p> <b>{{$dataInvoice->getCompany->company_name}}</b></p>
                        <p style="line-height: normal">@nl2br($dataInvoice->address_npwp)</p>
                        <p>{{$dataInvoice->getCompany->zipcode}}</p>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="w-35" style="border: 1px solid #d2d2d2;">BANYAKNYA UANG</th>
                <td style="border: 1px solid #d2d2d2;">
                    <div class="box-text">
                        <p> <b>@currency($dataInvoice->based_value + $dataInvoice->ppn - $dataInvoice->pph_23)</b></p>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="w-35" style="border: 1px solid #d2d2d2; font-size: 15px">TERBILANG</th>
                <td style="border: 1px solid #d2d2d2;">
                    <div class="box-text">
                        <p> <b>"<i>{{ucwords($dataInvoice->terbilang)}}</i>"</b> </p>
                    </div>
                </td>
            </tr>
            <tr>
                <th class="w-35" style="border: 1px solid #d2d2d2;">UNTUK PEMBAYARAN</th>
                <td style="border: 1px solid #d2d2d2;">
                    <div class="box-text">
                        <p> <b>"{{$dataInvoice->getProduct->name}}"</b></p>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="add-detail mt-10">
        <div class="w-75 float-left mt-10">
          
        </div>
        <div class="w-25 float-left">
            <p>Jakarta, {{ date('d-m-Y', strtotime($dataInvoice->inv_date)) }}</p>
            <h5 style="text-align: center">Hormat Kami</h5>
            <p></p>    
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <h5 style="text-align: center">Ayu Wanda</h5>
        </div>
    </div>
</div>


{{--------------------------------------- Tanda Terima -----------------------------------------}}
<div class="no-break">
    <div class="head-title" style="">
        <p style="text-align:center;"><img src="https://quadrant1komunika.co.id/wp-content/uploads/2021/10/cropped-logo-Q1-02-01.png" style="width: 80px; height: 15px;"></p>
        <h5 style="text-align: center; margin-top: 5px"><i> a member of </i> <img src="https://wartaekonomi.co.id/img/logo.png" alt="" style="width: 130px; height: 20px; vertical-align:sub;"></h5>
    </div>
    <div class="table-section bill-tbl w-100">
        <table class="table w-100">
            <tr>
                <th class="w-50" style="border: 1px solid #d2d2d2;">Dari</th>
                <th class="w-50" style="border: 1px solid #d2d2d2;">Kepada</th>
            </tr>
            <tr>
                <td class="w-50" style="border: 1px solid #d2d2d2;">
                    <div class="box-text">
                        <p style="line-height: normal">
                            <b>PT. Kuadran Satu Komunika</b> <br>
                            Jl. Tebet Raya No. 85A <br>
                            Telp: +62 21 82850466 <br>
                            NPWP 82.417.388.4-015.000
                        </p>
                    </div> 
                </td>
                <td style="border: 1px solid #d2d2d2;">
                    <div class="box-text">
                        <p style="line-height: normal">
                            <b>{{$dataInvoice->getCompany->company_name}}</b> <br>
                            @nl2br($dataInvoice->pic_inv) <br>
                            Telp :
                        </p>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="text-align: center">
                    <b>Harap Diterima</b> 
                </td>
                <td style="text-align: center">
                    <b>Yang Menerima</b> 
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid #d2d2d2;" class="w-25">
                    No. Invoice : {{$dataInvoice->inv_number}}
                </td>
                <td style="border: 1px solid #d2d2d2;">
                    Nama :
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid #d2d2d2;" class="w-25">
                    <p style="line-height: normal">
                        Ket : "<i><b>{{$dataInvoice->getProduct->name}}</b></i> "
                    </p>
                </td>
                <td style="border: 1px solid #d2d2d2;">
                    Bagian :
                </td>
            </tr>
            {{-- <tr>
                <td colspan="2" style="border: 1px solid #d2d2d2;" class="w-25">
                    Keterangan :
                </td>
            </tr> --}}
            <tr>
                <td colspan="2" style="text-align: right">
                    Jakarta, {{ date('d-m-Y', strtotime($dataInvoice->inv_date)) }}
                </td>
            </tr>
            <tr>
                <td>
                    <b>Paraf Penerima</b>
                </td>
                <td style="text-align: center">
                    <b>Hormat Kami</b>
                </td>
            </tr>
            <tr>
                <td>
                    Nama Jelas :
                </td>
                <td style="text-align: center">
                   <b>PT Kuadrant Satu Komunika</b>
                </td>
            </tr>
        </table>
    </div>
    <div>
        <hr class="dashed">
    </div>
    <div class="head-title" style="">
        <p style="text-align:center;"><img src="https://quadrant1komunika.co.id/wp-content/uploads/2021/10/cropped-logo-Q1-02-01.png" style="width: 80px; height: 15px;"></p>
        <h5 style="text-align: center; margin-top: 5px"><i> a member of </i> <img src="https://wartaekonomi.co.id/img/logo.png" alt="" style="width: 130px; height: 20px; vertical-align:sub;"></h5>
    </div>
    <div class="table-section bill-tbl w-100">
        <table class="table w-100">
            <tr>
                <th class="w-50" style="border: 1px solid #d2d2d2;">Dari</th>
                <th class="w-50" style="border: 1px solid #d2d2d2;">Kepada</th>
            </tr>
            <tr>
                <td class="w-50" style="border: 1px solid #d2d2d2;">
                    <div class="box-text">
                        {{-- <p> <b>PT. Kuadran Satu Komunika</b></p>
                        <p>Jl. Tebet Raya No. 85A</p>
                        <p>Tebet - Jakarta Selatan 12820</p>
                        <p>Telp: +62 21 82850466</p>
                        <p>NPWP 82.417.388.4-015.000</p> --}}
                        <p style="line-height: normal">
                            <b>PT. Kuadran Satu Komunika</b> <br>
                            Jl. Tebet Raya No. 85A <br>
                            Telp: +62 21 82850466 <br>
                            NPWP 82.417.388.4-015.000
                        </p>
                    </div> 
                </td>
                <td style="border: 1px solid #d2d2d2;">
                    <div class="box-text">
                        {{-- <p style="line-height: normal"><b>{{$dataInvoice->getCompany->company_name}}</b></p>
                        <p>{{$dataInvoice->address_npwp}}</p>
                        <p>{{$dataInvoice->getCompany->zipcode}}</p>
                        <p style="line-height: normal">@nl2br($dataInvoice->pic_inv)</p>
                        <p>Telp:</p> --}}
                        <p style="line-height: normal">
                            <b>{{$dataInvoice->getCompany->company_name}}</b> <br>
                            @nl2br($dataInvoice->pic_inv) <br>
                            Telp :
                        </p>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="text-align: center">
                    <b>Harap Diterima</b> 
                </td>
                <td style="text-align: center">
                    <b>Yang Menerima</b> 
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid #d2d2d2;" class="w-25">
                    No. Invoice : {{$dataInvoice->inv_number}}
                </td>
                <td style="border: 1px solid #d2d2d2;">
                    Nama :
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid #d2d2d2;" class="w-25">
                    <p style="line-height: normal">
                        Ket : "<i><b>{{$dataInvoice->getProduct->name}}</b></i> "
                    </p>
                </td>
                <td style="border: 1px solid #d2d2d2;">
                    Bagian :
                </td>
            </tr>
            {{-- <tr>
                <td colspan="2" style="border: 1px solid #d2d2d2;" class="w-25">
                    Keterangan :
                </td>
            </tr> --}}
            <tr>
                <td colspan="2" style="text-align: right">
                    Jakarta, {{ date('d-m-Y', strtotime($dataInvoice->inv_date)) }}
                </td>
            </tr>
            <tr>
                <td>
                    <b>Paraf Penerima</b>
                </td>
                <td style="text-align: center">
                    <b>Hormat Kami</b>
                </td>
            </tr>
            <tr>
                <td>
                    Nama Jelas :
                </td>
                <td style="text-align: center">
                   <b>PT Kuadrant Satu Komunika</b>
                </td>
            </tr>
        </table>
    </div>
</div>


{{--------------------------------------- Surat Transfer -----------------------------------------}}
<div class="no-break">
    <div class="head-title" style="">
        <p style="text-align:center;"><img src="https://quadrant1komunika.co.id/wp-content/uploads/2021/10/cropped-logo-Q1-02-01.png" style="width: 230px; height: 45px;"></p>
        <h5 style="text-align: center;"><i> a member of </i> <img src="https://wartaekonomi.co.id/img/logo.png" alt="" style="width: 130px; height: 20px; vertical-align:sub;"></h5>
    </div>
    <div class="table-section bill-tbl w-100 mt-10">
        <table class="table w-100 mt-10">
            <tr>
                <td class="w-25" colspan="3">
                    <p>Jakarta, {{ date('d-m-Y', strtotime($dataInvoice->inv_date)) }}</p>
                </td>
            </tr>
            <tr>
                <td class="w-5">
                    No.
                </td>
                <td class="w-5">
                    :
                </td>
                <td>
                    <b>{{$dataInvoice->tf_number}}</b>
                </td>
            </tr>
            <tr>
                <td class="w-5">
                    Hal
                </td>
                <td class="w-5">
                    :
                </td>
                <td>
                    <b>Surat Keterangan Transfer Pembayaran</b>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="box-text" style="padding-top: 15px">
                        <p>Kepada Yth,</p>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="box-text">
                        <h2>{{$dataInvoice->getCompany->company_name}}</h2>
                        <p style="line-height: normal">@nl2br($dataInvoice->address_npwp)</p>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="box-text" style="padding-top: 15px">
                        <p>Dengan Hormat,</p>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="box-text" style="">
                        <p>
                            Sehubungan <b>Partisipasi Sponsorship</b> "<i><b>{{$dataInvoice->getProduct->name}}</b></i> "
                        </p>
                        <p>
                            Sebesar <b>@currency($dataInvoice->based_value + $dataInvoice->ppn - $dataInvoice->pph_23) (<i>{{ucwords($dataInvoice->terbilang)}} </i>)</b>. Dana tersebut ditransfer ke Rekening :
                        </p>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="w-15">
                    Atas Nama
                </td>
                <td class="w-5">
                    :
                </td>
                <td>
                    <b>PT Kuadran Satu Komunika</b>
                </td>
            </tr>
            <tr>
                <td class="w-15">
                    Nama Bank
                </td>
                <td class="w-5">
                    :
                </td>
                <td>
                    <b>Bank Rakyat Indonesia</b>
                </td>
            </tr>
            <tr>
                <td class="w-15">
                    Nomor Rekening
                </td>
                <td class="w-5">
                    :
                </td>
                <td>
                    <b>0335-01-002244308</b>
                </td>
            </tr>
            <tr>
                <td class="w-15">
                    Cabang
                </td>
                <td class="w-5">
                    :
                </td>
                <td>
                    <b>Kramat Jakarta Pusat</b>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="box-text" style="padding-top: 15px">
                        <p>Demikian hal ini kami sampaikan, atas perhatiannya kami ucapkan terimakasih.</p>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <p><b>Hormat Kami</b></p>
                    <p></p>    
                    <p></p>
                    <p></p>
                    <p></p>
                    <p></p>
                    <p></p>
                    <p><b>Ayu Wanda P</b></p>
                </td>
            </tr>
        </table>
    </div>
</div>
</html>