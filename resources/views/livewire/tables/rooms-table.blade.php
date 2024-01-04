<div> 
    <h3 class="text-lg font-semibold">Rooms</h3>
    <table class="text-sm">
        <thead>
            <tr>
                <th class="text-xs whitespace-nowrap text-center">ROOM ID</th>
                <th class="text-xs whitespace-nowrap text-center">NAME</th>
                <th class="text-xs whitespace-nowrap text-center">CAPACITY</th>
                <th class="text-xs whitespace-nowrap text-center">CREATED AT</th> 
            </tr>
        </thead>
        <tbody>
            @foreach ($rooms as $room)
                <tr>
                    <td>{{ $room->id }}</td>
                    <td>{{ $room->name }}</td>
                    <td>{{ $room->capacity }}</td>
                    <td>{{ date('Y/m/d', strtotime($room->created_at)) }}</td> 
                </tr>
            @endforeach
        </tbody>
    </table>
</div> 