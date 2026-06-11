<table border="1">
    <thead>
        <tr style="background-color: #f1f5f9; font-weight: bold;">
            <th>No</th>
            <th>Nama Mata Kuliah</th>
            <th>SKS</th>
            <th>Jurusan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($matakuliah as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nama_matakuliah }}</td>
            <td>{{ $item->sks }}</td>
            <td>{{ $item->jurusan->nama_jurusan ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
