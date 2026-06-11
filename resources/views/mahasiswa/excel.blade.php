<table border="1">
    <thead>
        <tr style="background-color: #f1f5f9; font-weight: bold;">
            <th>No</th>
            <th>NIM</th>
            <th>Nama Mahasiswa</th>
            <th>Jurusan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($mahasiswa as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td style="vnd.ms-excel.numberformat:@">{{ $item->nim }}</td>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->jurusan->nama_jurusan ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>