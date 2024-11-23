<table style="width: 100%">
    <thead>
        <tr style="background-color: #e6e6e7;">
            <th scope="col">Pelanggan</th>
            <th scope="col">Alamat</th>
            <th scope="col">Kota</th>
            <th scope="col">Provinsi</th>
            <th scope="col">Tgl Pengiriman</th>
            <th scope="col">Tgl Pemasangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($masterBanner as $banner)
            <tr>
                <td>{{ $banner->Nama }}</td>
                <td>{{ $banner->Alamat }}</td>
                <td>{{ $banner->Kota }}</td>
                <td>{{ $banner->Provinsi }}</td>
                <td>{{ $banner->tglpengiriman }}</td>
                <td>{{ $banner->tglpasang }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
