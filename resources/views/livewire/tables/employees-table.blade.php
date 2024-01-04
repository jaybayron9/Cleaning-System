<div> 
    <h3 class="text-lg font-semibold">Employees</h3>
    <table class="text-sm">
        <thead>
            <tr>
                <th class="text-xs whitespace-nowrap text-center">ID</th>
                <th class="text-xs whitespace-nowrap text-center">NAME</th>
                <th class="text-xs whitespace-nowrap text-center">EMAIL</th>
                <th class="text-xs whitespace-nowrap text-center">CELLPHONE NO.</th>
                <th class="text-xs whitespace-nowrap text-center">BIRTHDAY</th>
                <th class="text-xs whitespace-nowrap text-center">CREATED AT</th> 
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $employee)
                <tr x-on:click="@this.viewImages({{ $employee->id }})" class="hover:cursor-pointer">
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->cp }}</td>
                    <td>{{ $employee->dob }}</td>
                    <td>{{ date('Y/m/d', strtotime($employee->created_at)) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> 