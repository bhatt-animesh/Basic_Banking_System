<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>SN. No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Available Balance</th>
            <th>Total Transfer Amount</th>
            <th>Created at</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($getcustomer as $users) {
        ?>
        <tr id="dataid{{$users->id}}">
            <td>{{$users->id}}</td>
            <td>{{$users->name}}</td>
            <td>{{$users->email}}</td>
            <td>{{$users->available_balance}} Rs</td>
            <td>{{$users->total_transfer_amount}} Rs</td>
            <td>{{$users->created_at}}</td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>