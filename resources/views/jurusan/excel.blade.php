<table border="1">
    <thead>
        <tr style="background-color: #f1f5f9; font-weight: bold;">
            <th>No</th>
            <th>Nama Jurusan</th>
            <th>Akreditasi</th>
            <th>Jumlah Mahasiswa</th>
            <th>Jumlah Mata Kuliah</th>
        </tr>
    </thead>
    <tbody>
        @foreach($jurusan as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nama_jurusan }}</td>
            <td>{{ $item->akreditasi }}</td>
            <td>{{ $item->mahasiswa_count }}</td>
            <td>{{ $item->matakuliah_count }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
