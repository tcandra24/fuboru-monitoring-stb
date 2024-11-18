<table style="width: 100%">
    <thead>
        <tr style="background-color: #e6e6e7;">
            <th scope="col">Kode Nota</th>
            <th scope="col">Kode Pelanggan</th>
            <th scope="col">Pelanggan</th>
            <th scope="col">Periode Awal</th>
            <th scope="col">Periode Akhir</th>
            <th scope="col">Target (Rp)</th>
            <th scope="col">Hadiah (%)</th>
            <th scope="col">Jenis</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($masterStb as $stb)
            <tr>
                <td>{{ $stb->kodenota }}</td>
                <td>{{ $stb->kdplg }}</td>
                <td>{{ $stb->nmplg }}</td>
                <td>{{ $stb->awal }}</td>
                <td>{{ $stb->akhir }}</td>
                <td>{{ $stb->kontrak }}</td>
                <td>{{ $stb->hadiah }}</td>
                <td>{{ $stb->jenis }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
