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
    .logo img{
        width:45px;
        height:45px;
        padding-top:30px;
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
        border: 1px solid #d2d2d2;
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
    .total-part{
        font-size:16px;
        line-height:12px;
    }
    .total-right p{
        padding-right:20px;
    }
</style>
<body>
<div class="head-title">
    <h1 class="text-center m-0 p-0">Invoice</h1>
</div>
<div class="add-detail mt-10">
    <div class="w-50 float-left mt-10">
        <p class="m-0 pt-5 text-bold w-100">Tanggal - <span class="gray-color">{{$dataInvoice->inv_date}}</span></p>
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
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">Dari</th>
            <th class="w-50">Kepada</th>
        </tr>
        <tr>
            <td>
                <div class="box-text">
                    <p> <b>PT. Kuadran Satu Komunika</b></p>
                    <p>Jl. Tebet Raya No. 85A</p>
                    <p>Tebet - Jakarta Selatan 12820</p>
                    <p>Telp: +62 21 82850466</p>
                    <p>NPWP 82.417.388.4-015.000</p>
                </div>
            </td>
            <td>
                <div class="box-text">
                    <p> <b>{{$dataInvoice->getCompany->company_name}}</b></p>
                    <p>{{$dataInvoice->getCompany->address}}</p>
                    <p>{{$dataInvoice->getCompany->zipcode}}</p>
                </div>
            </td>
        </tr>
    </table>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-100">Metode Pembayaran</th>
        </tr>
        <tr>
            <td>
                <p>Transfer Atas Nama :</p>
                <p> <b>PT. Kuadran Satu Komunika</b></p>
                <p>Bank BRI</p>
                <p><b>Acc No. 0335.01.00224430.8</b></p>
            </td>
        </tr>
    </table>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-40">Keterangan</th>
            <th class="w-10">Unit</th>
            <th class="w-25">Harga Satuan</th>
            <th class="w-25">Jumlah Harga</th>
           
        </tr>
        <tr align="center">
            <td>{{$dataInvoice->getProduct->name}}</td>
            <td>{{$dataInvoice->getProduct->quantity}}</td>
            <td>@currency($dataInvoice->size)</td>
            <td>@currency($dataInvoice->size)</td>
            
        </tr>
        <tr>
            <td colspan="4">
                <div class="total-part">
                    <div class="total-left w-75 float-left" align="right">
                        <p>Sub Total</p>
                        <p>PPN 11%</p>
                        <p>Total Keseluruhan</p>
                    </div>
                    <div class="total-right w-25 float-left text-bold" align="right">
                        <p>@currency($dataInvoice->size)</p>
                        <p>@currency($dataInvoice->ppn)</p>
                        <p>@currency($dataInvoice->size + $dataInvoice->ppn)</p>
                    </div>
                    <div style="clear: both;"></div>
                </div> 
            </td>
        </tr>
    </table>
</div>
</html>